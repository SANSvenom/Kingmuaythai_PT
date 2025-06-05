<?php
require_once '\config\db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);
    $status = $conn->real_escape_string($_POST['status']);
    $specialties = $conn->real_escape_string($_POST['specialties']);
    
    // Handle upload gambar
    $cover_photo_url = 'default.jpg';
    
    if (isset($_FILES['cover_photo']) && $_FILES['cover_photo']['error'] == 0) {
        $target_dir = __DIR__ . "/../admin/uploads/trainers/";
        if (!file_exists($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                die("Gagal membuat direktori upload");
            }
        }

        $file_extension = pathinfo($_FILES['cover_photo']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;

        // Cek apakah file adalah gambar
        $check = getimagesize($_FILES['cover_photo']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_file)) {
                $cover_photo_url = 'uploads/trainers/' . $new_filename;
            } else {
                die("Error saat mengupload file");
            }
        } else {
            die("File bukan gambar");
        }
    }

    // Query untuk insert data
    $sql = "INSERT INTO trainers (name, position, status, specialties, cover_photo) 
            VALUES ('$name', '$position', '$status', '$specialties', '$cover_photo_url')";

    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error: ' . $conn->error; // Tampilkan error dari database
    }

    $conn->close();
}