<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Absensi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                            <h1 class="text-xl font-semibold text-gray-800">Attendance System</h1>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-bell"></i>
                            </button>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-question-circle"></i>
                            </button>
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
                                    <h3 class="text-2xl font-bold text-gray-900">124</h3>
                                    <p class="text-sm text-gray-500">Total Attendances Today</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-red-600 h-1 rounded-full" style="width: 78%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">93%</h3>
                                    <p class="text-sm text-gray-500">Member Attendance Rate</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-green-500 h-1 rounded-full" style="width: 93%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">8</h3>
                                    <p class="text-sm text-gray-500">Classes Today</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-blue-500 h-1 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">5</h3>
                                    <p class="text-sm text-gray-500">Trainers On Duty</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-purple-500 h-1 rounded-full" style="width: 83%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date and Class Selection Section -->
                        <div class="bg-white shadow rounded-lg mb-6">
                            <div class="p-6">
                                <div
                                    class="flex flex-col md:flex-row justify-between mb-6 space-y-4 md:space-y-0 md:items-center">
                                    <h2 class="text-lg font-semibold text-gray-800">Attendance Management</h2>
                                    <div class="flex space-x-3">
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-calendar-day text-gray-400"></i>
                                            </div>
                                            <input type="date" value="2025-04-16"
                                                class="block pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                        </div>
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white rounded-md px-4 py-2 text-sm font-medium flex items-center">
                                            <i class="fas fa-qrcode mr-2"></i>
                                            Scan QR
                                        </button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-3 mb-6">
                                    <button class="bg-red-600 text-white py-2 px-4 rounded-md text-sm font-medium">All
                                        Classes</button>
                                    <button
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm">Beginner</button>
                                    <button
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm">Advanced</button>
                                    <button
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm">Sparring</button>
                                    <button
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm">Clinch</button>
                                    <button
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm">Kids</button>
                                    <button
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm">Strength</button>
                                    <button
                                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md text-sm">Private</button>
                                </div>
                            </div>
                        </div>

                        <!-- Current Classes Section -->
                        <div class="bg-white shadow rounded-lg mb-6">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-medium text-gray-900">Current Classes</h3>
                                    <div class="flex space-x-2">
                                        <button class="text-gray-500 hover:text-gray-700 p-1">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        <div class="relative">
                                            <button class="text-gray-500 hover:text-gray-700 p-1">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Class Cards -->
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Class 1 -->
                                    <div class="border rounded-lg overflow-hidden bg-gray-50">
                                        <div class="px-4 py-3 bg-red-600 text-white flex justify-between items-center">
                                            <div class="flex items-center">
                                                <i class="fas fa-fire mr-2"></i>
                                                <span class="font-medium">Advanced Technique</span>
                                            </div>
                                            <div class="text-xs bg-red-800 px-2 py-1 rounded-full">In Progress</div>
                                        </div>
                                        <div class="p-4">
                                            <div class="flex justify-between mb-3">
                                                <div>
                                                    <div class="text-sm text-gray-500">Trainer</div>
                                                    <div class="font-medium">Sarah Nguyen</div>
                                                </div>
                                                <div>
                                                    <div class="text-sm text-gray-500">Time</div>
                                                    <div class="font-medium">16:30 - 18:00</div>
                                                </div>
                                                <div>
                                                    <div class="text-sm text-gray-500">Attendance</div>
                                                    <div class="font-medium">18/20 <span
                                                            class="text-green-600">(90%)</span></div>
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <button
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm">Take
                                                    Attendance</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Class 2 -->
                                    <div class="border rounded-lg overflow-hidden bg-gray-50">
                                        <div class="px-4 py-3 bg-blue-600 text-white flex justify-between items-center">
                                            <div class="flex items-center">
                                                <i class="fas fa-child mr-2"></i>
                                                <span class="font-medium">Kids Program</span>
                                            </div>
                                            <div class="text-xs bg-blue-800 px-2 py-1 rounded-full">In Progress</div>
                                        </div>
                                        <div class="p-4">
                                            <div class="flex justify-between mb-3">
                                                <div>
                                                    <div class="text-sm text-gray-500">Trainer</div>
                                                    <div class="font-medium">Lisa Wong</div>
                                                </div>
                                                <div>
                                                    <div class="text-sm text-gray-500">Time</div>
                                                    <div class="font-medium">15:30 - 17:00</div>
                                                </div>
                                                <div>
                                                    <div class="text-sm text-gray-500">Attendance</div>
                                                    <div class="font-medium">12/15 <span
                                                            class="text-green-600">(80%)</span></div>
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <button
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm">Take
                                                    Attendance</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Today's Attendance Log -->
                        <div class="bg-white shadow rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-medium text-gray-900">Today's Attendance Log</h3>
                                    <div class="flex space-x-3">
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-search text-gray-400"></i>
                                            </div>
                                            <input type="text"
                                                class="block w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                                placeholder="Search members...">
                                        </div>
                                        <button
                                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md px-4 py-2 text-sm font-medium flex items-center">
                                            <i class="fas fa-filter mr-2"></i>
                                            Filter
                                        </button>
                                        <button
                                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md px-4 py-2 text-sm font-medium flex items-center">
                                            <i class="fas fa-download mr-2"></i>
                                            Export
                                        </button>
                                    </div>
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
                                                Trainer
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Check-in Time
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <!-- Attendance Row -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="/api/placeholder/50/50"
                                                            alt="Member photo">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">John Smith</div>
                                                        <div class="text-sm text-gray-500">ID: MT-2023-0125</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Advanced Technique</div>
                                                <div class="text-sm text-gray-500">16:30 - 18:00</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Sarah Nguyen</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">16:25</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Present
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Attendance Row -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="/api/placeholder/50/50"
                                                            alt="Member photo">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Emma Wilson</div>
                                                        <div class="text-sm text-gray-500">ID: MT-2023-0198</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Advanced Technique</div>
                                                <div class="text-sm text-gray-500">16:30 - 18:00</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Sarah Nguyen</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">16:28</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Present
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Attendance Row -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="/api/placeholder/50/50"
                                                            alt="Member photo">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Alex Chen</div>
                                                        <div class="text-sm text-gray-500">ID: MT-2024-0043</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Kids Program</div>
                                                <div class="text-sm text-gray-500">15:30 - 17:00</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Lisa Wong</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">15:35</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Present
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Attendance Row -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="/api/placeholder/50/50"
                                                            alt="Member photo">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Maria Lopez</div>
                                                        <div class="text-sm text-gray-500">ID: MT-2023-0089</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Advanced Technique</div>
                                                <div class="text-sm text-gray-500">16:30 - 18:00</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Sarah Nguyen</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">16:40</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Late
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Attendance Row -->
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" src="/api/placeholder/50/50"
                                                            alt="Member photo">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">Jake Miller</div>
                                                        <div class="text-sm text-gray-500">ID: MT-2024-0067</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Kids Program</div>
                                                <div class="text-sm text-gray-500">15:30 - 17:00</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">Lisa Wong</div>