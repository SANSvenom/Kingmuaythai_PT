<?php
// Cek apakah session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'gc_maxlifetime'  => 86400
    ]);
}

if (!isset($_SESSION['user_id'])) {
    error_log("Session expired or invalid for user. Redirecting to login.");
    header('Location: login.php');
    exit;
}

// Perpanjang session setiap kali ada aktivitas
$_SESSION['last_activity'] = time();
?>