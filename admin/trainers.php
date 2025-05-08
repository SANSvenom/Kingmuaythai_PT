<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Trainers</title>
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
                            <h1 class="text-xl font-semibold text-gray-800">Trainers</h1>
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
                                    <h3 class="text-2xl font-bold text-gray-900">12</h3>
                                    <p class="text-sm text-gray-500">Total Trainers</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-red-600 h-1 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">10</h3>
                                    <p class="text-sm text-gray-500">Active Trainers</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-green-500 h-1 rounded-full" style="width: 83%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">32</h3>
                                    <p class="text-sm text-gray-500">Classes Covered</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-blue-500 h-1 rounded-full" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">4</h3>
                                    <p class="text-sm text-gray-500">Elite Champions</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-purple-500 h-1 rounded-full" style="width: 33%"></div>
                                    </div>
                                </div>
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
                                    placeholder="Search trainers...">
                            </div>

                            <div class="flex space-x-3">
                                <div class="relative inline-block text-left">
                                    <button
                                        class="inline-flex justify-between w-40 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                        All Specialties
                                        <i class="fas fa-chevron-down ml-2"></i>
                                    </button>
                                </div>

                                <div class="relative inline-block text-left">
                                    <button
                                        class="inline-flex justify-between w-40 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                        All Status
                                        <i class="fas fa-chevron-down ml-2"></i>
                                    </button>
                                </div>

                                <button
                                    class="bg-red-600 hover:bg-red-700 text-white rounded-md px-4 py-2 text-sm font-medium flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Trainer
                                </button>
                            </div>
                        </div>

                        <!-- Trainers Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                            <!-- Trainer Card -->
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="relative">
                                    <img src="/api/placeholder/600/300" alt="Jason Lee"
                                        class="w-full h-48 object-cover">
                                    <div class="absolute top-0 right-0 p-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <img src="/api/placeholder/80/80" alt="Jason Lee"
                                            class="h-12 w-12 rounded-full border-2 border-red-600">
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Jason Lee</h3>
                                            <p class="text-sm text-gray-500">Head Trainer</p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-medal text-yellow-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">5x National Champion</span>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">8+ years experience</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-certificate text-red-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Certified Level 3 Coach</span>
                                        </div>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Specialties</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Clinch</span>
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Technique</span>
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Beginner</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                                    <div>
                                        <span class="text-xs text-gray-500">Classes</span>
                                        <p class="text-sm font-medium text-gray-900">3 Active</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Trainer Card -->
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="relative">
                                    <img src="/api/placeholder/600/300" alt="Sarah Nguyen"
                                        class="w-full h-48 object-cover">
                                    <div class="absolute top-0 right-0 p-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <img src="/api/placeholder/80/80" alt="Sarah Nguyen"
                                            class="h-12 w-12 rounded-full border-2 border-red-600">
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Sarah Nguyen</h3>
                                            <p class="text-sm text-gray-500">Senior Trainer</p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">International Champion</span>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">10+ years experience</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-certificate text-red-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Certified Elite Coach</span>
                                        </div>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Specialties</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Advanced</span>
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Clinch</span>
                                            <span
                                                class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Competition</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                                    <div>
                                        <span class="text-xs text-gray-500">Classes</span>
                                        <p class="text-sm font-medium text-gray-900">2 Active</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Trainer Card -->
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="relative">
                                    <img src="/api/placeholder/600/300" alt="Mike Johnson"
                                        class="w-full h-48 object-cover">
                                    <div class="absolute top-0 right-0 p-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <img src="/api/placeholder/80/80" alt="Mike Johnson"
                                            class="h-12 w-12 rounded-full border-2 border-red-600">
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Mike Johnson</h3>
                                            <p class="text-sm text-gray-500">Strength & Conditioning</p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-dumbbell text-gray-700 mr-2"></i>
                                            <span class="text-sm text-gray-700">Certified Strength Coach</span>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">6+ years experience</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-heartbeat text-red-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Athletic Performance Specialist</span>
                                        </div>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Specialties</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Conditioning</span>
                                            <span
                                                class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Strength</span>
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">All
                                                Levels</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                                    <div>
                                        <span class="text-xs text-gray-500">Classes</span>
                                        <p class="text-sm font-medium text-gray-900">3 Active</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Trainer Card -->
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="relative">
                                    <img src="/api/placeholder/600/300" alt="David Park"
                                        class="w-full h-48 object-cover">
                                    <div class="absolute top-0 right-0 p-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <img src="/api/placeholder/80/80" alt="David Park"
                                            class="h-12 w-12 rounded-full border-2 border-red-600">
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">David Park</h3>
                                            <p class="text-sm text-gray-500">Technical Coach</p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-medal text-yellow-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Former National Team Coach</span>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">12+ years experience</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-certificate text-red-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Master Instructor</span>
                                        </div>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Specialties</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Sparring</span>
                                            <span
                                                class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Advanced</span>
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Technique</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                                    <div>
                                        <span class="text-xs text-gray-500">Classes</span>
                                        <p class="text-sm font-medium text-gray-900">2 Active</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Trainer Card -->
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="relative">
                                    <img src="/api/placeholder/600/300" alt="Lisa Wong"
                                        class="w-full h-48 object-cover">
                                    <div class="absolute top-0 right-0 p-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <img src="/api/placeholder/80/80" alt="Lisa Wong"
                                            class="h-12 w-12 rounded-full border-2 border-red-600">
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Lisa Wong</h3>
                                            <p class="text-sm text-gray-500">Youth Program Director</p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-child text-blue-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Youth Development Certified</span>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">6+ years experience</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-certificate text-red-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Education Background</span>
                                        </div>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Specialties</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Kids</span>
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Beginner</span>
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Technique</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                                    <div>
                                        <span class="text-xs text-gray-500">Classes</span>
                                        <p class="text-sm font-medium text-gray-900">2 Active</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="p-2 text-gray-500 hover:text-gray-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Trainer Card -->
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="relative">
                                    <img src="/api/placeholder/600/300" alt="Tony Ramirez"
                                        class="w-full h-48 object-cover">
                                    <div class="absolute top-0 right-0 p-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">On
                                            Leave</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center mb-4">
                                        <img src="/api/placeholder/80/80" alt="Tony Ramirez"
                                            class="h-12 w-12 rounded-full border-2 border-gray-400">
                                        <div class="ml-4">
                                            <h3 class="text-lg font-bold text-gray-900">Tony Ramirez</h3>
                                            <p class="text-sm text-gray-500">Fight Coach</p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Professional Fighter (15-2)</span>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">5+ years experience</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-certificate text-red-500 mr-2"></i>
                                            <span class="text-sm text-gray-700">Corner Coach Certified</span>
                                        </div>
                                    </div>
                                    <div class="border-t pt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Specialties</h4>
                                        <div class="flex flex-wrap gap-2">
                                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Fight
                                                Prep</span>
                                            <span
                                                class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Sparring</span>
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Advanced</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 flex justify-between">
                                    <div>
                                        <span class="text-xs text-gray-500">Classes