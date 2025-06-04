<?php
require_once '../config/db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Ambil data pelatih terlebih dahulu untuk mendapatkan nama file gambar
    $result = $conn->query("SELECT cover_photo FROM trainers WHERE id = $id");
    
    if ($result->num_rows > 0) {
        $trainer = $result->fetch_assoc();
        $cover_photo_path = "../admin/uploads/trainers/" . $trainer['cover_photo'];  // Path lengkap ke gambar

        // Cek apakah gambar ada, jika ada, hapus gambar
        if (file_exists($cover_photo_path)) {
            unlink($cover_photo_path);  // Menghapus file gambar
        }
    }

    // Hapus data pelatih dari database
    $stmt = $conn->prepare("DELETE FROM trainers WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 'success';  // Jika berhasil, kirimkan response success
    } else {
        echo 'error';  // Jika gagal, kirimkan response error
    }

    $stmt->close();
}

$conn->close();
?>
