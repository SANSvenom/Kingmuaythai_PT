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
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <title>Dashboard</title>
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
                                                    <div class="text-2xl font-semibold text-gray-900">248</div>
                                                    <div
                                                        class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
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
                                            <i class="fas fa-calendar-alt text-red-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Active Classes
                                                </dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">42</div>
                                                    <div
                                                        class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                                        <i class="fas fa-arrow-up"></i>
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
                                        <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                            <i class="fas fa-user-tie text-red-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Trainers</dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">8</div>
                                                    <div
                                                        class="ml-2 flex items-baseline text-sm font-medium text-gray-500">
                                                        <span class="ml-1">No change</span>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Members and Tasks Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- Recent Members -->
                            <div class="bg-white shadow rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-lg font-medium text-gray-900">Recent Members</h2>
                                    <a href="/admin/members.php" class="text-sm text-red-600 hover:text-red-500">View All</a>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white text-sm">
                                                JD</div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium">John Doe</div>
                                                <div class="text-xs text-gray-500">Premium Plan</div>
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500">Today</div>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-white text-sm">
                                                SP</div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium">Sarah Parker</div>
                                                <div class="text-xs text-gray-500">Standard Plan</div>
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500">Yesterday</div>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm">
                                                MT</div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium">Michael Thompson</div>
                                                <div class="text-xs text-gray-500">Basic Plan</div>
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500">3 days ago</div>
                                    </div>

                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm">
                                                AJ</div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium">Amanda Johnson</div>
                                                <div class="text-xs text-gray-500">Premium Plan</div>
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500">1 week ago</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tasks -->
                            <div class="bg-white shadow rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-lg font-medium text-gray-900">Your Tasks</h2>
                                    <a href="#" class="text-sm text-red-600 hover:text-red-500">View All</a>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="h-5 w-5 mr-3 rounded border border-gray-300"></div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium">Update training schedule</div>
                                            <div class="text-xs text-gray-500">Due today</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="h-5 w-5 mr-3 rounded border border-gray-300"></div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium">Call new equipment supplier</div>
                                            <div class="text-xs text-gray-500">Due tomorrow</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div
                                            class="h-5 w-5 mr-3 rounded border border-gray-300 bg-red-600 flex items-center justify-center text-white">
                                            <i class="fas fa-check text-xs"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium">Review new member applications</div>
                                            <div class="text-xs text-gray-500">Completed</div>
                                        </div>
                                    </div>

                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="h-5 w-5 mr-3 rounded border border-gray-300"></div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium">Prepare for weekend tournament</div>
                                            <div class="text-xs text-gray-500">Due in 3 days</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex gap-4">
                            <a href="members.php" class="bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                Manage Members
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</html>