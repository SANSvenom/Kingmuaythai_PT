<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Absensi - King Muaythai</title>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-white w-64 shadow-lg hidden md:block">
            <div class="p-6 flex items-center justify-center border-b">
                <div class="flex flex-col items-center">
                    <img src="../image/LOGOKING.png" alt="King Muaythai Logo" class="h-12 w-12 rounded-full">
                    <h2 class="mt-2 text-xl font-bold text-gray-800">King Muaythai</h2>
                </div>
            </div>

            <nav class="mt-6">
                <div>
                    <a href="dashboard.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-th-large mr-3"></i>
                        <span class="mx-3">Dashboard</span>
                    </a>

                    <a href="members.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-users mr-3"></i>
                        <span class="mx-3">Members</span>
                    </a>

                    <a href="classes.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        <span class="mx-3">Classes</span>
                    </a>

                    <a href="trainers.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-user-tie mr-3"></i>
                        <span class="mx-3">Trainers</span>
                    </a>

                    <a href="absensi.php" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700">
                        <i class="fas fa-calendar-check mr-3"></i>
                        <span class="mx-3">Absensi</span>
                    </a>

                    <a href="payment.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-credit-card mr-3"></i>
                        <span class="mx-3">Payment</span>
                    </a>
                </div>
            </nav>

            <div class="absolute bottom-0 my-8 w-64">
                <a href="settings.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                    <i class="fas fa-cog mr-3"></i>
                    <span class="mx-3">Settings</span>
                </a>
                <a href="logout.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-red-500">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span class="mx-3">Logout</span>
                </a>
            </div>
        </div>

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
                            <h1 class="text-xl font-semibold text-gray-800">Attendance System</h1>
                        </div>
                        <div class="flex items-center">
                            <div class="ml-3 relative">
                                <div>
                                    <button
                                        class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-red-500">
                                        <img class="h-8 w-8 rounded-full" src="/api/placeholder/32/32"
                                            alt="User profile">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        
                        <!-- Date and class selection -->
                        <div class="mb-6">
                            <div class="bg-white shadow rounded-lg p-6">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1">
                                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
                                        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    </div>
                                    <div class="flex-1">
                                        <label for="class" class="block text-sm font-medium text-gray-700 mb-1">Select Class</label>
                                        <select id="class" name="class"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                            <option value="">All Classes</option>
                                            <option value="1">Morning Conditioning (6:00 AM)</option>
                                            <option value="2">Beginner's Muay Thai (9:30 AM)</option>
                                            <option value="3">Advanced Techniques (4:00 PM)</option>
                                            <option value="4">Evening Combat (7:00 PM)</option>
                                        </select>
                                    </div>
                                    <div class="flex-1">
                                        <label for="trainer" class="block text-sm font-medium text-gray-700 mb-1">Select Trainer</label>
                                        <select id="trainer" name="trainer"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                            <option value="">All Trainers</option>
                                            <option value="1">Coach Mike</option>
                                            <option value="2">Coach Sarah</option>
                                            <option value="3">Coach Alex</option>
                                            <option value="4">Coach David</option>
                                        </select>
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button"
                                            class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md text-sm">
                                            Filter
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-white shadow rounded-lg p-4 flex items-center">
                                <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                    <i class="fas fa-users text-red-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Present</p>
                                    <p class="text-lg font-semibold">42</p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex items-center">
                                <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                    <i class="fas fa-user-times text-red-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Total Absent</p>
                                    <p class="text-lg font-semibold">12</p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex items-center">
                                <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                    <i class="fas fa-percentage text-red-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Attendance Rate</p>
                                    <p class="text-lg font-semibold">78%</p>
                                </div>
                            </div>
                            <div class="bg-white shadow rounded-lg p-4 flex items-center">
                                <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                    <i class="fas fa-calendar-check text-red-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Classes Today</p>
                                    <p class="text-lg font-semibold">4</p>
                                </div>
                            </div>
                        </div>

                        <!-- Attendance Management Tabs -->
                        <div class="bg-white shadow rounded-lg mb-6">
                            <div class="border-b border-gray-200">
                                <nav class="flex -mb-px">
                                    <a href="#"
                                        class="border-red-500 text-red-600 w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                                        Today's Attendance
                                    </a>
                                    <a href="#"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                                        Attendance History
                                    </a>
                                    <a href="#"
                                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm">
                                        Reports
                                    </a>
                                </nav>
                            </div>

                            <!-- Attendance List -->
                            <div class="p-6">
                                <div class="mb-4 flex justify-between items-center">
                                    <h3 class="text-lg font-medium text-gray-900">Member Attendance</h3>
                                    <div class="flex space-x-2">
                                        <button class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-md text-sm flex items-center">
                                            <i class="fas fa-plus mr-1"></i> Mark All Present
                                        </button>
                                        <button class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 py-1 px-3 rounded-md text-sm flex items-center">
                                            <i class="fas fa-download mr-1"></i> Export
                                        </button>
                                    </div>
                                </div>

                                <!-- Search Bar -->
                                <div class="mb-4">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-search text-gray-400"></i>
                                        </div>
                                        <input type="text" placeholder="Search members..."
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Member
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Class
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Time
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Trainer
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div class="h-10 w-10 rounded-full bg-red-500 flex items-center justify-center text-white">
                                                                JD
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">John Doe</div>
                                                            <div class="text-sm text-gray-500">Premium Plan</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Morning Conditioning</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">6:00 AM</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Coach Mike</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Present
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-2">
                                                        <button class="text-gray-500 hover:text-gray-700">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div class="h-10 w-10 rounded-full bg-yellow-500 flex items-center justify-center text-white">
                                                                SP
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">Sarah Parker</div>
                                                            <div class="text-sm text-gray-500">Standard Plan</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Beginner's Muay Thai</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">9:30 AM</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Coach Sarah</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Absent
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-2">
                                                        <button class="text-gray-500 hover:text-gray-700">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center text-white">
                                                                MT
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">Michael Thompson</div>
                                                            <div class="text-sm text-gray-500">Basic Plan</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Advanced Techniques</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">4:00 PM</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Coach Alex</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Present
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-2">
                                                        <button class="text-gray-500 hover:text-gray-700">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                                                AJ
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">Amanda Johnson</div>
                                                            <div class="text-sm text-gray-500">Premium Plan</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Evening Combat</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">7:00 PM</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Coach David</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Late
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-2">
                                                        <button class="text-gray-500 hover:text-gray-700">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div class="h-10 w-10 rounded-full bg-purple-500 flex items-center justify-center text-white">
                                                                RW
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">Robert Wilson</div>
                                                            <div class="text-sm text-gray-500">Standard Plan</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Morning Conditioning</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">6:00 AM</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">Coach Mike</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Present
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-2">
                                                        <button class="text-gray-500 hover:text-gray-700">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        <a href="#"
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Previous
                                        </a>
                                        <a href="#"
                                            class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Next
                                        </a>
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm text-gray-700">
                                                Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span
                                                    class="font-medium">42</span> results
                                            </p>
                                        </div>
                                        <div>
                                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                                <a href="#"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    <span class="sr-only">Previous</span>
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                                <a href="#"
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-red-50 text-sm font-medium text-red-600 hover:bg-red-100">
                                                    1
                                                </a>
                                                <a href="#"
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    2
                                                </a>
                                                <a href="#"
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    3
                                                </a>
                                                <span
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                    ...
                                                </span>
                                                <a href="#"
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    8
                                                </a>
                                                <a href="#"
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    9
                                                </a>
                                                <a href="#"
                                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                    <span class="sr-only">Next</span>
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Record Attendance Form -->
                        <div class="bg-white shadow rounded-lg p-6 mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Record New Attendance</h3>
                            <form action="#" method="post">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="member_id" class="block text-sm font-medium text-gray-700 mb-1">Select Member</label>
                                        <select id="member_id" name="member_id" required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                            <option value="">Select a member</option>
                                            <option value="1">John Doe</option>
                                            <option value="2">Sarah Parker</option>
                                            <option value="3">Michael Thompson</option>
                                            <option value="4">Amanda Johnson</option>
                                            <option value="5">Robert Wilson</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="class_id" class="block text-sm font-medium text-gray-700 mb-1">Select Class</label>
                                        <select id="class_id" name="class_id" required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                            <option value="">Select a class</option>
                                            <option value="1">Morning Conditioning (6:00 AM)</option>
                                            <option value="2">Beginner's Muay Thai (9:30 AM)</option>
                                            <option value="3">Advanced Techniques (4:00 PM)</option>
                                            <option value="4">Evening Combat (7:00 PM)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Attendance Status</label>
                                        <select id="status" name="status" required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                            <option value="present">Present</option>
                                            <option value="absent">Absent</option>
                                            <option value="late">Late</option>
                                            <option value="excused">Excused</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="attendance_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                        <input type="date" id="attendance_date" name="attendance_date" value="<?php echo date('Y-m-d'); ?>" required
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                                        <textarea id="notes" name="notes" rows="3" 
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm" 
                                            placeholder="Add any relevant notes about the attendance..."></textarea>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md">
                                        Save Attendance
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Attendance Analytics -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <!-- Weekly Attendance Chart -->
                            <div class="bg-white shadow rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Weekly Attendance</h3>
                                <div class="h-64 flex items-end space-x-2">
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full bg-red-800 h-40 rounded-t"></div>
                                        <div class="text-xs text-gray-500 mt-1">Mon</div>
                                    </div>
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full bg-red-800 h-52 rounded-t"></div>
                                        <div class="text-xs text-gray-500 mt-1">Tue</div>
                                    </div>
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full bg-red-800 h-36 rounded-t"></div>
                                        <div class="text-xs text-gray-500 mt-1">Wed</div>
                                    </div>
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full bg-red-800 h-48 rounded-t"></div>
                                        <div class="text-xs text-gray-500 mt-1">Thu</div>
                                    </div>
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full bg-red-800 h-44 rounded-t"></div>
                                        <div class="text-xs text-gray-500 mt-1">Fri</div>
                                    </div>
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full bg-red-800 h-60 rounded-t"></div>
                                        <div class="text-xs text-gray-500 mt-1">Sat</div>
                                    </div>
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full bg-red-800 h-32 rounded-t"></div>
                                        <div class="text-xs text-gray-500 mt-1">Sun</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Attendance By Class -->
                            <div class="bg-white shadow rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Attendance By Class</h3>
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">Morning Conditioning</span>
                                            <span class="text-sm font-medium text-gray-700">85%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-red-600 h-2.5 rounded-full" style="width: 85%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">Beginner's Muay Thai</span>
                                            <span class="text-sm font-medium text-gray-700">72%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-red-600 h-2.5 rounded-full" style="width: 72%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">Advanced Techniques</span>
                                            <span class="text-sm font-medium text-gray-700">94%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-red-600 h-2.5 rounded-full" style="width: 94%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="text-sm font-medium text-gray-700">Evening Combat</span>
                                            <span class="text-sm font-medium text-gray-700">78%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-red-600 h-2.5 rounded-full" style="width: 78%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-4">
                            <button class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-download mr-2"></i>
                                Export Attendance Report
                            </button>
                            <button class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-envelope mr-2"></i>
                                Send Absentee Notifications
                            </button>
                            <button class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-cog mr-2"></i>
                                Attendance Settings
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div id="mobile-menu" class="md:hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
        <div class="bg-white w-64 min-h-screen">
            <div class="p-6 flex items-center justify-between border-b">
                <div class="flex items-center">
                    <img src="/api/placeholder/40/40" alt="Logo" class="h-8 w-8 rounded-full">
                    <h2 class="ml-2 text-xl font-bold text-gray-800">King Muaythai</h2>
                </div>
                <button id="close-menu-button" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <nav class="mt-6">
                <div>
                    <a href="dashboard.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-th-large mr-3"></i>
                        <span class="mx-3">Dashboard</span>
                    </a>

                    <a href="members.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-users mr-3"></i>
                        <span class="mx-3">Members</span>
                    </a>

                    <a href="classes.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-calendar-alt mr-3"></i>
                        <span class="mx-3">Classes</span>
                    </a>

                    <a href="trainers.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-user-tie mr-3"></i>
                        <span class="mx-3">Trainers</span>
                    </a>

                    <a href="absensi.php" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700">
                        <i class="fas fa-calendar-check mr-3"></i>
                        <span class="mx-3">Absensi</span>
                    </a>

                    <a href="payment.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-credit-card mr-3"></i>
                        <span class="mx-3">Payment</span>
                    </a>
                </div>
            </nav>

            <div class="absolute bottom-0 my-8 w-64">
                <a href="settings.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                    <i class="fas fa-cog mr-3"></i>
                    <span class="mx-3">Settings</span>
                </a>
                <a href="logout.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-red-500">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span class="mx-3">Logout</span>
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript for mobile menu toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menu-button');
            const closeMenuButton = document.getElementById('close-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            menuButton.addEventListener('click', function() {
                mobileMenu.classList.remove('hidden');
            });

            closeMenuButton.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    </script>
</body>

</html>

                                                    
