<?php
// Koneksi ke database
require_once '../config/db.php';
header('Content-Type: application/json');

// Cek koneksi
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Ambil semua data
    $result = $mysqli->query("SELECT * FROM class_schedule ORDER BY FIELD(day, 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU', 'MINGGU'), time");
    $data = [];
    while ($row = $result->fetch_assoc()) $data[] = $row;
    echo json_encode($data);
} elseif ($method === 'POST') {
    // Tambah data
    $day = $_POST['day'];
    $coach = $_POST['coach'];
    $time = $_POST['time'];

    // Prepare statement untuk insert data
    $stmt = $mysqli->prepare("INSERT INTO class_schedule (day, coach, time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $day, $coach, $time);

    if ($stmt->execute()) {
        echo json_encode(['id' => $stmt->insert_id]);
    } else {
        echo json_encode(['error' => 'Failed to add class']);
    }

    $stmt->close();
} elseif ($method === 'PUT') {
    // Edit data
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT['id'];
    $day = $_PUT['day'];
    $coach = $_PUT['coach'];
    $time = $_PUT['time'];

    // Prepare statement untuk update data
    $stmt = $mysqli->prepare("UPDATE class_schedule SET day=?, coach=?, time=? WHERE id=?");
    $stmt->bind_param("sssi", $day, $coach, $time, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to update class']);
    }

    $stmt->close();
} elseif ($method === 'DELETE') {
    // Hapus data
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];

    // Prepare statement untuk delete data
    $stmt = $mysqli->prepare("DELETE FROM class_schedule WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Failed to delete class']);
    }

    $stmt->close();
}

$mysqli->close();
?>
