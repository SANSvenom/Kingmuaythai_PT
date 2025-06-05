<?php
require_once '\config\auth_check.php';

// Cek apakah pengguna sudah login (opsional, tapi baik untuk keamanan)
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada user_id dalam sesi, kemungkinan sesi sudah tidak aktif atau belum login.
    // Arahkan kembali ke halaman login.
    header("Location: login.php?pesan=belum_login"); // Menambahkan parameter pesan
    exit;
}

// Menghapus semua variabel sesi
session_unset();

// Menghancurkan sesi
session_destroy();

// Arahkan pengguna ke halaman login setelah logout dengan pesan sukses
header("Location: login.php?pesan=logout_berhasil"); // Menambahkan parameter pesan
exit;
?>