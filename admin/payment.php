<?php
require_once __DIR__ . '/../config/auth_check.php';
// Enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);



// Verify admin access
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit;
}

// Include database configuration
require_once __DIR__ . '/../config/db.php';

// Verify connection exists
if (!isset($pdo)) {
    die("Database connection failed. Check: 
        - db.php exists in config/
        - Database credentials are correct
        - MySQL server is running
        - Database 'kingmuaythai_db' exists");
}

    // Proses update status pembayaran
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
        $payment_id = $_POST['payment_id'];
        $status = $_POST['status'];
        $notes = $_POST['notes'];
        
        $stmt = $pdo->prepare("UPDATE payments SET status = ?, admin_notes = ?, processed_at = NOW(), processed_by = ? WHERE id = ?");
        $stmt->execute([$status, $notes, $_SESSION['user_id'], $payment_id]);
        
        // Jika status diubah menjadi paid, buat/update membership
        if ($status == 'paid') {
            $payment_stmt = $pdo->prepare("SELECT user_id, package_id FROM payments WHERE id = ?");
            $payment_stmt->execute([$payment_id]);
            $payment = $payment_stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($payment) {
                $package_stmt = $pdo->prepare("SELECT duration_days FROM membership_packages WHERE id = ?");
                $package_stmt->execute([$payment['package_id']]);
                $package = $package_stmt->fetch(PDO::FETCH_ASSOC);
                
                $start_date = date('Y-m-d H:i:s');
                $end_date = date('Y-m-d H:i:s', strtotime("+{$package['duration_days']} days"));
                
                // Cek apakah user sudah punya membership aktif
                $membership_stmt = $pdo->prepare("SELECT id FROM user_memberships WHERE user_id = ? AND status = 'active'");
                $membership_stmt->execute([$payment['user_id']]);
                
                if ($membership_stmt->rowCount() > 0) {
                    // Update membership yang ada
                    $update_stmt = $pdo->prepare("UPDATE user_memberships 
                                                SET package_id = ?, start_date = ?, end_date = ?, payment_id = ?
                                                WHERE user_id = ? AND status = 'active'");
                    $update_stmt->execute([
                        $payment['package_id'],
                        $start_date,
                        $end_date,
                        $payment_id,
                        $payment['user_id']
                    ]);
                } else {
                    // Buat membership baru
                    $insert_stmt = $pdo->prepare("INSERT INTO user_memberships 
                                                (user_id, package_id, start_date, end_date, payment_id, status)
                                                VALUES (?, ?, ?, ?, ?, 'active')");
                    $insert_stmt->execute([
                        $payment['user_id'],
                        $payment['package_id'],
                        $start_date,
                        $end_date,
                        $payment_id]
                    );
                }
            }
        }
        
        $_SESSION['message'] = "Status pembayaran berhasil diperbarui";
        header("Location: payment.php");
        exit();
    }

    // Ambil data pembayaran
    $search = isset($_GET['search']) ? "%{$_GET['search']}%" : '%';
    $status_filter = isset($_GET['status']) ? $_GET['status'] : '%';

    $query = "SELECT p.*, u.username, mp.name as package_name, 
            (SELECT username FROM users WHERE id = p.processed_by) as processed_by_name
            FROM payments p
            JOIN users u ON p.user_id = u.id
            JOIN membership_packages mp ON p.package_id = mp.id
            WHERE u.username LIKE ? AND p.status LIKE ?
            ORDER BY p.payment_date DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$search, $status_filter]);
    $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Proses hapus pembayaran
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_payment'])) {
    $payment_id = $_POST['payment_id'];
    
    try {
        // Mulai transaksi
        $pdo->beginTransaction();
        
        // Hapus referensi di user_memberships terlebih dahulu
        $stmt = $pdo->prepare("UPDATE user_memberships SET payment_id = NULL WHERE payment_id = ?");
        $stmt->execute([$payment_id]);
        
        // Hapus pembayaran
        $stmt = $pdo->prepare("DELETE FROM payments WHERE id = ?");
        $stmt->execute([$payment_id]);
        
        $pdo->commit();
        
        $_SESSION['message'] = "Pembayaran berhasil dihapus";
        header("Location: payment.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Gagal menghapus pembayaran: " . $e->getMessage();
        header("Location: payment.php");
        exit();
    }
}

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Payment Management</title>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }
        .proof-image {
            max-width: 100%;
            max-height: 300px;
            margin-top: 10px;
        }
    </style>

</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <?php include '../partials/sidebar.php'; ?>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center md:hidden">
                            <button id="menu-button"
                                class="p-2 rounded-md text-gray-600 hover:text-gray-900 focus:outline-none">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <h1 class="text-xl font-semibold text-gray-800">Payment Management</h1>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                        <!-- Payment Controls -->
                        <div class="bg-white shadow rounded-lg p-6 mb-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 mb-4">
                                <h2 class="text-lg font-medium text-gray-900">Payment Management</h2>
                                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                                    <form method="get" class="flex items-center">
                                        <div class="relative">
                                            <input type="text" name="search" placeholder="Search member..."
                                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                                value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-search text-gray-400"></i>
                                            </div>
                                        </div>
                                        <select name="status"
                                            class="ml-2 block pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                            <option value="%">All Status</option>
                                            <option value="pending" <?= (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                            <option value="paid" <?= (isset($_GET['status']) && $_GET['status'] == 'paid') ? 'selected' : '' ?>>Paid</option>
                                            <option value="rejected" <?= (isset($_GET['status']) && $_GET['status'] == 'rejected') ? 'selected' : '' ?>>Rejected</option>
                                        </select>
                                        <button type="submit"
                                            class="ml-2 bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded-md flex items-center">
                                            <i class="fas fa-filter mr-2"></i>
                                            Filter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Table -->
                        <div class="bg-white shadow rounded-lg mb-6 overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php foreach ($payments as $index => $payment): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $index + 1 ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($payment['username']) ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900"><?= htmlspecialchars($payment['package_name']) ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Rp <?= number_format($payment['amount'], 0, ',', '.') ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?= date('d M Y', strtotime($payment['payment_date'])) ?>
                                            </td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php 
                                                $status_class = '';
                                                switch ($payment['status']) {
                                                    case 'paid': $status_class = 'bg-green-100 text-green-800'; break;
                                                    case 'pending': $status_class = 'bg-yellow-100 text-yellow-800'; break;
                                                    case 'rejected': $status_class = 'bg-red-100 text-red-800'; break;
                                                    default: $status_class = 'bg-gray-100 text-gray-800';
                                                }
                                                ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_class ?>">
                                                    <?= ucfirst($payment['status']) ?>
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex space-x-2">
                                                    <button onclick="openPaymentDetail(<?= htmlspecialchars(json_encode($payment)) ?>)"
                                                        class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <form method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?');" class="inline">
                                                        <input type="hidden" name="payment_id" value="<?= $payment['id'] ?>">
                                                        <button type="submit" name="delete_payment" class="text-red-600 hover:text-red-900">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <?php if ($payment['proof_image']): ?>
                                                    <a href="../uploads/payments/<?= htmlspecialchars($payment['proof_image']) ?>" 
                                                        download
                                                        class="text-gray-600 hover:text-gray-900">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>            

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Payment Detail Modal -->
    <div id="paymentDetailModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('paymentDetailModal').style.display='none'">&times;</span>
            <h3 class="text-lg font-semibold mb-4">Detail Pembayaran</h3>
            
            <div id="paymentDetailContent">
                <!-- Content will be filled by JavaScript -->
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('menu-button').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.remove('hidden');
        });

        document.getElementById('close-menu').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.add('hidden');
        });

// Payment detail modal
function openPaymentDetail(payment) {
    const modal = document.getElementById('paymentDetailModal');
    const content = document.getElementById('paymentDetailContent');
    
    // Buat URL gambar yang benar
    const proofImageUrl = payment.proof_image ? `../uploads/payments/${payment.proof_image}` : '';
    
    content.innerHTML = `
        <div class="space-y-4">
        
            
            <!-- Bagian Bukti Pembayaran -->
                ${proofImageUrl ? `
        <div class="mb-4">
            <img src="${proofImageUrl}" 
                alt="Bukti Pembayaran"
                class="max-w-full h-auto rounded border"
                onerror="this.onerror=null;this.src='../image/no-image.jpg';this.alt='Gambar tidak tersedia'">
            <a href="${proofImageUrl}" download class="text-blue-500 mt-2 inline-block">
                <i class="fas fa-download mr-1"></i> Download Bukti
            </a>
        </div>
        ` : '<p class="text-gray-500 py-4">Tidak ada bukti pembayaran yang diunggah</p>'}
            
            <!-- Detail Pembayaran -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Anggota</label>
                    <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${payment.username}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Paket Membership</label>
                    <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${payment.package_name}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Pembayaran</label>
                    <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">Rp ${payment.amount.toLocaleString('id-ID')}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pembayaran</label>
                    <p class="text-sm text-gray-900 bg-gray-50 p-2 rounded">${new Date(payment.payment_date).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                </div>
            </div>
            
            <form method="post" class="space-y-4">
                <input type="hidden" name="payment_id" value="${payment.id}">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                    <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                        <option value="pending" ${payment.status === 'pending' ? 'selected' : ''}>Pending</option>
                        <option value="paid" ${payment.status === 'paid' ? 'selected' : ''}>Paid</option>
                        <option value="rejected" ${payment.status === 'rejected' ? 'selected' : ''}>Rejected</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Admin</label>
                    <textarea name="notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm">${payment.admin_notes || ''}</textarea>
                </div>
                
                ${payment.processed_at && payment.processed_by_name ? `
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <h4 class="text-sm font-medium text-gray-500 mb-2">PROSES VERIFIKASI</h4>
                    <p class="text-sm">Diproses oleh: <span class="font-medium">${payment.processed_by_name}</span></p>
                    <p class="text-sm">Pada: <span class="font-medium">${new Date(payment.processed_at).toLocaleString()}</span></p>
                </div>
                ` : ''}
                
                <div class="flex justify-between pt-4">
                    <form method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?');" class="inline">
                        <input type="hidden" name="payment_id" value="${payment.id}">
                        <button type="submit" name="delete_payment"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fas fa-trash mr-2"></i> Hapus
                        </button>
                    </form>
                    
                    <div class="space-x-2">
                        <button type="button" onclick="document.getElementById('paymentDetailModal').style.display='none'" 
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Batal
                        </button>
                        <button type="submit" name="update_status"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    `;
    
    modal.style.display = 'block';
}

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('paymentDetailModal')) {
                document.getElementById('paymentDetailModal').style.display = 'none';
            }
        }
    </script>
</body>

</html>