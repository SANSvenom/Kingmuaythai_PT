<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar -->
<div class="bg-white w-64 shadow-lg hidden md:block">
    <div class="p-6 flex items-center justify-center border-b">
        <div class="flex flex-col items-center">
            <img src="../image/LOGOKING.png" alt="King Muaythai Logo" class="h-14 w-14 rounded-full">
            <h2 class="mt-2 text-xl font-bold text-gray-800">King Muaythai</h2>
        </div>
    </div>

    <nav class="mt-6">
        <div>
            <a href="dashboard.php" class="flex items-center px-6 py-3 <?= $current_page == 'dashboard.php' ? 'bg-gray-200' : 'hover:bg-gray-100' ?> text-gray-700">
                <i class="fas fa-th-large mr-3"></i>
                <span class="mx-3">Dashboard</span>
            </a>

            <a href="members.php" class="flex items-center px-6 py-3 <?= $current_page == 'members.php' ? 'bg-gray-200' : 'hover:bg-gray-100' ?> text-gray-700">
                <i class="fas fa-users mr-3"></i>
                <span class="mx-3">Members</span>
            </a>

            <a href="classes.php" class="flex items-center px-6 py-3 <?= $current_page == 'classes.php' ? 'bg-gray-200' : 'hover:bg-gray-100' ?> text-gray-700">
                <i class="fas fa-calendar-alt mr-3"></i>
                <span class="mx-3">Classes</span>
            </a>

            <a href="trainers.php" class="flex items-center px-6 py-3 <?= $current_page == 'trainers.php' ? 'bg-gray-200' : 'hover:bg-gray-100' ?> text-gray-700">
                <i class="fas fa-user-tie mr-3"></i>
                <span class="mx-3">Trainers</span>
            </a>

            <a href="absensi.php" class="flex items-center px-6 py-3 <?= $current_page == 'absensi.php' ? 'bg-gray-200' : 'hover:bg-gray-100' ?> text-gray-700">
                <i class="fas fa-calendar-times mr-3"></i>
                <span class="mx-3">Absensi</span>
            </a>

            <a href="payment.php" class="flex items-center px-6 py-3 <?= $current_page == 'payment.php' ? 'bg-gray-200' : 'hover:bg-gray-100' ?> text-gray-700">
                <i class="fas fa-credit-card mr-3"></i>
                <span class="mx-3">Payment</span>
            </a>
        </div>
    </nav>

    <div class="absolute bottom-0 my-8 w-64">
        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
            <i class="fas fa-cog mr-3"></i>
            <span class="mx-3">Settings</span>
        </a>
        <a href="login.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-red-500">
            <i class="fas fa-sign-out-alt mr-3"></i>
            <span class="mx-3">Logout</span>
        </a>
    </div>
</div>
