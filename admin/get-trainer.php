<?php
require_once '../config/db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM trainers WHERE id = $id");

    if ($result->num_rows > 0) {
        $trainer = $result->fetch_assoc();
        echo json_encode($trainer);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
