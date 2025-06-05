<?php
require_once '\config\auth_check.php';
require_once '\config\db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $specialties = $_POST['specialties'];
    
    // Default to current photo
    $cover_photo = $_POST['current_cover_photo'];
    
    // Handle new photo upload if provided
    if (!empty($_FILES['cover_photo']['name'])) {
        $target_dir = "../admin/uploads/trainers/";
        
        // Generate unique filename
        $file_ext = pathinfo($_FILES['cover_photo']['name'], PATHINFO_EXTENSION);
        $new_filename = 'trainer_' . uniqid() . '.' . $file_ext;
        $target_file = $target_dir . $new_filename;
        
        // Check and move uploaded file
        if (move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_file)) {
            // Delete old photo if exists
            if (file_exists($_POST['current_cover_photo'])) {
                unlink($_POST['current_cover_photo']);
            }
            $cover_photo = $target_file;
        } else {
            $_SESSION['error'] = "Gagal mengupload foto";
            header("Location: trainers.php");
            exit;
        }
    }
    
    try {
        $stmt = $pdo->prepare("UPDATE trainers SET 
            name = ?, 
            position = ?, 
            status = ?, 
            specialties = ?, 
            cover_photo = ? 
            WHERE id = ?");
        
        $stmt->execute([$name, $position, $status, $specialties, $cover_photo, $id]);
        
        $_SESSION['message'] = "Trainer berhasil diperbarui";
        header("Location: trainers.php");
        exit;
        
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal memperbarui trainer: " . $e->getMessage();
        header("Location: trainers.php");
        exit;
    }
}
?>