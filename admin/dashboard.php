<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}


// Pastikan hanya admin yang bisa mengakses
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Koneksi database
require_once '../config/db.php';

// Pastikan koneksi berhasil
if (!$pdo) {
    die("Koneksi database gagal");
}

// Ambil total anggota
$stmt = $pdo->query("SELECT COUNT(*) as total_members FROM users WHERE role != 'admin'");
$total_members = $stmt->fetch()['total_members'];

// Ambil jumlah kelas aktif
$stmt = $pdo->query("SELECT COUNT(*) as active_classes FROM class_schedule");
$active_classes = $stmt->fetch()['active_classes'];

// Ambil jumlah pelatih
$stmt = $pdo->query("SELECT COUNT(*) as total_trainers FROM trainers");
$total_trainers = $stmt->fetch()['total_trainers'];

// Ambil pembayaran terakhir
$stmt = $pdo->query("SELECT SUM(amount) as total_revenue FROM payments WHERE status = 'paid'");
$total_revenue = $stmt->fetch()['total_revenue'];

// Mengambil data pembayaran untuk grafik (bulan terakhir, status 'paid')
$data = [];
$stmt = $pdo->query("SELECT COUNT(*) as total, MONTH(payment_date) as month 
                     FROM payments 
                     WHERE status = 'paid' 
                     GROUP BY month 
                     ORDER BY month DESC 
                     LIMIT 12");

while ($row = $stmt->fetch()) {
    $data[] = $row;
}



// Encode data untuk digunakan di JavaScript
$data_json = json_encode($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <?php include '../partials/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
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
                            <h1 class="text-xl font-semibold text-gray-800">Admin Dashboard</h1>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                        <!-- Statistics Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                            <i class="fas fa-users text-red-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Total Members
                                                </dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">
                                                        <?= $total_members ?></div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                            <i class="fas fa-calendar-alt text-red-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Active Classes
                                                </dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">
                                                        <?= $active_classes ?></div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                            <i class="fas fa-user-tie text-red-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Trainers</dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">
                                                        <?= $total_trainers ?></div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Total Revenue -->
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                            <i class="fas fa-dollar-sign text-green-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue
                                                    (IDR)</dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">Rp
                                                        <?= number_format($total_revenue, 0, ',', '.') ?></div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Revenue Chart -->
                        <div class="bg-white shadow rounded-lg p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Revenue Chart (Last 12 Months)</h2>
                            <canvas id="revenueChart"></canvas>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>

        // Pastikan Anda menggunakan data yang benar yang dikirim dari PHP
        const chartData = <?php echo $data_json; ?>;

        console.log(chartData);  // Debugging data

        // Menyiapkan label bulan dan data revenue untuk grafik
        const months = chartData.map(data => `Month ${data.month}`);
        const revenues = chartData.map(data => data.total);

        console.log(months);  // Debugging label
        console.log(revenues);  // Debugging data

        // Membuat grafik
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Revenue (in IDR)',
                    data: revenues,
                    borderColor: '#FF5733',
                    backgroundColor: 'rgba(255, 87, 51, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                }
            }
        });
    </script>


</body>

</html>