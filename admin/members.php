<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Members</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                        <span class="mx-3">Dashboard ganteng</span>
                    </a>

                    <a href="members.php" class="flex items-center px-6 py-3 bg-gray-200 text-gray-700">
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

                    <a href="payment.php" class="flex items-center px-6 py-3 hover:bg-gray-100 text-gray-700">
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
                            <h1 class="text-xl font-semibold text-gray-800">Members</h1>
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
                                    <h3 class="text-2xl font-bold text-gray-900">248</h3>
                                    <p class="text-sm text-gray-500">Total Members</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-red-600 h-1 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">215</h3>
                                    <p class="text-sm text-gray-500">Active Members</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-green-500 h-1 rounded-full" style="width: 87%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">18</h3>
                                    <p class="text-sm text-gray-500">Pending Members</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-yellow-400 h-1 rounded-full" style="width: 7%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">15</h3>
                                    <p class="text-sm text-gray-500">Inactive Members</p>
                                    <div class="mt-2 w-full bg-gray-200 rounded-full h-1">
                                        <div class="bg-red-500 h-1 rounded-full" style="width: 6%"></div>
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
                                    placeholder="Search members...">
                            </div>

                            <div class="flex space-x-3">
                                <div class="relative inline-block text-left">
                                    <button
                                        class="inline-flex justify-between w-40 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                        All Status
                                        <i class="fas fa-chevron-down ml-2"></i>
                                    </button>
                                </div>

                                <div class="relative inline-block text-left">
                                    <button
                                        class="inline-flex justify-between w-40 rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                        All Memberships
                                        <i class="fas fa-chevron-down ml-2"></i>
                                    </button>
                                </div>

                                <button
                                    class="bg-red-600 hover:bg-red-700 text-white rounded-md px-4 py-2 text-sm font-medium flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Member
                                </button>
                            </div>
                        </div>

                        <!-- Members Table -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-36">
                                            Member
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Phone
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Membership
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Join Date
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
                                    <!-- Member Row -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-red-500 flex items-center justify-center text-white text-sm mr-3">
                                                    JD
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">John Doe</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            john.doe@example.com
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            (555) 123-4567
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Premium
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Jan 15, 2023
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

                                    <!-- Jane Smith -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-pink-500 flex items-center justify-center text-white text-sm mr-3">
                                                    JS
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            jane.smith@example.com
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            (555) 987-6543
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Standard
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Feb 3, 2023
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

                                    <!-- Robert Johnson -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white text-sm mr-3">
                                                    RJ
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">Robert Johnson</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            robert.j@example.com
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            (555) 234-5678
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Basic
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Mar 22, 2023
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
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

                                    <!-- Mary Brown -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-purple-500 flex items-center justify-center text-white text-sm mr-3">
                                                    MB
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">Mary Brown</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            mary.b@example.com
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            (555) 345-6789
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Premium
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Jan 5, 2023
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

                                    <!-- David Wilson -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm mr-3">
                                                    DW
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">David Wilson</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            david.w@example.com
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            (555) 456-7890
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Standard
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Apr 12, 2023
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Inactive
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

                                    <!-- Sarah Parker -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center text-white text-sm mr-3">
                                                    SP
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">Sarah Parker</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            sarah.p@example.com
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            (555) 567-8901
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Premium
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Feb 28, 2023
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

                                    <!-- Michael Green -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white text-sm mr-3">
                                                    MG
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">Michael Green</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            michael.g@example.com
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            (555) 678-9012
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Basic
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Mar 14, 2023
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
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

                                    <!-- Emma White -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-sm mr-3">
                                                    EW
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">Emma White</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            emma.w@example.com
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            (555) 789-0123
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Standard
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Jan 20, 2023
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
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div
                            class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4 rounded-lg">
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
                                        Showing <span class="font-medium">1</span> to <span class="font-medium">8</span>
                                        of <span class="font-medium">248</span> entries
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
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-red-600 text-sm font-