<?php
require_once '../config/auth_check.php';

// Koneksi database
require_once '../config/db.php';

// Pastikan hanya member yang bisa mengakses
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    error_log("Redirect ke login karena session invalid: " . print_r($_SESSION, true));
    header('Location: ../login.php');
    exit();
}

// Tampilkan pesan error/success
if (isset($_SESSION['error'])) {
    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">' . $_SESSION['error'] . '</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            </div>';
    unset($_SESSION['error']);
}

if (isset($_SESSION['message'])) {
    echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">' . $_SESSION['message'] . '</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            </div>';
    unset($_SESSION['message']);
}


// Gunakan user_id untuk identifikasi yang lebih aman
$user_id = $_SESSION['user_id'];



// Ambil data member dari database
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Pastikan data user ada
if (!$user) {
    session_destroy();
    header('Location: ../login.php');
    exit();
}

// Gunakan nama dari database, bukan session
$username = $user['username'];

// Koneksi ke database untuk mendapatkan jadwal
$host = 'localhost';
$dbname = 'kingmuaythai_db';
$usernameDb = 'root';
$password = '';

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usernameDb, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Mengambil data jadwal kelas dari database
$query = "SELECT * FROM class_schedule ORDER BY FIELD(day, 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'), time";
$stmt = $pdo->prepare($query);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kelompokkan data berdasarkan hari
$groupedClasses = [];
foreach ($classes as $class) {
    $groupedClasses[$class['day']][] = $class;
}

// Cek status membership - pastikan mengacu ke user yang login
$membership_stmt = $pdo->prepare("SELECT um.*, mp.name as package_name 
                                    FROM user_memberships um
                                    JOIN membership_packages mp ON um.package_id = mp.id
                                    WHERE um.user_id = ? AND um.status = 'active' AND um.end_date > NOW()");
$membership_stmt->execute([$user_id]);
$active_membership = $membership_stmt->fetch();

// Ambil data paket membership
$packages_stmt = $pdo->query("SELECT * FROM membership_packages");
$packages = $packages_stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil riwayat pembayaran dengan informasi bulan
$payments_stmt = $pdo->prepare("SELECT p.*, mp.name as package_name, 
                                DATE_FORMAT(p.payment_date, '%Y-%m') as payment_month
                                FROM payments p
                                JOIN membership_packages mp ON p.package_id = mp.id
                                WHERE user_id = ? 
                                ORDER BY payment_date DESC 
                                LIMIT 5");
$payments_stmt->execute([$user_id]);
$payments = $payments_stmt->fetchAll(PDO::FETCH_ASSOC);

// Proses form pembayaran jika ada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_payment'])) {
    $package_id = $_POST['package_id'];
    $proof_image = '';

    // Validasi: Cek apakah member sudah membeli paket bulan ini
    $current_month = date('Y-m-01'); // Awal bulan ini
    $next_month = date('Y-m-01', strtotime('+1 month')); // Awal bulan depan

    $check_payment_stmt = $pdo->prepare("SELECT COUNT(*) as count FROM payments 
                                        WHERE user_id = ? 
                                        AND payment_date >= ? 
                                        AND payment_date < ?");
    $check_payment_stmt->execute([$user_id, $current_month, $next_month]);
    $payment_count = $check_payment_stmt->fetch(PDO::FETCH_ASSOC)['count'];

    if ($payment_count > 0) {
        $_SESSION['error'] = "Anda hanya bisa membeli 1 paket membership per bulan. Pembelian berikutnya bisa dilakukan bulan depan.";
        header("Location: memberview.php");
        exit();
    }

    // Handle file upload
    if (isset($_FILES['proof_image']) && $_FILES['proof_image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../uploads/payments/';

        // Buat folder jika belum ada
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Validasi file
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        $max_size = 2 * 1024 * 1024; // 2MB

        if (!in_array($_FILES['proof_image']['type'], $allowed_types)) {
            $_SESSION['error'] = "Format file tidak didukung. Hanya JPG, JPEG, dan PNG yang diperbolehkan.";
            header("Location: memberview.php");
            exit();
        }

        if ($_FILES['proof_image']['size'] > $max_size) {
            $_SESSION['error'] = "Ukuran file terlalu besar. Maksimal 2MB.";
            header("Location: memberview.php");
            exit();
        }

        // Generate nama file unik
        $file_ext = pathinfo($_FILES['proof_image']['name'], PATHINFO_EXTENSION);
        $file_name = uniqid('payment_') . '.' . $file_ext;
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['proof_image']['tmp_name'], $target_file)) {
            $proof_image = $file_name;
        } else {
            $_SESSION['error'] = "Gagal mengunggah bukti pembayaran.";
            header("Location: memberview.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Silakan upload bukti pembayaran.";
        header("Location: memberview.php");
        exit();
    }

    // Dapatkan detail paket
    $package_stmt = $pdo->prepare("SELECT * FROM membership_packages WHERE id = ?");
    $package_stmt->execute([$package_id]);
    $package = $package_stmt->fetch(PDO::FETCH_ASSOC);

    if ($package) {
        try {
            $pdo->beginTransaction();

            $payment_stmt = $pdo->prepare("INSERT INTO payments 
                                        (user_id, package_id, amount, status, proof_image) 
                                        VALUES (?, ?, ?, 'pending', ?)");
            $payment_stmt->execute([$user_id, $package_id, $package['price'], $proof_image]);

            $pdo->commit();

            $_SESSION['message'] = "Pembayaran berhasil dikirim. Tunggu konfirmasi admin.";
            header("Location: memberview.php");
            exit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
            header("Location: memberview.php");
            exit();
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Member App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover {
            color: black;
            cursor: pointer;
        }

        .attendance-modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .attendance-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }
    </style>

</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Header -->
    <header class="bg-red-600 text-white p-4 shadow-md">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="../image/LOGOKING.png" alt="Logo" class="h-10 w-10 rounded-full bg-white p-1">
                <h1 class="text-xl font-bold">King Muaythai</h1>
            </div>
            <div class="flex items-center space-x-3">
                <button class="p-2">
                    <i class="fas fa-bell text-lg"></i>
                </button>
                <button id="profile-button" class="p-2">
                    <i class="fas fa-user-circle text-lg"></i>
                </button>
            </div>
        </div>
    </header>



    <!-- Main Content -->
    <main class="pb-16"> <!-- Add padding at bottom for nav bar -->

        <?php
        // Mengambil ID pengguna dari sesi
        $user_id = $_SESSION['user_id'];

        // Mengambil data bulan ini dan menghitung latihan bulan ini
        $current_month = date('Y-m-01');  // Awal bulan ini
        $next_month = date('Y-m-01', strtotime('+1 month'));  // Awal bulan depan
        
        // Query untuk menghitung latihan bulan ini
        $attend_this_month_stmt = $pdo->prepare("SELECT COUNT(*) as count 
                                          FROM attendance 
                                          WHERE user_id = ? 
                                          AND date >= ? 
                                          AND date < ?");
        $attend_this_month_stmt->execute([$user_id, $current_month, $next_month]);
        $attend_this_month = $attend_this_month_stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Query untuk menghitung total latihan
        $total_attend_stmt = $pdo->prepare("SELECT COUNT(*) as count 
                                    FROM attendance 
                                    WHERE user_id = ?");
        $total_attend_stmt->execute([$user_id]);
        $total_attend = $total_attend_stmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Mengambil data paket membership aktif
        $membership_stmt = $pdo->prepare("SELECT um.*, mp.name as package_name 
                                  FROM user_memberships um
                                  JOIN membership_packages mp ON um.package_id = mp.id
                                  WHERE um.user_id = ? AND um.status = 'active' AND um.end_date > NOW()");
        $membership_stmt->execute([$user_id]);
        $active_membership = $membership_stmt->fetch();
        ?>


        <!-- Welcome Section -->
        <section class="bg-white p-4 shadow-sm mb-4">
            <div class="flex items-center space-x-3 mb-3">
                <div>
                    <h2 class="text-3xl font-bold">Hai, <?= htmlspecialchars($username) ?>!</h2>
                    <!-- <p class="text-sm text-gray-600">Membership aktif hingga: <span class="font-medium text-red-600">20 Mei 2025</span></p> -->
                </div>
            </div>
            <div class="flex justify-between bg-gray-50 rounded-lg p-3">
                <div class="text-center border-l border-r border-gray-300 px-4">
                    <p class="text-lg font-bold text-red-600"><?= $attend_this_month ?>
                        <?php if ($active_membership): ?>
                            <?php
                            $max_attendance = 0;
                            if (strpos($active_membership['package_name'], '4X') !== false) {
                                $max_attendance = 4;
                            } elseif (strpos($active_membership['package_name'], '8X') !== false) {
                                $max_attendance = 8;
                            } elseif (strpos($active_membership['package_name'], 'Unlimited') !== false) {
                                $max_attendance = '∞';
                            }
                            ?>
                            <span class="text-xs font-normal">/ <?= $max_attendance ?></span>
                        <?php endif; ?>
                    </p>
                    <p class="text-xs text-gray-600">Latihan Bulan Ini</p>
                </div>

                <div class="text-center border-l border-r border-gray-300 px-4">
                    <p class="text-lg font-bold text-red-600"><?= $total_attend ?></p>
                    <p class="text-xs text-gray-600">Total Latihan</p>
                </div>


                <div class="text-center">
                    <?php if ($active_membership): ?>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex items-center">

                                <div>
                                    <p class="text-lg font-bold text-green-600">Aktif</p>
                                    <p class="text-xs text-gray-600">Status Membership</p>
                                </div>

                            </div>
                        </div>
                    <?php else: ?>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-center">

                                <div>
                                    <h4 class="font-medium text-yellow-800">Tidak Aktif</h4>
                                    <p class="text-xs text-gray-600">Status Membership</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </section>


        <!-- Quick Links -->
        <section class="grid grid-cols-4 gap-2 bg-white p-4 shadow-sm mb-4">
            <a href="#schedule" class="flex flex-col items-center justify-center">
                <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center mb-1">
                    <i class="fas fa-calendar-alt text-red-600"></i>
                </div>
                <span class="text-xs text-center">Jadwal</span>
            </a>
            <a href="#attendance" class="flex flex-col items-center justify-center">
                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mb-1">
                    <i class="fas fa-calendar-check text-blue-600"></i>
                </div>
                <span class="text-xs text-center">Kehadiran</span>
            </a>
            <a href="#payment" class="flex flex-col items-center justify-center">
                <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center mb-1">
                    <i class="fas fa-credit-card text-green-600"></i>
                </div>
                <span class="text-xs text-center">Pembayaran</span>
            </a>
            <a href="#trainers" class="flex flex-col items-center justify-center">
                <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center mb-1">
                    <i class="fas fa-user-tie text-purple-600"></i>
                </div>
                <span class="text-xs text-center">Pelatih</span>
            </a>
        </section>

        <!-- Payment Section - Diubah -->
        <section id="payment" class="bg-white p-4 shadow-sm mb-4">
            <h3 class="text-md font-semibold mb-3">Informasi Pembayaran</h3>

            <?php if ($active_membership): ?>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-green-800">Membership Aktif</h4>
                            <p class="text-sm text-green-600">Paket:
                                <?= htmlspecialchars($active_membership['package_name']) ?>
                            </p>
                            <p class="text-sm text-green-600">Berlaku hingga:
                                <?= date('d M Y', strtotime($active_membership['end_date'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation text-yellow-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-yellow-800">Membership Tidak Aktif</h4>
                            <p class="text-sm text-yellow-600">Silakan pilih paket membership untuk melanjutkan</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="border rounded-lg overflow-hidden">
                <?php foreach ($packages as $package): ?>
                    <div class="p-4 bg-gray-50 border-b">
                        <div class="flex justify-between mb-3">
                            <div>
                                <div class="text-sm text-gray-500">Paket</div>
                                <div class="font-medium"><?= htmlspecialchars($package['name']) ?></div>
                                <div class="text-xs text-gray-500"><?= htmlspecialchars($package['description']) ?></div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Harga</div>
                                <div class="font-medium">Rp <?= number_format($package['price'], 0, ',', '.') ?></div>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button
                                onclick="openPaymentModal(<?= $package['id'] ?>, '<?= htmlspecialchars($package['name']) ?>', <?= $package['price'] ?>)"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm">
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Riwayat Pembayaran -->
            <?php if (!empty($payments)): ?>
                <div class="mt-6">
                    <h4 class="text-md font-semibold mb-2">Riwayat Pembayaran</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-gray-50 text-xs">
                                    <th class="px-3 py-2 text-left">Tanggal</th>
                                    <th class="px-3 py-2 text-left">Paket</th>
                                    <th class="px-3 py-2 text-left">Jumlah</th>
                                    <th class="px-3 py-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payments as $payment): ?>
                                    <tr class="border-b">
                                        <td class="px-3 py-3 text-sm"><?= date('d M Y', strtotime($payment['payment_date'])) ?>
                                        </td>
                                        <td class="px-3 py-3 text-sm"><?= htmlspecialchars($payment['package_name']) ?></td>
                                        <td class="px-3 py-3 text-sm">Rp <?= number_format($payment['amount'], 0, ',', '.') ?>
                                        </td>
                                        <td class="px-3 py-3">
                                            <?php
                                            $status_class = '';
                                            switch ($payment['status']) {
                                                case 'paid':
                                                    $status_class = 'bg-green-100 text-green-800';
                                                    break;
                                                case 'pending':
                                                    $status_class = 'bg-yellow-100 text-yellow-800';
                                                    break;
                                                case 'rejected':
                                                    $status_class = 'bg-red-100 text-red-800';
                                                    break;
                                                default:
                                                    $status_class = 'bg-gray-100 text-gray-800';
                                            }
                                            ?>
                                            <span class="px-2 py-1 text-xs rounded-full <?= $status_class ?>">
                                                <?= ucfirst($payment['status']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </section>

        <!-- Payment Modal -->
        <div id="paymentModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3 class="text-lg font-semibold mb-4" id="modalTitle">Pembayaran Paket</h3>

                <div class="mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-yellow-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Anda hanya dapat membeli 1 paket membership per bulan.
                                Jika sudah membeli bulan ini, pembelian berikutnya bisa dilakukan bulan depan.
                            </p>
                        </div>
                    </div>
                </div>

                <form id="paymentForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="package_id" id="package_id">

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Paket:</label>
                        <p class="text-gray-900" id="packageName"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
                        <p class="text-gray-900" id="packagePrice"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Rekening Pembayaran:</label>
                        <div class="bg-gray-100 p-3 rounded-lg">
                            <p class="font-medium">Bank BCA</p>
                            <p class="text-lg font-bold">1234567890</p>
                            <p class="text-sm">a/n King Muaythai</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="proof_image">
                            Upload Bukti Transfer:
                        </label>
                        <input type="file" name="proof_image" id="proof_image" class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-red-50 file:text-red-700
                                        hover:file:bg-red-100" required>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (max 2MB)</p>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="document.getElementById('paymentModal').style.display='none'"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded mr-2">
                            Batal
                        </button>
                        <button type="submit" name="submit_payment"
                            class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                            Kirim Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Modal functions
            function openPaymentModal(packageId, packageName, packagePrice) {
                document.getElementById('package_id').value = packageId;
                document.getElementById('packageName').textContent = packageName;
                document.getElementById('packagePrice').textContent = 'Rp ' + packagePrice.toLocaleString('id-ID');
                document.getElementById('paymentModal').style.display = 'block';
            }

            // Close modal when clicking X
            document.querySelector('.close').onclick = function () {
                document.getElementById('paymentModal').style.display = 'none';
            }

            // Close modal when clicking outside
            window.onclick = function (event) {
                if (event.target == document.getElementById('paymentModal')) {
                    document.getElementById('paymentModal').style.display = 'none';
                }
            }
        </script>


        <?php
        // Ambil ID user dan tanggal hari ini
        $user_id = $_SESSION['user_id'];
        $today = date('Y-m-d');

        // Cek apakah user sudah absen hari ini
        $check_attendance_stmt = $pdo->prepare("SELECT * FROM attendance WHERE user_id = ? AND date = ?");
        $check_attendance_stmt->execute([$user_id, $today]);
        $has_attended_today = $check_attendance_stmt->rowCount() > 0;
        ?>




<section id="schedule" class="bg-white p-4 shadow-sm mb-4">
    <div class="flex justify-between items-center mb-3">
        <h3 class="text-md font-semibold">Jadwal</h3>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <!-- Column 1: Senin, Selasa, Rabu -->
        <div>
            <?php
            $days = ['SENIN', 'SELASA', 'RABU']; // Hari untuk kolom pertama
            foreach ($days as $day): ?>
                <div class="font-semibold text-lg"><?= $day ?></div>
                <?php
                if (isset($groupedClasses[$day])):
                    foreach ($groupedClasses[$day] as $class): ?>
                        <div class="flex items-center p-3 border rounded-lg bg-gray-50 mb-3">
                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                <i class="fas fa-dumbbell text-red-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h4 class="font-medium"><?= htmlspecialchars($class['coach']) ?></h4>
                                    <span class="text-xs bg-gray-200 px-2 py-1 rounded-full"><?= htmlspecialchars($class['time']) ?></span>
                                </div>
                                <div class="flex text-sm text-gray-500">
                                    <span class="mr-3"><i class="far fa-clock mr-1"></i><?= htmlspecialchars($class['time']) ?></span>
                                    <span><i class="far fa-user mr-1"></i><?= htmlspecialchars($class['coach']) ?></span>
                                </div>
                            </div>
                            
                            <?php 
                            // Check if user can attend more classes this month
                            $can_attend_more = true;
                            if ($active_membership) {
                                $max_attendance = 0;
                                if (strpos($active_membership['package_name'], '4X') !== false) {
                                    $max_attendance = 4;
                                } elseif (strpos($active_membership['package_name'], '8X') !== false) {
                                    $max_attendance = 8;
                                } elseif (strpos($active_membership['package_name'], 'Unlimited') !== false) {
                                    $max_attendance = PHP_INT_MAX;
                                }
                                
                                if ($attend_this_month >= $max_attendance) {
                                    $can_attend_more = false;
                                }
                            }
                            ?>

                            <?php if ($has_attended_today): ?>
                                <!-- Button disabled if already attended today -->
                                <button disabled class="ml-2 bg-gray-400 text-white p-2 rounded-md cursor-not-allowed"
                                    title="Anda sudah absen hari ini">
                                    <i class="fas fa-check"></i>
                                </button>
                            <?php elseif (!$active_membership): ?>
                                <!-- Button disabled if no active membership -->
                                <button disabled class="ml-2 bg-gray-400 text-white p-2 rounded-md cursor-not-allowed"
                                    title="Anda tidak memiliki membership aktif">
                                    <i class="fas fa-times"></i>
                                </button>
                            <?php elseif (!$can_attend_more): ?>
                                <!-- Button disabled if reached monthly limit -->
                                <button disabled class="ml-2 bg-gray-400 text-white p-2 rounded-md cursor-not-allowed"
                                    title="Anda sudah mencapai batas kehadiran bulan ini">
                                    <i class="fas fa-ban"></i>
                                </button>
                            <?php else: ?>
                                <!-- Active attendance button -->
                                <button onclick="openAttendanceModal(
                                    '<?= $class['id'] ?>', 
                                    '<?= htmlspecialchars($class['coach']) ?>', 
                                    '<?= htmlspecialchars($class['day']) ?>', 
                                    '<?= htmlspecialchars($class['time']) ?>', 
                                    '<?= htmlspecialchars($class['coach']) ?>'
                                )" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600">
                                    <i class="fas fa-check"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p class="text-gray-500">Tidak ada kelas yang dijadwalkan untuk <?= $day ?>.</p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Column 2: Kamis, Jumat, Sabtu -->
        <div>
            <?php
            $days = ['KAMIS', 'JUMAT', 'SABTU']; // Hari untuk kolom kedua
            foreach ($days as $day): ?>
                <div class="font-semibold text-lg"><?= $day ?></div>
                <?php
                if (isset($groupedClasses[$day])):
                    foreach ($groupedClasses[$day] as $class): ?>
                        <div class="flex items-center p-3 border rounded-lg bg-gray-50 mb-3">
                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                <i class="fas fa-dumbbell text-red-600"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between">
                                    <h4 class="font-medium"><?= htmlspecialchars($class['coach']) ?></h4>
                                    <span class="text-xs bg-gray-200 px-2 py-1 rounded-full"><?= htmlspecialchars($class['time']) ?></span>
                                </div>
                                <div class="flex text-sm text-gray-500">
                                    <span class="mr-3"><i class="far fa-clock mr-1"></i><?= htmlspecialchars($class['time']) ?></span>
                                    <span><i class="far fa-user mr-1"></i><?= htmlspecialchars($class['coach']) ?></span>
                                </div>
                            </div>
                            
                            <?php 
                            // Check if user can attend more classes this month
                            $can_attend_more = true;
                            if ($active_membership) {
                                $max_attendance = 0;
                                if (strpos($active_membership['package_name'], '4X') !== false) {
                                    $max_attendance = 4;
                                } elseif (strpos($active_membership['package_name'], '8X') !== false) {
                                    $max_attendance = 8;
                                } elseif (strpos($active_membership['package_name'], 'Unlimited') !== false) {
                                    $max_attendance = PHP_INT_MAX;
                                }
                                
                                if ($attend_this_month >= $max_attendance) {
                                    $can_attend_more = false;
                                }
                            }
                            ?>

                            <?php if ($has_attended_today): ?>
                                <!-- Button disabled if already attended today -->
                                <button disabled class="ml-2 bg-gray-400 text-white p-2 rounded-md cursor-not-allowed"
                                    title="Anda sudah absen hari ini">
                                    <i class="fas fa-check"></i>
                                </button>
                            <?php elseif (!$active_membership): ?>
                                <!-- Button disabled if no active membership -->
                                <button disabled class="ml-2 bg-gray-400 text-white p-2 rounded-md cursor-not-allowed"
                                    title="Anda tidak memiliki membership aktif">
                                    <i class="fas fa-times"></i>
                                </button>
                            <?php elseif (!$can_attend_more): ?>
                                <!-- Button disabled if reached monthly limit -->
                                <button disabled class="ml-2 bg-gray-400 text-white p-2 rounded-md cursor-not-allowed"
                                    title="Anda sudah mencapai batas kehadiran bulan ini">
                                    <i class="fas fa-ban"></i>
                                </button>
                            <?php else: ?>
                                <!-- Active attendance button -->
                                <button onclick="openAttendanceModal(
                                    '<?= $class['id'] ?>', 
                                    '<?= htmlspecialchars($class['coach']) ?>', 
                                    '<?= htmlspecialchars($class['day']) ?>', 
                                    '<?= htmlspecialchars($class['time']) ?>', 
                                    '<?= htmlspecialchars($class['coach']) ?>'
                                )" class="ml-2 bg-red-500 text-white p-2 rounded-md hover:bg-red-600">
                                    <i class="fas fa-check"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p class="text-gray-500">Tidak ada kelas yang dijadwalkan untuk <?= $day ?>.</p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>




        <script>
            document.addEventListener('DOMContentLoaded', function () {
                function loadSchedule() {
                    fetch('api/class_schedule_api.php') // Mengambil data jadwal dari server
                        .then(response => response.json())
                        .then(data => {
                            let scheduleHtml = '';
                            if (data.length > 0) {
                                data.forEach(classItem => {
                                    scheduleHtml += `
                                        <tr class="bg-white">
                                            <td class="table-cell">${classItem.day}</td>
                                            <td class="table-cell">${classItem.coach}</td>
                                            <td class="table-cell">${classItem.time}</td>
                                        </tr>
                                    `;
                                });
                            } else {
                                scheduleHtml = '<tr><td colspan="3" class="text-center text-gray-500">Tidak ada kelas yang dijadwalkan hari ini.</td></tr>';
                            }

                            document.getElementById('class-schedule-body').innerHTML = scheduleHtml;
                        })
                        .catch(error => {
                            console.error('Error fetching schedule:', error);
                            document.getElementById('class-schedule-body').innerHTML = '<tr><td colspan="3" class="text-center text-red-500">Terjadi kesalahan saat memuat jadwal.</td></tr>';
                        });
                }

                // Memuat jadwal saat halaman dimuat
                loadSchedule();
            });
        </script>

        <?php
        // … koneksi, session, dsb …
        
        $att_stmt = $pdo->prepare("
    SELECT 
      a.date         AS attendance_date,
      a.time         AS attendance_time,
      a.status,
      cs.coach,
      cs.day,
      cs.time         AS class_time
    FROM attendance a
    JOIN class_schedule cs ON a.class_id = cs.id
    WHERE a.user_id = ?
    ORDER BY a.date DESC, a.time DESC
    LIMIT 10
");
        $att_stmt->execute([$user_id]);
        $attendances = $att_stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>


        <!-- Attendance History -->
        <section id="attendance" class="bg-white p-4 shadow-sm mb-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-md font-semibold">Riwayat Kehadiran</h3>
                <a href="#" class="text-sm text-red-600">Lihat Semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 text-xs">
                        <tr>
                            <th class="px-3 py-2 text-left">Tanggal</th>
                            <th class="px-3 py-2 text-left">Kelas</th>
                            <th class="px-3 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        <?php if (!empty($attendances)): ?>
                            <?php foreach ($attendances as $rec): ?>
                                <tr class="border-b">
                                    <!-- Tanggal (hanya tanggal, tanpa waktu) -->
                                    <td class="px-3 py-3 text-sm">
                                        <?= date('d M Y', strtotime($rec['attendance_date'])) ?>
                                    </td>
                                    <!-- Nama coach + hari & jam kelas -->
                                    <td class="px-3 py-3 text-sm">
                                        <?= htmlspecialchars($rec['coach']) ?>
                                        (<?= htmlspecialchars($rec['day']) ?>, <?= htmlspecialchars($rec['class_time']) ?>)
                                    </td>
                                    <!-- Status -->
                                    <td class="px-3 py-3">
                                        <?php
                                        $cls = $rec['status'] === 'present'
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-yellow-100 text-yellow-800';
                                        ?>
                                        <span class="px-2 py-1 text-xs rounded-full <?= $cls ?>">
                                            <?= ucfirst($rec['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 py-4">
                                    Belum ada riwayat kehadiran.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>


                </table>
            </div>
        </section>



        <!-- Trainers Section -->
        <?php
        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "kingmuaythai_db");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query untuk mendapatkan data pelatih
        $result = $conn->query("SELECT * FROM trainers");

        if ($result->num_rows > 0) {
            // Data pelatih ditemukan
            $trainers = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Jika tidak ada pelatih
            $trainers = [];
        }

        $conn->close();
        ?>


        <section id="trainers" class="bg-white p-4 shadow-sm mb-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-md font-semibold">Pelatih Kami</h3>
                <a href="#" class="text-sm text-red-600">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-3 gap-3">
                <?php if (count($trainers) > 0): ?>
                    <?php foreach ($trainers as $trainer): ?>
                        <div class="border rounded-lg overflow-hidden bg-gray-50">
                            <div class="h-32 bg-gray-200">
                                <img src="../admin/<?= htmlspecialchars($trainer['cover_photo']) ?>" alt="Trainer"
                                    class="h-full w-full object-cover">
                            </div>
                            <div class="p-3">
                                <h4 class="font-medium"><?= htmlspecialchars($trainer['name']) ?></h4>
                                <p class="text-sm text-gray-500"><?= htmlspecialchars($trainer['specialties']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-gray-500 w-full">Tidak ada pelatih tersedia.</div>
                <?php endif; ?>
            </div>
        </section>


        <!-- Contact Section -->
        <section class="bg-white p-4 shadow-sm mb-4">
            <h3 class="text-md font-semibold mb-3">Butuh Bantuan?</h3>
            <a href="#" class="flex items-center justify-between p-3 border rounded-lg bg-gray-50 mb-2">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <i class="fab fa-whatsapp text-green-600 text-xl"></i>
                    </div>
                    <span class="font-medium">Hubungi Admin</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400"></i>
            </a>

            <a href="#" class="flex items-center justify-between p-3 border rounded-lg bg-gray-50">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <i class="fas fa-question-circle text-blue-600"></i>
                    </div>
                    <span class="font-medium">FAQ</span>
                </div>
                <i class="fas fa-chevron-right text-gray-400"></i>
            </a>
        </section>
    </main>

    <!-- Bottom Navigation -->
    <nav class="fixed bottom-0 inset-x-0 bg-white shadow-lg z-10">
        <div class="flex justify-around">
            <a href="#" class="flex flex-col items-center p-2 text-red-600">
                <i class="fas fa-home text-xl"></i>
                <span class="text-xs mt-1">Home</span>
            </a>
            <a href="#schedule" class="flex flex-col items-center p-2 text-gray-600">
                <i class="fas fa-calendar-alt text-xl"></i>
                <span class="text-xs mt-1">Jadwal</span>
            </a>
            <a href="#" class="flex flex-col items-center p-2 text-gray-600">
                <i class="fas fa-qrcode text-xl"></i>
                <span class="text-xs mt-1">Check-in</span>
            </a>
            <a href="#" class="flex flex-col items-center p-2 text-gray-600">
                <i class="fas fa-user text-xl"></i>
                <span class="text-xs mt-1">Profil</span>
            </a>
        </div>
    </nav>

    <!-- Tambahkan di bagian body sebelum penutup </body> -->
    <div id="attendanceModal" class="attendance-modal">
        <div class="attendance-modal-content">
            <span class="close" onclick="closeAttendanceModal()">&times;</span>
            <h3 class="text-lg font-semibold mb-4">Absensi Kelas</h3>
            <form id="attendanceForm" method="post" action="process_attendance.php">
                <input type="hidden" name="class_id" id="attendanceClassId">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Kelas:</label>
                    <p class="text-gray-900" id="attendanceClassName"></p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Hari & Jam:</label>
                    <p class="text-gray-900" id="attendanceClassTime"></p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Pelatih:</label>
                    <p class="text-gray-900" id="attendanceClassCoach"></p>
                </div>

                <div class="flex justify-end">
                    <button type="button" onclick="closeAttendanceModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded mr-2">
                        Batal
                    </button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                        Konfirmasi Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka modal absensi
        function openAttendanceModal(classId, className, classDay, classTime, classCoach) {
            document.getElementById('attendanceClassId').value = classId;
            document.getElementById('attendanceClassName').textContent = className;
            document.getElementById('attendanceClassTime').textContent = classDay + ', ' + classTime;
            document.getElementById('attendanceClassCoach').textContent = classCoach;
            document.getElementById('attendanceModal').style.display = 'block';
        }

        // Fungsi untuk menutup modal absensi
        function closeAttendanceModal() {
            document.getElementById('attendanceModal').style.display = 'none';
        }

        // Tutup modal ketika klik di luar
        window.onclick = function (event) {
            if (event.target == document.getElementById('attendanceModal')) {
                closeAttendanceModal();
            }
        }
    </script>
</body>

</html>