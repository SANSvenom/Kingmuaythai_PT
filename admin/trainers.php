<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Trainers</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Add Trainer Modal -->
    <div id="addTrainerModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg w-full max-w-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Add New Trainer</h2>
            <form id="addTrainerForm" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" id="trainerName" required class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Position</label>
                    <input type="text" name="position" id="trainerPosition" required class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" id="trainerStatus" class="w-full border rounded p-2">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Specialties</label>
                    <input type="text" name="specialties" id="trainerSpecialties" class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Cover Photo</label>
                    <input type="file" name="cover_photo" id="trainerCoverPhoto" accept="image/*"
                        class="w-full border rounded p-2 mb-2">
                    <img id="coverPreview" class="mt-2 hidden w-full h-48 object-cover rounded">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('addTrainerModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" id="addTrainerBtn"
                        class="px-4 py-2 bg-red-600 text-white rounded">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Trainer Modal -->
    <div id="editTrainerModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg w-full max-w-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Edit Trainer</h2>
            <form id="editTrainerForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="editTrainerId">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name" id="editTrainerName" required class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Position</label>
                    <input type="text" name="position" id="editTrainerPosition" required
                        class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status" id="editTrainerStatus" class="w-full border rounded p-2">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Specialties</label>
                    <input type="text" name="specialties" id="editTrainerSpecialties" class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Cover Photo</label>
                    <input type="file" name="cover_photo" id="editTrainerCoverPhoto" accept="image/*"
                        class="w-full border rounded p-2 mb-2">
                    <img id="editCoverPreview" class="mt-2 hidden w-full h-48 object-cover rounded">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('editTrainerModal').classList.add('hidden')"
                        class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button type="submit" id="editTrainerBtn" class="px-4 py-2 bg-red-600 text-white rounded">Save
                        Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Layout -->
    <div class="flex h-screen">
        <?php include '../partials/sidebar.php'; ?>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <h1 class="text-xl font-semibold text-gray-800">Trainers</h1>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between mb-6">
                            <input type="text" placeholder="Search trainers..."
                                class="pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500">
                            <button id="openAddTrainerModal"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                                <i class="fas fa-plus mr-2"></i>Add Trainer
                            </button>
                        </div>

                        <!-- Trainer Cards -->
                        <div class="container mx-auto px-4 " id="trainerCards">
                        <?php
                            $conn = new mysqli("localhost", "root", "", "kingmuaythai_db");
                            $result = $conn->query("SELECT * FROM trainers ORDER BY id DESC");

                            if ($result->num_rows > 0): ?>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="trainerCards">
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <div class="bg-white rounded-lg shadow-md p-4 trainer-card" data-id="<?= $row['id'] ?>">
                                            <!-- Menampilkan gambar pelatih -->
                                            <img src="<?= htmlspecialchars($row['cover_photo']) ?>" class="w-full h-80 object-cover rounded mb-2" alt="Trainer Image">
                                            <h3 class="text-lg font-bold"><?= htmlspecialchars($row['name']) ?></h3>
                                            <p class="text-sm text-gray-600"><?= htmlspecialchars($row['position']) ?></p>
                                            <p class="text-sm mt-1"><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
                                            <p class="text-sm"><strong>Specialties:</strong> <?= htmlspecialchars($row['specialties']) ?></p>

                                            <!-- <button class="text-blue-500 hover:text-blue-700 editTrainerBtn" data-id="<?= $row['id'] ?>">Edit</button>
                                            <button class="text-red-500 hover:text-red-700 deleteTrainerBtn" data-id="<?= $row['id'] ?>">Delete</button> -->

                                            <button class="text-gray-500 hover:text-gray-700 editTrainerBtn"data-id="<?= $row['id'] ?>"><i class="fas fa-edit"></i></button>
                                            <button class="text-gray-500 hover:text-gray-700 deleteTrainerBtn"data-id="<?= $row['id'] ?>"><i class="fas fa-trash"></i></button>
                                            
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center text-gray-500">No trainers found.</div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Open Add Trainer Modal
        $('#openAddTrainerModal').click(function () {
            $('#addTrainerModal').removeClass('hidden');
        });

        // Handle Add Trainer Form Submission (AJAX)
        $('#addTrainerForm').submit(function (e) {
            e.preventDefault(); // Prevent the form from submitting normally
            var formData = new FormData(this); // Create a FormData object to send all form data including file
            $.ajax({
                url: 'add-trainer.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response === 'success') {
                        alert('Trainer added successfully!');
                        location.reload();
                    } else {
                        alert('Failed to add trainer. Please try again.');
                    }
                },
                error: function () {
                    alert('Error in adding trainer.');
                }
            });
        });

        // Open Edit Trainer Modal (AJAX)
        $('.editTrainerBtn').click(function () {
            var trainerId = $(this).data('id');

            // Get trainer data from the server via AJAX
            $.ajax({
                url: 'get-trainer.php',
                method: 'GET',
                data: { id: trainerId },
                success: function (response) {
                    var trainer = JSON.parse(response);
                    $('#editTrainerId').val(trainer.id);
                    $('#editTrainerName').val(trainer.name);
                    $('#editTrainerPosition').val(trainer.position);
                    $('#editTrainerStatus').val(trainer.status);
                    $('#editTrainerSpecialties').val(trainer.specialties);
                    $('#editTrainerModal').removeClass('hidden');
                }
            });
        });

        // Handle Trainer Edit Form Submission
        $('#editTrainerForm').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this); // Create a FormData object to send all form data including file

            $.ajax({
                url: 'edit-trainer.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert('Trainer updated successfully!');
                    $('#editTrainerModal').addClass('hidden');
                    location.reload(); // Reload the page to reflect the changes
                },
                error: function () {
                    alert('Error in editing trainer.');
                }
            });
        });

        // Handle Delete Trainer Action (AJAX)
        $('.deleteTrainerBtn').click(function () {
            var trainerId = $(this).data('id');
            if (confirm('Are you sure you want to delete this trainer?')) {
                $.ajax({
                    url: 'delete-trainer.php',
                    method: 'POST',
                    data: { id: trainerId },
                    success: function () {
                        alert('Trainer deleted successfully!');
                        location.reload(); // Reload the page after deletion
                    },
                    error: function () {
                        alert('Failed to delete trainer.');
                    }
                });
            }
        });
    </script>
</body>

</html>