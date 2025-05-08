<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Member App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                <div class="h-14 w-14 rounded-full bg-gray-200 overflow-hidden">
                    <img src="/api/placeholder/60/60" alt="User" class="h-full w-full object-cover">
                </div>
                <div>
                    <h2 class="text-lg font-bold">Hai, John Smith!</h2>
                    <p class="text-sm text-gray-600">Membership aktif hingga: <span class="font-medium text-red-600">20
                            Mei 2025</span></p>
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
                    <p class="text-lg font-bold text-green-600">Aktif</p>
                    <p class="text-xs text-gray-600">Status Membership</p>
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

        <!-- Next Class -->
        <section class="bg-white p-4 shadow-sm mb-4">
            <h3 class="text-md font-semibold mb-3">Kelas Selanjutnya</h3>
            <div class="border rounded-lg overflow-hidden">
                <div class="px-4 py-3 bg-red-600 text-white flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-fire mr-2"></i>
                        <span class="font-medium">Advanced Technique</span>
                    </div>
                    <div class="text-xs bg-red-800 px-2 py-1 rounded-full">Hari Ini</div>
                </div>
                <div class="p-4 bg-gray-50">
                    <div class="flex justify-between mb-3">
                        <div>
                            <div class="text-sm text-gray-500">Pelatih</div>
                            <div class="font-medium">Sarah Nguyen</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Jam</div>
                            <div class="font-medium">16:30 - 18:00</div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm flex items-center">
                            <i class="fas fa-qrcode mr-2"></i>
                            Check-in
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Today's Schedule -->
        <section id="schedule" class="bg-white p-4 shadow-sm mb-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-md font-semibold">Jadwal Hari Ini</h3>
                <a href="#" class="text-sm text-red-600">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                <!-- Class -->
                <div class="flex items-center p-3 border rounded-lg bg-gray-50">
                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                        <i class="fas fa-dumbbell text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h4 class="font-medium">Beginner Class</h4>
                            <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">Selesai</span>
                        </div>
                        <div class="flex text-sm text-gray-500">
                            <span class="mr-3"><i class="far fa-clock mr-1"></i> 08:00 - 09:30</span>
                            <span><i class="far fa-user mr-1"></i> Mike Johnson</span>
                        </div>
                    </div>
                </div>

                <!-- Class -->
                <div class="flex items-center p-3 border rounded-lg bg-gray-50">
                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                        <i class="fas fa-fire text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h4 class="font-medium">Advanced Technique</h4>
                            <span class="text-xs bg-green-200 text-green-800 px-2 py-1 rounded-full">Upcoming</span>
                        </div>
                        <div class="flex text-sm text-gray-500">
                            <span class="mr-3"><i class="far fa-clock mr-1"></i> 16:30 - 18:00</span>
                            <span><i class="far fa-user mr-1"></i> Sarah Nguyen</span>
                        </div>
                    </div>
                </div>

                <!-- Class -->
                <div class="flex items-center p-3 border rounded-lg bg-gray-50">
                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                        <i class="fas fa-fist-raised text-red-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h4 class="font-medium">Sparring Session</h4>
                            <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">19:00</span>
                        </div>
                        <div class="flex text-sm text-gray-500">
                            <span class="mr-3"><i class="far fa-clock mr-1"></i> 19:00 - 20:30</span>
                            <span><i class="far fa-user mr-1"></i> David Park</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

        <!-- Payment -->
        <section id="payment" class="bg-white p-4 shadow-sm mb-4">
            <h3 class="text-md font-semibold mb-3">Informasi Pembayaran</h3>
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-green-800">Membership Aktif</h4>
                        <p class="text-sm text-green-600">Pembayaran berikutnya: 20 Mei 2025</p>
                    </div>
                </div>
            </div>

            <div class="border rounded-lg overflow-hidden">
                <div class="p-4 bg-gray-50">
                    <div class="flex justify-between mb-3">
                        <div>
                            <div class="text-sm text-gray-500">Paket</div>
                            <div class="font-medium">Kelas Unlimited</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Harga</div>
                            <div class="font-medium">Rp 500,000</div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm">Perpanjang</button>
                    </div>
                </div>
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
                                <img src="../admin/uploads/trainers    <?= htmlspecialchars($trainer['cover_photo']) ?>" alt="Trainer"
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