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
    <title>Payment Management</title>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
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

                    <a href="absensi.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                        <i class="fas fa-calendar-times mr-3"></i>
                        <span class="mx-3">Absensi</span>
                    </a>

                    <a href="payment.php" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700">
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
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 text-red-500">
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
                            <h1 class="text-xl font-semibold text-gray-800">Payment Management</h1>
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

                        <!-- Payment Statistics Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                            <i class="fas fa-check-circle text-green-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Paid Invoices
                                                </dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">182</div>
                                                    <div
                                                        class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                                        <i class="fas fa-arrow-up"></i>
                                                        <span class="ml-1">8%</span>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                                            <i class="fas fa-exclamation-circle text-yellow-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Pending Payments
                                                </dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">24</div>
                                                    <div
                                                        class="ml-2 flex items-baseline text-sm font-semibold text-red-600">
                                                        <i class="fas fa-arrow-up"></i>
                                                        <span class="ml-1">12%</span>
                                                    </div>
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
                                            <i class="fas fa-times-circle text-red-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Overdue Payments
                                                </dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">15</div>
                                                    <div
                                                        class="ml-2 flex items-baseline text-sm font-semibold text-red-600">
                                                        <i class="fas fa-arrow-down"></i>
                                                        <span class="ml-1">5%</span>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                            <i class="fas fa-dollar-sign text-blue-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue
                                                </dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">$24,850</div>
                                                    <div
                                                        class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                                        <i class="fas fa-arrow-up"></i>
                                                        <span class="ml-1">15%</span>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Controls -->
                        <div class="bg-white shadow rounded-lg p-6 mb-6">
                            <div
                                class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 mb-4">
                                <h2 class="text-lg font-medium text-gray-900">Payment Management</h2>
                                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                                    <div class="relative">
                                        <input type="text" placeholder="Search member..."
                                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-search text-gray-400"></i>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <select
                                            class="block pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm rounded-md">
                                            <option>All Status</option>
                                            <option>Paid</option>
                                            <option>Pending</option>
                                            <option>Overdue</option>
                                        </select>
                                        <button
                                            class="bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded-md flex items-center">
                                            <i class="fas fa-plus mr-2"></i>
                                            New Payment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Table -->
                        <div class="bg-white shadow rounded-lg mb-6 overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Invoice ID
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Member
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Plan
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Due Date
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <!-- Payment Row 1 -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                #INV-2023001
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-8 w-8 rounded-full bg-red-500 flex items-center justify-center text-white text-sm">
                                                        JD
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">John Doe</div>
                                                        <div class="text-sm text-gray-500">johndoe@example.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Premium Plan</div>
                                                <div class="text-xs text-gray-500">Monthly</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $120.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Apr 15, 2025
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Paid
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-gray-600 hover:text-gray-900">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Payment Row 2 -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                #INV-2023002
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center text-white text-sm">
                                                        SP
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Sarah Parker
                                                        </div>
                                                        <div class="text-sm text-gray-500">sarah@example.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Standard Plan</div>
                                                <div class="text-xs text-gray-500">Monthly</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $85.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Apr 20, 2025
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-bell"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Payment Row 3 -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                #INV-2023003
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-8 w-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm">
                                                        MT
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Michael Thompson
                                                        </div>
                                                        <div class="text-sm text-gray-500">michael@example.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Basic Plan</div>
                                                <div class="text-xs text-gray-500">Monthly</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $60.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Apr 10, 2025
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Overdue
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-bell"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Payment Row 4 -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                #INV-2023004
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm">
                                                        AJ
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Amanda Johnson
                                                        </div>
                                                        <div class="text-sm text-gray-500">amanda@example.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Premium Plan</div>
                                                <div class="text-xs text-gray-500">Quarterly</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $320.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Apr 30, 2025
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Paid
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-gray-600 hover:text-gray-900">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Payment Row 5 -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                #INV-2023005
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center text-white text-sm">
                                                        RK
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Robert King</div>
                                                        <div class="text-sm text-gray-500">robert@example.com</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Standard Plan</div>
                                                <div class="text-xs text-gray-500">Annual</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $850.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                May 5, 2025
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <div class="flex space-x-2">
                                                    <button class="text-blue-600 hover:text-blue-900">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-bell"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div
                                class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
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
                                            Showing <span class="font-medium">1</span> to <span
                                                class="font-medium">5</span> of <span class="font-medium">30</span>
                                            results
                                        </p>
                                    </div>
                                    <div>
                                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                            aria-label="Pagination">
                                            <a href="#"
                                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Previous</span>
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-red-600 text-sm font-medium text-white hover:bg-red-700">
                                                1
                                            </a>
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                2
                                            </a>
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                3
                                            </a>
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                                                ...
                                            </span>
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                6
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

                        <!-- Recent Payment Activity -->
                        <!-- Recent Payment Activity -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                            <!-- Recent Activity -->
                            <div class="lg:col-span-2 bg-white shadow rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-lg font-medium text-gray-900">Recent Payment Activity</h2>
                                    <a href="#" class="text-sm text-red-600 hover:text-red-500">View All</a>
                                </div>
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-check text-green-600"></i>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Payment received from
                                                        <span class="font-semibold">John Doe</span></p>
                                                    <p class="text-xs text-gray-500">Premium Plan - $120.00</p>
                                                </div>
                                                <p class="text-xs text-gray-500">10 minutes ago</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                            <i class="fas fa-bell text-red-600"></i>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Payment reminder sent
                                                        to <span class="font-semibold">Michael Thompson</span></p>
                                                    <p class="text-xs text-gray-500">Basic Plan - $60.00 (Overdue)</p>
                                                </div>
                                                <p class="text-xs text-gray-500">1 hour ago</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-file-invoice text-blue-600"></i>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">New invoice created for
                                                        <span class="font-semibold">Emily Wilson</span></p>
                                                    <p class="text-xs text-gray-500">Standard Plan - $85.00</p>
                                                </div>
                                                <p class="text-xs text-gray-500">3 hours ago</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <i class="fas fa-check text-green-600"></i>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Payment received from
                                                        <span class="font-semibold">Amanda Johnson</span></p>
                                                    <p class="text-xs text-gray-500">Premium Plan (Quarterly) - $320.00
                                                    </p>
                                                </div>
                                                <p class="text-xs text-gray-500">Yesterday</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                            <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Payment due soon for
                                                        <span class="font-semibold">David Clark</span></p>
                                                    <p class="text-xs text-gray-500">Basic Plan - $60.00 (Due in 2 days)
                                                    </p>
                                                </div>
                                                <p class="text-xs text-gray-500">Yesterday</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Info & Quick Actions -->
                            <div class="lg:col-span-1 bg-white shadow rounded-lg p-6">
                                <div class="mb-6">
                                    <h2 class="text-lg font-medium text-gray-900 mb-4">Payment Methods</h2>
                                    <div class="space-y-3">
                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-credit-card text-blue-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">Card Payments</p>
                                                <p class="text-xs text-gray-500">Visa, Mastercard, AMEX</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-money-bill-wave text-green-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">Cash Payments</p>
                                                <p class="text-xs text-gray-500">At reception desk</p>
                                            </div>
                                        </div>

                                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                <i class="fas fa-university text-purple-600"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">Bank Transfer</p>
                                                <p class="text-xs text-gray-500">Direct deposit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h2>
                                    <div class="space-y-3">
                                        <button
                                            class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="fas fa-plus mr-2"></i>
                                            Create New Invoice
                                        </button>

                                        <button
                                            class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="fas fa-file-export mr-2"></i>
                                            Export Payment Data
                                        </button>

                                        <button
                                            class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="fas fa-cog mr-2"></i>
                                            Payment Settings
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Plans Summary -->
                        <div class="bg-white shadow rounded-lg p-6 mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-medium text-gray-900">Payment Plans Summary</h2>
                                <a href="#" class="text-sm text-red-600 hover:text-red-500">Manage Plans</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Plan Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Monthly Price
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quarterly Price
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Annual Price
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Active Members
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">Basic Plan</div>
                                                <div class="text-xs text-gray-500">Limited classes per week</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $60.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $170.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $650.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                62
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">Standard Plan</div>
                                                <div class="text-xs text-gray-500">Regular training package</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $85.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $240.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $850.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                94
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">Premium Plan</div>
                                                <div class="text-xs text-gray-500">Unlimited classes + perks</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $120.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $320.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                $1,200.00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                92
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-4 mb-6">
                            <button
                                class="bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-bell mr-2"></i>
                                Send Payment Reminders
                            </button>
                            <button
                                class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-file-invoice mr-2"></i>
                                Generate Monthly Report
                            </button>
                            <button
                                class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-cog mr-2"></i>
                                Payment Settings
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state -->
    <div id="mobile-menu" class="md:hidden fixed inset-0 z-40 hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        <div class="fixed inset-y-0 left-0 flex flex-col w-full max-w-xs bg-white">
            <div class="p-6 flex items-center justify-between border-b">
                <div class="flex items-center">
                    <img src="../image/LOGOKING.png" alt="King Muaythai Logo" class="h-10 w-10 rounded-full">
                    <h2 class="ml-3 text-xl font-bold text-gray-800">King Muaythai</h2>
                </div>
                <button id="close-menu" class="text-gray-500 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="overflow-y-auto">
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

                        <a href="absensi.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
                            <i class="fas fa-calendar-times mr-3"></i>
                            <span class="mx-3">Absensi</span>
                        </a>

                        <a href="payment.php" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700">
                            <i class="fas fa-credit-card mr-3"></i>
                            <span class="mx-3">Payment</span>
                        </a>
                    </div>
                </nav>
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
    </script>
</body>

</html>