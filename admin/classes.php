<?php

require_once '\config\auth_check.php';
// Jika belum ada session user, redirect ke login
if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}
require_once '\config\db.php';
try {
    // Membuat koneksi PDO
    // $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Penanganan kesalahan
    die("Koneksi gagal: " . $e->getMessage());
}

// Proses untuk menyimpan atau memperbarui kelas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menambah atau memperbarui kelas
    if (isset($_POST['day']) && isset($_POST['coach']) && isset($_POST['time'])) {
        $id = $_POST['id'] ?? null; // ID hanya ada untuk update
        $day = $_POST['day'];
        $coach = $_POST['coach'];
        $time = $_POST['time'];

        if ($id) {
            // Memperbarui kelas
            $query = "UPDATE class_schedule SET day = ?, coach = ?, time = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$day, $coach, $time, $id]);
        } else {
            // Menambah kelas baru
            $query = "INSERT INTO class_schedule (day, coach, time) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$day, $coach, $time]);
        }
        echo 'success'; // Jika berhasil
        exit;
    }


    // Menghapus kelas
    if (isset($_POST['delete_id'])) {
        $id = $_POST['delete_id'];

        try {
            // Mulai transaction
            $pdo->beginTransaction();

            // 1) Hapus dulu semua attendance yang terkait
            $stmt = $pdo->prepare("DELETE FROM attendance WHERE class_id = ?");
            $stmt->execute([$id]);

            // 2) Hapus record di class_schedule
            $stmt = $pdo->prepare("DELETE FROM class_schedule WHERE id = ?");
            $stmt->execute([$id]);

            // Commit jika semua sukses
            $pdo->commit();

            echo 'deleted';
        } catch (PDOException $e) {
            // Roll back jika ada error
            $pdo->rollBack();
            http_response_code(500);
            echo 'error: ' . $e->getMessage();
        }
        exit;
    }


}

// Mengambil data jadwal kelas dari database dan urutkan berdasarkan hari dan jam
$query = "SELECT * FROM class_schedule ORDER BY FIELD(day, 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'), time";
$stmt = $pdo->prepare($query);
$stmt->execute();
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kelompokkan data berdasarkan hari
$groupedClasses = [];
foreach ($classes as $class) {
    $groupedClasses[$class['day']][] = $class;
}

// Ambil data pelatih dari database
$trainers_query = "SELECT name FROM trainers ORDER BY name";
$trainers_stmt = $pdo->prepare($trainers_query);
$trainers_stmt->execute();
$trainers = $trainers_stmt->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Jadwal Kelas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <style>
        .table-cell {
            padding: 8px 16px;
        }

        .form-input {
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modal-content {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        .modal-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .modal-footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
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
                        <div class="flex items-center">
                            <h1 class="text-xl font-semibold text-gray-800">Jadwal Kelas</h1>
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
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Jadwal Kelas Mingguan</h3>
                                <button id="add-class-btn"
                                    class="bg-red-600 hover:bg-red-700 text-white rounded-md px-3 py-2 text-sm font-medium flex items-center">
                                    <i class="fas fa-plus mr-2"></i>Tambah Kelas
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-red-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                                Hari</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                                Pelatih</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                                Jam</th>
                                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Aksi</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200" id="class-schedule-body">
                                        <?php foreach ($groupedClasses as $day => $dayClasses): ?>
                                            <tr class="bg-gray-100">
                                                <td colspan="4" class="text-center font-bold"><?php echo $day; ?></td>
                                            </tr>
                                            <?php foreach ($dayClasses as $class): ?>
                                                <tr class="bg-white">
                                                    <td class="table-cell"><?php echo $class['day']; ?></td>
                                                    <td class="table-cell"><?php echo $class['coach']; ?></td>
                                                    <td class="table-cell"><?php echo $class['time']; ?></td>
                                                    <td class="table-cell text-right">
                                                        <button class="text-blue-600 hover:text-blue-900 mr-3 edit-btn"
                                                            data-id="<?php echo $class['id']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="text-red-600 hover:text-red-900 delete-btn"
                                                            data-id="<?php echo $class['id']; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Add/Edit Class Modal -->
                        <div id="class-modal"
                            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
                            <div class="modal-content bg-white rounded-lg shadow-xl">
                                <div id="modal-title" class="modal-header">Tambah Kelas</div>
                                <div class="px-6 py-4">
                                    <form id="class-form">
                                        <input type="hidden" id="class-id">
                                        <div class="mb-4">
                                            <label for="day"
                                                class="block text-sm font-medium text-gray-700">Hari</label>
                                            <select id="day" name="day" class="form-input">
                                                <option value="SENIN">SENIN</option>
                                                <option value="SELASA">SELASA</option>
                                                <option value="RABU">RABU</option>
                                                <option value="KAMIS">KAMIS</option>
                                                <option value="JUMAT">JUMAT</option>
                                                <option value="SABTU">SABTU</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="coach"
                                                class="block text-sm font-medium text-gray-700">Pelatih</label>
                                            <select id="coach" name="coach" class="form-input" required>
                                                <option value="">Pilih Pelatih</option>
                                                <?php foreach ($trainers as $trainer): ?>
                                                    <option value="<?= htmlspecialchars($trainer) ?>">
                                                        <?= htmlspecialchars($trainer) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="time"
                                                class="block text-sm font-medium text-gray-700">Jam</label>
                                            <input type="time" id="time" name="time" class="form-input">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="cancel-btn"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-3">Batal</button>
                                    <button id="save-btn"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addClassBtn = document.getElementById('add-class-btn');
            const classModal = document.getElementById('class-modal');
            const saveBtn = document.getElementById('save-btn');
            const cancelBtn = document.getElementById('cancel-btn');
            const classForm = document.getElementById('class-form');
            const classIdInput = document.getElementById('class-id');
            const dayInput = document.getElementById('day');
            const coachInput = document.getElementById('coach');
            const timeInput = document.getElementById('time');

            // Edit Button
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const row = this.closest('tr');
                    const day = row.cells[0].textContent.trim();
                    const coach = row.cells[1].textContent.trim();
                    const time = row.cells[2].textContent.trim();

                    // Mengisi data pada modal
                    document.getElementById('modal-title').textContent = "Edit Kelas";
                    document.getElementById('class-id').value = id;
                    document.getElementById('day').value = day;
                    document.getElementById('coach').value = coach;
                    document.getElementById('time').value = time;

                    // Menampilkan modal
                    classModal.classList.remove('hidden');
                    classModal.classList.add('flex');
                });
            });


            // Delete Button
            // Ganti bagian delete button dengan ini
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault(); // Mencegah perilaku default

                    const id = this.getAttribute('data-id');
                    if (!id) {
                        console.error('ID tidak ditemukan');
                        return;
                    }

                    if (confirm("Apakah Anda yakin ingin menghapus kelas ini?")) {
                        // Gunakan FormData untuk mengirim data
                        const formData = new FormData();
                        formData.append('delete_id', id);

                        fetch(window.location.href, {
                            method: 'POST',
                            body: new URLSearchParams(formData),
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            }
                        })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.text();
                            })
                            .then(data => {
                                if (data === 'deleted') {
                                    // Hapus baris dari tabel tanpa reload
                                    const row = this.closest('tr');
                                    if (row) {
                                        row.remove();
                                    }
                                    // Atau reload halaman jika lebih sesuai
                                    // location.reload();
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Gagal menghapus data: ' + error.message);
                            });
                    }
                });
            });

            // Add New Class Button
            addClassBtn.addEventListener('click', function () {
                classModal.classList.remove('hidden');
                classModal.classList.add('flex');
                classForm.reset();
                classIdInput.value = '';
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
                    alert('Harap isi semua kolom');
                    return;
                }

                const xhr = new XMLHttpRequest();
                xhr.open('POST', '', true); // Kirim ke script yang sama
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        location.reload(); // Memuat ulang halaman setelah penyimpanan
                    }
                };
                xhr.send(`id=${id}&day=${day}&coach=${coach}&time=${time}`); // Kirim data kelas
                classModal.classList.add('hidden');
                classModal.classList.remove('flex');
            });

        });
    </script>
</body>

</html>