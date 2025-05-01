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
                                            <i class="fas fa-dollar-sign text-red-600"></i>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Monthly Revenue
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

                        <!-- Growth Chart and Classes Section -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                            <!-- Member Growth Chart -->
                            <div class="lg:col-span-2 bg-white shadow rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-lg font-medium text-gray-900">Member Growth</h2>
                                    <div class="flex space-x-3">
                                        <button
                                            class="px-3 py-1 rounded-full text-xs bg-white text-gray-800 border">Week</button>
                                        <button
                                            class="px-3 py-1 rounded-full text-xs bg-red-600 text-white">Month</button>
                                        <button
                                            class="px-3 py-1 rounded-full text-xs bg-white text-gray-800 border">Year</button>
                                    </div>
                                </div>
                                <div class="h-64 flex items-end space-x-2">
                                    <div class="w-1/8 bg-red-800 h-40 rounded-t"></div>
                                    <div class="w-1/8 bg-red-800 h-44 rounded-t"></div>
                                    <div class="w-1/8 bg-red-800 h-36 rounded-t"></div>
                                    <div class="w-1/8 bg-red-800 h-48 rounded-t"></div>
                                    <div class="w-1/8 bg-red-800 h-52 rounded-t"></div>
                                    <div class="w-1/8 bg-red-800 h-56 rounded-t"></div>
                                    <div class="w-1/8 bg-red-800 h-60 rounded-t"></div>
                                    <div class="w-1/8 bg-red-800 h-52 rounded-t"></div>
                                </div>
                                <div class="flex justify-between mt-2 text-xs text-gray-500">
                                    <div>Jan</div>
                                    <div>Feb</div>
                                    <div>Mar</div>
                                    <div>Apr</div>
                                    <div>May</div>
                                    <div>Jun</div>
                                    <div>Jul</div>
                                    <div>Aug</div>
                                </div>
                            </div>

                            <!-- Today's Classes -->
                            <div class="bg-white shadow rounded-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-lg font-medium text-gray-900">Today's Classes</h2>
                                    <a href="#" class="text-sm text-red-600 hover:text-red-500">View All</a>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="mr-3 text-center">
                                            <div class="text-sm font-medium text-red-600">6:00</div>
                                            <div class="text-xs text-gray-500">AM</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium">Morning Conditioning</div>
                                            <div class="text-xs text-gray-500">Coach Mike</div>
                                        </div>
                                        <div class="text-right text-xs text-gray-500">15/20</div>
                                    </div>

                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="mr-3 text-center">
                                            <div class="text-sm font-medium text-red-600">9:30</div>
                                            <div class="text-xs text-gray-500">AM</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium">Beginner's Muay Thai</div>
                                            <div class="text-xs text-gray-500">Coach Sarah</div>
                                        </div>
                                        <div class="text-right text-xs text-gray-500">12/15</div>
                                    </div>

                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="mr-3 text-center">
                                            <div class="text-sm font-medium text-red-600">4:00</div>
                                            <div class="text-xs text-gray-500">PM</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium">Advanced Techniques</div>
                                            <div class="text-xs text-gray-500">Coach Alex</div>
                                        </div>
                                        <div class="text-right text-xs text-gray-500">10/12</div>
                                    </div>

                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <div class="mr-3 text-center">
                                            <div class="text-sm font-medium text-red-600">7:00</div>
                                            <div class="text-xs text-gray-500">PM</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-sm font-medium">Evening Combat</div>
                                            <div class="text-xs text-gray-500">Coach David</div>
                                        </div>
                                        <div class="text-right text-xs text-gray-500">15/20</div>
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
                                    <a href="#" class="text-sm text-red-600 hover:text-red-500">View All</a>
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
                            <button
                                class="bg-red-700 hover:bg-red-800 text-white py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                Manage Members
                            </button>
                            <button
                                class="bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 py-2 px-4 rounded-md flex items-center">
                                <i class="fas fa-plus mr-2"></i>
                                Add New Class
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</html>