<?php
session_start();
require_once '../config/db.php';

// Pastikan hanya member yang bisa mengakses
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_id = $_POST['class_id'];
    
    try {
        // Cek apakah user sudah absen di kelas ini hari ini
        $today = date('Y-m-d');
        $check_stmt = $pdo->prepare("SELECT * FROM attendance 
                                    WHERE user_id = ? AND class_id = ? AND date = ?");
        $check_stmt->execute([$user_id, $class_id, $today]);
        
        if ($check_stmt->rowCount() > 0) {
            $_SESSION['error'] = "Anda sudah melakukan absensi untuk kelas ini hari ini";
            header("Location: memberview.php");
            exit();
        }
        
        // Dapatkan data kelas
        $class_stmt = $pdo->prepare("SELECT * FROM class_schedule WHERE id = ?");
        $class_stmt->execute([$class_id]);
        $class = $class_stmt->fetch();
        
        if (!$class) {
            $_SESSION['error'] = "Kelas tidak ditemukan";
            header("Location: memberview.php");
            exit();
        }
        
        // Insert data absensi
        $insert_stmt = $pdo->prepare("INSERT INTO attendance 
                                    (user_id, class_id, date, time, status) 
                                    VALUES (?, ?, ?, NOW(), 'present')");
        $insert_stmt->execute([$user_id, $class_id, $today]);
        
        $_SESSION['message'] = "Absensi berhasil dicatat untuk kelas " . $class['coach'];
        header("Location: memberview.php");
        exit();
        
    } catch (PDOException $e) {
        $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
        header("Location: memberview.php");
        exit();
    }
} else {
    header("Location: memberview.php");
    exit();
}
?>