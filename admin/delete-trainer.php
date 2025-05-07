<?php
$conn = new mysqli("localhost", "root", "", "kingmuaythai_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM trainers WHERE id = $id");

    echo 'success';
}

$conn->close();
?>
