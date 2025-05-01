<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Classes</title>
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
                            <h1 class="text-xl font-semibold text-gray-800">Classes</h1>
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
                                    <h3 class="text-2xl font-bold text-gray-900">32</h3>
                                    <p class="text-sm text-gray-500">Total Classes</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-red-600 h-1 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">28</h3>
                                    <p class="text-sm text-gray-500">Active Classes</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-green-500 h-1 rounded-full" style="width: 87%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">12</h3>
                                    <p class="text-sm text-gray-500">Trainers</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-blue-500 h-1 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">185</h3>
                                    <p class="text-sm text-gray-500">Total Enrollments</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-purple-500 h-1 rounded-full" style="width: 92%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calendar Section -->
                        <div class="bg-white shadow rounded-lg p-6 mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-lg font-medium text-gray-900">April 2025</h2>
                                <div class="flex space-x-2">
                                    <button class="p-2 rounded-md text-gray-500 hover:bg-gray-100">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="p-2 rounded-md text-gray-500 hover:bg-gray-100">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-7 gap-2 text-center mb-2">
                                <div class="text-sm font-medium text-gray-500">Sun</div>
                                <div class="text-sm font-medium text-gray-500">Mon</div>
                                <div class="text-sm font-medium text-gray-500">Tue</div>
                                <div class="text-sm font-medium text-gray-500">Wed</div>
                                <div class="text-sm font-medium text-gray-500">Thu</div>
                                <div class="text-sm font-medium text-gray-500">Fri</div>
                                <div class="text-sm font-medium text-gray-500">Sat</div>
                            </div>

                            <div class="grid grid-cols-7 gap-2 text-center">
                                <div class="text-sm p-2 text-gray-400">30</div>
                                <div class="text-sm p-2 text-gray-400">31</div>
                                <div class="text-sm p-2">1</div>
                                <div class="text-sm p-2">2</div>
                                <div class="text-sm p-2">3</div>
                                <div class="text-sm p-2">4</div>
                                <div class="text-sm p-2">5</div>
                                <div class="text-sm p-2">6</div>
                                <div class="text-sm p-2">7</div>
                                <div class="text-sm p-2">8</div>
                                <div class="text-sm p-2">9</div>
                                <div class="text-sm p-2">10</div>
                                <div class="text-sm p-2">11</div>
                                <div class="text-sm p-2">12</div>
                                <div class="text-sm p-2">13</div>
                                <div class="text-sm p-2">14</div>
                                <div
                                    class="text-sm p-2 bg-red-100 rounded-lg font-medium text-red-800 border border-red-200">
                                    15</div>
                                <div class="text-sm p-2">16</div>
                                <div class="text-sm p-2">17</div>
                                <div class="text-sm p-2">18</div>
                                <div class="text-sm p-2">19</div>
                                <div class="text-sm p-2">20</div>
                                <div class="text-sm p-2">21</div>
                                <div class="text-sm p-2">22</div>
                                <div class="text-sm p-2">23</div>
                                <div class="text-sm p-2">24</div>
                                <div class="text-sm p-2">25</div>
                                <div class="text-sm p-2">26</div>
                                <div class="text-sm p-2">27</div>
                                <div class="text-sm p-2">28</div>
                                <div class="text-sm p-2">29</div>
                                <div class="text-sm p-2">30</div>
                                <div class="text-sm p-2 text-gray-400">1</div>
                                <div class="text-sm p-2 text-gray-400">2</div>
                                <div class="text-sm p-2 text-gray-400">3</div>
                            </div>
                        </div>

                        <!-- Search and Filter Section -->
                        <div class="flex flex-col md:flex-row justify-between mb-6 space-y-4 md:space-y-0">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text"
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                    placeholder="Search classes...">
                            </div>

                            <div class="flex space-x-3">
                                <div class="relative inline-block text-left">
                                    <button
                                        class="inline-flex justify-between w-40 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                        All Classes
                                        <i class="fas fa-chevron-down ml-2"></i>
                                    </button>
                                </div>

                                <div class="relative inline-block text-left">
                                    <button
                                        class="inline-flex justify-between w-40 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                        All Trainers
                                        <i class="fas fa-chevron-down ml-2"></i>
                                    </button>
                                </div>

                                <button
                                    class="bg-red-600 hover:bg-red-700 text-white rounded-md px-4 py-2 text-sm font-medium flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Class
                                </button>
                            </div>
                        </div>

                        <!-- Classes Table -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Class Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Trainer
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Schedule
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Duration
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Capacity
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
                                    <!-- Class Row -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-red-500 flex items-center justify-center text-white">
                                                    <i class="fas fa-fist-raised"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Beginner Muay Thai
                                                    </div>
                                                    <div class="text-sm text-gray-500">No experience needed</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Jason Lee</div>
                                            <div class="text-sm text-gray-500">5+ years experience</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Mon, Wed, Fri</div>
                                            <div class="text-sm text-gray-500">07:00 - 08:30</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            90 minutes
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">12/15</div>
                                            <div class="h-1 w-full bg-gray-200 rounded-full mt-1">
                                                <div class="bg-green-500 h-1 rounded-full" style="width: 80%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Class Row -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white">
                                                    <i class="fas fa-fist-raised"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Advanced Clinch Work
                                                    </div>
                                                    <div class="text-sm text-gray-500">Experience required</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Sarah Nguyen</div>
                                            <div class="text-sm text-gray-500">8+ years experience</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Tue, Thu</div>
                                            <div class="text-sm text-gray-500">18:00 - 19:30</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            90 minutes
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">8/10</div>
                                            <div class="h-1 w-full bg-gray-200 rounded-full mt-1">
                                                <div class="bg-yellow-500 h-1 rounded-full" style="width: 80%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Class Row -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-green-500 flex items-center justify-center text-white">
                                                    <i class="fas fa-dumbbell"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Conditioning</div>
                                                    <div class="text-sm text-gray-500">All levels welcome</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Mike Johnson</div>
                                            <div class="text-sm text-gray-500">4+ years experience</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Mon, Wed, Fri</div>
                                            <div class="text-sm text-gray-500">19:00 - 20:00</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            60 minutes
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">15/20</div>
                                            <div class="h-1 w-full bg-gray-200 rounded-full mt-1">
                                                <div class="bg-green-500 h-1 rounded-full" style="width: 75%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Class Row -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-500 flex items-center justify-center text-white">
                                                    <i class="fas fa-boxing-glove"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Technical Sparring
                                                    </div>
                                                    <div class="text-sm text-gray-500">Intermediate & Advanced</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">David Park</div>
                                            <div class="text-sm text-gray-500">10+ years experience</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Saturday</div>
                                            <div class="text-sm text-gray-500">10:00 - 12:00</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            120 minutes
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">10/12</div>
                                            <div class="h-1 w-full bg-gray-200 rounded-full mt-1">
                                                <div class="bg-yellow-500 h-1 rounded-full" style="width: 83%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Class Row -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-500 flex items-center justify-center text-white">
                                                    <i class="fas fa-child"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Kids Muay Thai</div>
                                                    <div class="text-sm text-gray-500">Ages 8-12</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Lisa Wong</div>
                                            <div class="text-sm text-gray-500">6+ years experience</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Tue, Thu</div>
                                            <div class="text-sm text-gray-500">16:00 - 17:00</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            60 minutes
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">8/10</div>
                                            <div class="h-1 w-full bg-gray-200 rounded-full mt-1">
                                                <div class="bg-green-500 h-1 rounded-full" style="width: 80%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-gray-500 hover:text-gray-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Class Row -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 h-10 w-10 rounded-full bg-red-600 flex items-center justify-center text-white">
                                                    <i class="fas fa-fire"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Pad Work Intensive
                                                    </div>
                                                    <div class="text-sm text-gray-500">All levels</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900"></div>