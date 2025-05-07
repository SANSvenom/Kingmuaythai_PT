<?php
$conn = new mysqli("localhost", "root", "", "kingmuaythai_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $status = $_POST['status'];
    $specialties = $_POST['specialties'];
    $cover_photo = $_FILES['cover_photo'];

    // Handle cover photo upload
    if ($cover_photo['error'] == 0) {
        $target_dir = "../admin/uploads/trainers/";
        $target_file = $target_dir . basename($cover_photo["name"]);

        if (move_uploaded_file($cover_photo["tmp_name"], $target_file)) {
            $cover_photo_url = $target_file;
        } else {
            echo 'error';
            exit;
        }
    } else {
        $cover_photo_url = $_POST['cover_photo']; // Keep the old image if no new image
    }

    // Update in the database
    $stmt = $conn->prepare("UPDATE trainers SET name = ?, position = ?, status = ?, specialties = ?, cover_photo = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $name, $position, $status, $specialties, $cover_photo_url, $id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
}
?>
