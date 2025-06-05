<?php
require_once __DIR__ . '/config/auth_check.php';

// Pastikan hanya admin yang bisa mengakses
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Koneksi database
require_once __DIR__ . '/../config/db.php';

// Proses delete member jika ada request
if (isset($_GET['delete_id'])) {
    $member_id = $_GET['delete_id'];
    
    try {
        $pdo->beginTransaction();
        
        // Hapus dari user_memberships terlebih dahulu karena ada foreign key constraint
        $stmt = $pdo->prepare("DELETE FROM user_memberships WHERE user_id = ?");
        $stmt->execute([$member_id]);
        
        // Hapus dari payments
        $stmt = $pdo->prepare("DELETE FROM payments WHERE user_id = ?");
        $stmt->execute([$member_id]);
        
        // Hapus dari users
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$member_id]);
        
        $pdo->commit();
        
        $_SESSION['message'] = "Member berhasil dihapus";
        header("Location: members.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['error'] = "Gagal menghapus member: " . $e->getMessage();
        header("Location: members.php");
        exit();
    }
}

// Query untuk mengambil data member
$query = "SELECT 
            u.id, 
            u.username, 
            u.phone,
            um.status as membership_status,
            mp.name as membership_name,
            um.end_date as membership_end
          FROM users u
          LEFT JOIN user_memberships um ON u.id = um.user_id AND um.status = 'active'
          LEFT JOIN membership_packages mp ON um.package_id = mp.id
          WHERE u.role = 'member'
          ORDER BY u.username";

$stmt = $pdo->prepare($query);
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Members</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
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
                        <div class="flex items-center md:hidden">
                            <button id="menu-button"
                                class="p-2 rounded-md text-gray-600 hover:text-gray-900 focus:outline-none">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <h1 class="text-xl font-semibold text-gray-800">Members</h1>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Tampilkan pesan error/success -->
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline"><?= $_SESSION['error'] ?></span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['message'])): ?>
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline"><?= $_SESSION['message'] ?></span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>


                        <!-- Members Table -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Membership</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($members as $index => $member): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $index + 1 ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?= htmlspecialchars($member['username']) ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?= htmlspecialchars($member['phone']) ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?= $member['membership_name'] ? htmlspecialchars($member['membership_name']) : '-' ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php
                                            $status_class = 'bg-gray-100 text-gray-800';
                                            $status_text = 'Inactive';
                                            
                                            if ($member['membership_status'] === 'active') {
                                                if (strtotime($member['membership_end']) > time()) {
                                                    $status_class = 'bg-green-100 text-green-800';
                                                    $status_text = 'Active';
                                                } else {
                                                    $status_class = 'bg-yellow-100 text-yellow-800';
                                                    $status_text = 'Expired';
                                                }
                                            }
                                            ?>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_class ?>">
                                                <?= $status_text ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2 ">
                                                <!-- View Button -->
                                                <button onclick="openViewModal(<?= htmlspecialchars(json_encode($member)) ?>)" 
                                                        class="text-blue-600 hover:text-blue-900">
                                                    <i class="fas fa-eye"></i>
                                                </button>                                                
                                                <!-- Delete Button -->
                                                <button onclick="confirmDelete(<?= $member['id'] ?>)" 
                                                        class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- View Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('viewModal').style.display='none'">&times;</span>
            <h3 class="text-lg font-semibold mb-4">Member Details</h3>
            <div id="viewModalContent">
                <!-- Content will be filled by JavaScript -->
            </div>
        </div>
    </div>

    <script>
        // Function to open view modal
        function openViewModal(member) {
            const modal = document.getElementById('viewModal');
            const content = document.getElementById('viewModalContent');
            
            content.innerHTML = `
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username:</label>
                        <p class="mt-1 text-sm text-gray-900">${member.username}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone:</label>
                        <p class="mt-1 text-sm text-gray-900">${member.phone || '-'}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Membership:</label>
                        <p class="mt-1 text-sm text-gray-900">${member.membership_name || 'No active membership'}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Membership End Date:</label>
                        <p class="mt-1 text-sm text-gray-900">${member.membership_end ? new Date(member.membership_end).toLocaleDateString() : '-'}</p>
                    </div>
                    
                    <div class="flex justify-end mt-4">
                        <button onclick="document.getElementById('viewModal').style.display='none'" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Close
                        </button>
                    </div>
                </div>
            `;
            
            modal.style.display = 'block';
        }

        // Function to confirm delete
        function confirmDelete(memberId) {
            if (confirm('Are you sure you want to delete this member?')) {
                window.location.href = `members.php?delete_id=${memberId}`;
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('viewModal')) {
                document.getElementById('viewModal').style.display = 'none';
            }
        }
    </script>
</body>
</html>