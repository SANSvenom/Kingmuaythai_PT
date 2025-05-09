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
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


                        <!-- Class Schedule Table Section -->
                        <div class="bg-white shadow overflow-hidden rounded-lg mb-6">
                            <div class="px-4 py-5 border-b border-gray-200 sm:px-6 flex justify-between items-center">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Weekly Class Schedule
                                </h3>
                                <button id="add-class-btn"
                                    class="bg-red-600 hover:bg-red-700 text-white rounded-md px-3 py-2 text-sm font-medium flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    Add Class
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-red-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                                Hari
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                                Coach
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                                Jam
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="class-schedule-body">
                                        <!-- SENIN -->
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top"
                                                rowspan="3">
                                                SENIN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                HASNAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                13:30
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                EVAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                16:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ARKAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                19:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- SELASA -->
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top"
                                                rowspan="3">
                                                SELASA
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                HASNAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                13:30
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                EVAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                16:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                HASNAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                19:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- RABU -->
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top"
                                                rowspan="3">
                                                RABU
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                BAMBANG
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                13:30
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                EVAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                16:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                EVAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                19:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- KAMIS -->
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top"
                                                rowspan="3">
                                                KAMIS
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                HASNAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                13:30
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ARKAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                16:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ARKAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                19:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- JUMAT -->
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top"
                                                rowspan="3">
                                                JUMAT
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                EVAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                13:30
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                NOEL
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                16:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                BAMBANG
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                19:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- SABTU -->
                                        <tr class="bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top"
                                                rowspan="3">
                                                SABTU
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ALFIN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                13:30
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ARKAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                16:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                EVAN
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                19:00
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-900 delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Add/Edit Class Modal -->
                        <div id="class-modal"
                            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
                            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900" id="modal-title">Add Class</h3>
                                </div>
                                <div class="px-6 py-4">
                                    <form id="class-form">
                                        <input type="hidden" id="class-id">
                                        <div class="mb-4">
                                            <label for="day" class="block text-sm font-medium text-gray-700">Day</label>
                                            <select id="day" name="day"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                                <option value="SENIN">SENIN</option>
                                                <option value="SELASA">SELASA</option>
                                                <option value="RABU">RABU</option>
                                                <option value="KAMIS">KAMIS</option>
                                                <option value="JUMAT">JUMAT</option>
                                                <option value="SABTU">SABTU</option>
                                                <option value="MINGGU">MINGGU</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="coach"
                                                class="block text-sm font-medium text-gray-700">Coach</label>
                                            <input type="text" id="coach" name="coach"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                        </div>
                                        <div class="mb-4">
                                            <label for="time"
                                                class="block text-sm font-medium text-gray-700">Time</label>
                                            <input type="time" id="time" name="time"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                        </div>
                                    </form>
                                </div>
                                <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                                    <button id="cancel-btn"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-3">
                                        Cancel
                                    </button>
                                    <button id="save-btn"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div id="delete-modal"
                            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
                            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Confirm Delete</h3>
                                </div>
                                <div class="px-6 py-4">
                                    <p class="text-sm text-gray-500">Are you sure you want to delete this class? This
                                        action cannot be undone.</p>
                                </div>
                                <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                                    <button id="cancel-delete-btn"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-3">
                                        Cancel
                                    </button>
                                    <button id="confirm-delete-btn"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // DOM Elements
                                const addClassBtn = document.getElementById('add-class-btn');
                                const classModal = document.getElementById('class-modal');
                                const modalTitle = document.getElementById('modal-title');
                                const classForm = document.getElementById('class-form');
                                const classIdInput = document.getElementById('class-id');
                                const dayInput = document.getElementById('day');
                                const coachInput = document.getElementById('coach');
                                const timeInput = document.getElementById('time');
                                const saveBtn = document.getElementById('save-btn');
                                const cancelBtn = document.getElementById('cancel-btn');
                                const deleteModal = document.getElementById('delete-modal');
                                const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
                                const confirmDeleteBtn = document.getElementById('confirm-delete-btn');

                                let currentRow = null;
                                let classes = [];

                                // Initialize edit buttons
                                initButtons();

                                // Add Class Button
                                addClassBtn.addEventListener('click', function () {
                                    modalTitle.textContent = 'Add Class';
                                    classForm.reset();
                                    classIdInput.value = '';
                                    classModal.classList.remove('hidden');
                                    classModal.classList.add('flex');
                                });

                                // Cancel Button
                                cancelBtn.addEventListener('click', function () {
                                    classModal.classList.add('hidden');
                                    classModal.classList.remove('flex');
                                });

                                // Save Button
                                saveBtn.addEventListener('click', function () {
                                    const id = classIdInput.value;
                                    const day = dayInput.value;
                                    const coach = coachInput.value;
                                    const time = timeInput.value;

                                    if (!coach || !time) {
                                        alert('Please fill in all fields');
                                        return;
                                    }

                                    // Format time from HH:MM to standard display
                                    const timeParts = time.split(':');
                                    const formattedTime = `${timeParts[0]}:${timeParts[1]}`;

                                    if (id) {
                                        // Update existing class
                                        updateClassRow(currentRow, day, coach, formattedTime);
                                    } else {
                                        // Add new class
                                        addClassRow(day, coach, formattedTime);
                                    }

                                    classModal.classList.add('hidden');
                                    classModal.classList.remove('flex');
                                });

                                // Cancel Delete Button
                                cancelDeleteBtn.addEventListener('click', function () {
                                    deleteModal.classList.add('hidden');
                                    deleteModal.classList.remove('flex');
                                });

                                // Confirm Delete Button
                                confirmDeleteBtn.addEventListener('click', function () {
                                    if (currentRow) {
                                        currentRow.remove();
                                        // Re-organize the table after deletion
                                        reorganizeTable();
                                    }

                                    deleteModal.classList.add('hidden');
                                    deleteModal.classList.remove('flex');
                                });

                                // Update Class Row
                                function updateClassRow(row, day, coach, time) {
                                    const dayCell = row.cells[0];
                                    const coachCell = row.cells[1];
                                    const timeCell = row.cells[2];

                                    // Only update the day if it's the first row of the day group
                                    if (dayCell.hasAttribute('rowspan')) {
                                        // Get old day value
                                        const oldDay = dayCell.textContent.trim();

                                        if (oldDay !== day) {
                                            // Day changed, need to reorganize
                                            row.remove();
                                            addClassRow(day, coach, time);
                                            reorganizeTable();
                                            return;
                                        }
                                    }

                                    coachCell.textContent = coach;
                                    timeCell.textContent = time;
                                }

                                // Add Class Row
                                function addClassRow(day, coach, time) {
                                    const tbody = document.getElementById('class-schedule-body');
                                    const rows = Array.from(tbody.querySelectorAll('tr'));

                                    // Check if day already exists
                                    let dayExists = false;
                                    let lastDayRow = null;
                                    let dayRowCount = 0;

                                    for (let i = 0; i < rows.length; i++) {
                                        const dayCell = rows[i].cells[0];
                                        if (dayCell.textContent.trim() === day) {
                                            dayExists = true;
                                            dayRowCount = parseInt(dayCell.getAttribute('rowspan') || 1);
                                            lastDayRow = rows[i + dayRowCount - 1];
                                        }
                                    }

                                    const newRow = document.createElement('tr');
                                    if (rows.length % 2 === 0) {
                                        newRow.classList.add('bg-gray-50');
                                    }

                                    if (dayExists) {
                                        // If day exists, increment rowspan and don't add day cell
                                        const firstDayRow = rows.find(r => r.cells[0].textContent.trim() === day);
                                        const dayCell = firstDayRow.cells[0];
                                        dayCell.setAttribute('rowspan', dayRowCount + 1);

                                        newRow.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${coach}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${time}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-900 delete-btn">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;

                                        // Insert after the last row of the day
                                        if (lastDayRow.nextSibling) {
                                            tbody.insertBefore(newRow, lastDayRow.nextSibling);
                                        } else {
                                            tbody.appendChild(newRow);
                                        }
                                    } else {
                                        // If day doesn't exist, add with day cell
                                        newRow.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top" rowspan="1">
                    ${day}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${coach}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${time}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-900 delete-btn">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;

                                        // Add at the end
                                        tbody.appendChild(newRow);
                                    }

                                    // Re-initialize buttons
                                    initButtons();

                                    // Sort the table after adding new row
                                    sortTableByDay();
                                }

                                // Initialize Edit and Delete buttons
                                function initButtons() {
                                    const editButtons = document.querySelectorAll('.edit-btn');
                                    const deleteButtons = document.querySelectorAll('.delete-btn');

                                    editButtons.forEach(btn => {
                                        btn.addEventListener('click', function () {
                                            const row = this.closest('tr');
                                            currentRow = row;

                                            // Check if it's a day cell or a regular row
                                            const hasDay = row.cells[0].hasAttribute('rowspan');
                                            const dayCell = hasDay ? row.cells[0] : getPreviousDayCell(row);
                                            const coachCell = hasDay ? row.cells[1] : row.cells[0];
                                            const timeCell = hasDay ? row.cells[2] : row.cells[1];

                                            const day = dayCell.textContent.trim();
                                            const coach = coachCell.textContent.trim();
                                            const time = timeCell.textContent.trim();

                                            modalTitle.textContent = 'Edit Class';
                                            classIdInput.value = 'existing';
                                            dayInput.value = day;
                                            coachInput.value = coach;

                                            // Convert time format to HH:MM for input
                                            const timeParts = time.split(':');
                                            timeInput.value = `${timeParts[0].padStart(2, '0')}:${timeParts[1]}`;

                                            classModal.classList.remove('hidden');
                                            classModal.classList.add('flex');
                                        });
                                    });

                                    deleteButtons.forEach(btn => {
                                        btn.addEventListener('click', function () {
                                            const row = this.closest('tr');
                                            currentRow = row;

                                            deleteModal.classList.remove('hidden');
                                            deleteModal.classList.add('flex');
                                        });
                                    });
                                }

                                // Get the day cell for a row that doesn't have its own day cell
                                function getPreviousDayCell(row) {
                                    let currentRow = row.previousElementSibling;
                                    while (currentRow) {
                                        if (currentRow.cells[0].hasAttribute('rowspan')) {
                                            return currentRow.cells[0];
                                        }
                                        currentRow = currentRow.previousElementSibling;
                                    }
                                    return null;
                                }

                                // Reorganize table after changes
                                function reorganizeTable() {
                                    const tbody = document.getElementById('class-schedule-body');
                                    const rows = Array.from(tbody.querySelectorAll('tr'));

                                    // Group rows by day
                                    const dayGroups = {};
                                    let currentDay = null;
                                    let dayRowCount = 0;

                                    rows.forEach(row => {
                                        // Check if this row has a day cell
                                        if (row.cells[0].hasAttribute('rowspan')) {
                                            currentDay = row.cells[0].textContent.trim();
                                            if (!dayGroups[currentDay]) {
                                                dayGroups[currentDay] = [];
                                            }
                                            dayGroups[currentDay].push(row);
                                        } else if (currentDay) {
                                            dayGroups[currentDay].push(row);
                                        }
                                    });

                                    // Fix rowspan attributes
                                    for (const day in dayGroups) {
                                        if (dayGroups[day].length > 0) {
                                            const firstRow = dayGroups[day][0];
                                            const dayCell = firstRow.cells[0];
                                            dayCell.setAttribute('rowspan', dayGroups[day].length);
                                        }
                                    }

                                    // Sort the table
                                    sortTableByDay();
                                }

                                // Sort table by day
                                function sortTableByDay() {
                                    const tbody = document.getElementById('class-schedule-body');
                                    const dayOrder = {
                                        'SENIN': 1,
                                        'SELASA': 2,
                                        'RABU': 3,
                                        'KAMIS': 4,
                                        'JUMAT': 5,
                                        'SABTU': 6,
                                        'MINGGU': 7
                                    };

                                    // Group rows by day
                                    const dayGroups = {};
                                    const rows = Array.from(tbody.querySelectorAll('tr'));

                                    let currentDay = null;
                                    let dayRowCount = 0;

                                    rows.forEach(row => {
                                        // Check if this row has a day cell
                                        if (row.cells[0].hasAttribute('rowspan')) {
                                            currentDay = row.cells[0].textContent.trim();
                                            if (!dayGroups[currentDay]) {
                                                dayGroups[currentDay] = [];
                                            }
                                            dayGroups[currentDay].push(row);
                                        } else if (currentDay) {
                                            dayGroups[currentDay].push(row);
                                        }
                                    });

                                    // Sort by day order and re-append to table
                                    const sortedDays = Object.keys(dayGroups).sort((a, b) => dayOrder[a] - dayOrder[b]);

                                    // Clear the table
                                    while (tbody.firstChild) {
                                        tbody.removeChild(tbody.firstChild);
                                    }

                                    // Add rows back in sorted order
                                    sortedDays.forEach(day => {
                                        dayGroups[day].forEach((row, index) => {
                                            if (index % 2 === 0) {
                                                row.classList.add('bg-gray-50');
                                                row.classList.remove('bg-white');
                                            } else {
                                                row.classList.add('bg-white');
                                                row.classList.remove('bg-gray-50');
                                            }
                                            tbody.appendChild(row);
                                        });
                                    });

                                    // Re-initialize buttons
                                    initButtons();
                                }

                                // Initial sort
                                sortTableByDay();
                            });
                        </script>

</body>

</html>