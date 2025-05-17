<?php
session_start();



// Pastikan hanya member yang bisa mengakses
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header('Location: ../login.php');
    exit();
}

// Gunakan user_id untuk identifikasi yang lebih aman
$user_id = $_SESSION['user_id'];

// Koneksi database
require_once '../config/db.php';

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

// Ambil riwayat pembayaran
$payments_stmt = $pdo->prepare("SELECT p.*, mp.name as package_name 
                                FROM payments p
                                JOIN membership_packages mp ON p.package_id = mp.id
                                WHERE user_id = ? ORDER BY payment_date DESC LIMIT 5");
$payments_stmt->execute([$user_id]);
$payments = $payments_stmt->fetchAll(PDO::FETCH_ASSOC);

// Proses form pembayaran jika ada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_payment'])) {
    $package_id = $_POST['package_id'];
    $proof_image = '';

    // Handle file upload
    if (isset($_FILES['proof_image']) && $_FILES['proof_image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/payments/';
        $file_name = uniqid() . '_' . basename($_FILES['proof_image']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['proof_image']['tmp_name'], $target_file)) {
            $proof_image = $file_name;
        }
    }

    // Dapatkan detail paket
    $package_stmt = $pdo->prepare("SELECT * FROM membership_packages WHERE id = ?");
    $package_stmt->execute([$package_id]);
    $package = $package_stmt->fetch(PDO::FETCH_ASSOC);

    if ($package) {
        // Buat transaksi pembayaran
        $payment_stmt = $pdo->prepare("INSERT INTO payments 
                                        (user_id, package_id, amount, status, proof_image) 
                                        VALUES (?, ?, ?, 'pending', ?)");
        $payment_stmt->execute([$user_id, $package_id, $package['price'], $proof_image]);

        $_SESSION['message'] = "Pembayaran berhasil dikirim. Tunggu konfirmasi admin.";
        header("Location: memberview.php");
        exit();
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
            background-color: rgba(0,0,0,0.4);
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

        <!-- Welcome Section -->
        <section class="bg-white p-4 shadow-sm mb-4">
            <div class="flex items-center space-x-3 mb-3">
                <div>
                    <h2 class="text-3xl font-bold">Hai, <?= htmlspecialchars($username) ?>!</h2>
                    <!-- <p class="text-sm text-gray-600">Membership aktif hingga: <span class="font-medium text-red-600">20 Mei 2025</span></p> -->
                </div>
            </div>
            <div class="flex justify-between bg-gray-50 rounded-lg p-3">
                <div class="text-center">
                    <p class="text-lg font-bold text-red-600">24</p>
                    <p class="text-xs text-gray-600">Latihan Bulan Ini</p>
                </div>


                <div class="text-center border-l border-r border-gray-300 px-4">
                    <p class="text-lg font-bold text-red-600">148</p>
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
                    <p class="text-sm text-green-600">Paket: <?= htmlspecialchars($active_membership['package_name']) ?></p>
                    <p class="text-sm text-green-600">Berlaku hingga: <?= date('d M Y', strtotime($active_membership['end_date'])) ?></p>
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
                    <button onclick="openPaymentModal(<?= $package['id'] ?>, '<?= htmlspecialchars($package['name']) ?>', <?= $package['price'] ?>)"
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
                            <td class="px-3 py-3 text-sm"><?= date('d M Y', strtotime($payment['payment_date'])) ?></td>
                            <td class="px-3 py-3 text-sm"><?= htmlspecialchars($payment['package_name']) ?></td>
                            <td class="px-3 py-3 text-sm">Rp <?= number_format($payment['amount'], 0, ',', '.') ?></td>
                            <td class="px-3 py-3">
                                <?php 
                                $status_class = '';
                                switch ($payment['status']) {
                                    case 'paid': $status_class = 'bg-green-100 text-green-800'; break;
                                    case 'pending': $status_class = 'bg-yellow-100 text-yellow-800'; break;
                                    case 'rejected': $status_class = 'bg-red-100 text-red-800'; break;
                                    default: $status_class = 'bg-gray-100 text-gray-800';
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
                        <input type="file" name="proof_image" id="proof_image" 
                            class="block w-full text-sm text-gray-500
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
        document.querySelector('.close').onclick = function() {
            document.getElementById('paymentModal').style.display = 'none';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('paymentModal')) {
                document.getElementById('paymentModal').style.display = 'none';
            }
        }
    </script>



        <section id="schedule" class="bg-white p-4 shadow-sm mb-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-md font-semibold">Jadwal</h3>
            </div>

            <!-- Grid with 2 columns -->
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
                                            <span
                                                class="text-xs bg-gray-200 px-2 py-1 rounded-full"><?= htmlspecialchars($class['time']) ?></span>
                                        </div>
                                        <div class="flex text-sm text-gray-500">
                                            <span class="mr-3"><i class="far fa-clock mr-1"></i>
                                                <?= htmlspecialchars($class['time']) ?></span>
                                            <span><i class="far fa-user mr-1"></i> <?= htmlspecialchars($class['coach']) ?></span>
                                        </div>
                                    </div>
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
                                            <span
                                                class="text-xs bg-gray-200 px-2 py-1 rounded-full"><?= htmlspecialchars($class['time']) ?></span>
                                        </div>
                                        <div class="flex text-sm text-gray-500">
                                            <span class="mr-3"><i class="far fa-clock mr-1"></i>
                                                <?= htmlspecialchars($class['time']) ?></span>
                                            <span><i class="far fa-user mr-1"></i> <?= htmlspecialchars($class['coach']) ?></span>
                                        </div>
                                    </div>
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
                        <tr>
                            <td class="px-3 py-3">16 Apr 2025</td>
                            <td class="px-3 py-3">Beginner Class</td>
                            <td class="px-3 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Hadir</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 py-3">15 Apr 2025</td>
                            <td class="px-3 py-3">Sparring Session</td>
                            <td class="px-3 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Hadir</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 py-3">14 Apr 2025</td>
                            <td class="px-3 py-3">Advanced Technique</td>
                            <td class="px-3 py-3">
                                <span
                                    class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Terlambat</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-3 py-3">12 Apr 2025</td>
                            <td class="px-3 py-3">Strength Training</td>
                            <td class="px-3 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Hadir</span>
                            </td>
                        </tr>
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
</body>

</html>