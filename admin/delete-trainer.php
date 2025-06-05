<?php
require_once __DIR__ . '/../config/db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = (int)$_POST['id']; // Pastikan id adalah integer

    try {
        // Mulai transaksi
        $conn->begin_transaction();

        // Ambil data pelatih dengan prepared statement
        $stmt = $conn->prepare("SELECT cover_photo FROM trainers WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $trainer = $result->fetch_assoc();
            
            // Hanya hapus jika bukan gambar default
            if ($trainer['cover_photo'] !== 'default.jpg') {
                $cover_photo_path = __DIR__ . "/../admin/uploads/trainers/" . basename($trainer['cover_photo']);
                
                // Cek dan hapus file gambar
                if (file_exists($cover_photo_path) && is_writable($cover_photo_path)) {
                    if (!unlink($cover_photo_path)) {
                        throw new Exception("Gagal menghapus file gambar");
                    }
                }
            }
        }

        // Hapus data pelatih dari database
        $delete_stmt = $conn->prepare("DELETE FROM trainers WHERE id = ?");
        $delete_stmt->bind_param("i", $id);
        
        if (!$delete_stmt->execute()) {
            throw new Exception("Gagal menghapus data trainer");
        }

        // Commit transaksi jika semua berhasil
        $conn->commit();
        echo 'success';
        
    } catch (Exception $e) {
        // Rollback jika ada error
        $conn->rollback();
        error_log("Error: " . $e->getMessage());
        echo 'error: ' . $e->getMessage();
    } finally {
        // Tutup statement
        if (isset($stmt)) $stmt->close();
        if (isset($delete_stmt)) $delete_stmt->close();
    }
} else {
    echo 'error: ID tidak ditemukan';
}

$conn->close();
?>