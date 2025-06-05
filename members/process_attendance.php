<?php
require_once __DIR__ . '/../config/auth_check.php';
require_once __DIR__ . '/../config/db.php';

// Pastikan hanya member yang bisa mengakses
if (empty($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $class_id = $_POST['class_id'];
    $tanggal_hari_ini = date('Y-m-d');
    $awal_bulan_ini = date('Y-m-01');
    $awal_bulan_depan = date('Y-m-01', strtotime('+1 month'));

    try {
        // 1. Cek apakah user sudah absen di kelas ini hari ini
        $cek_absen_hari_ini = $pdo->prepare("SELECT * FROM attendance 
                                           WHERE user_id = ? AND class_id = ? AND date = ?");
        $cek_absen_hari_ini->execute([$user_id, $class_id, $tanggal_hari_ini]);

        if ($cek_absen_hari_ini->rowCount() > 0) {
            $_SESSION['error'] = "Anda sudah melakukan absensi untuk kelas ini hari ini";
            header("Location: memberview.php");
            exit();
        }

        // 2. Dapatkan data kelas
        $ambil_data_kelas = $pdo->prepare("SELECT * FROM class_schedule WHERE id = ?");
        $ambil_data_kelas->execute([$class_id]);
        $kelas = $ambil_data_kelas->fetch();

        if (!$kelas) {
            $_SESSION['error'] = "Kelas tidak ditemukan";
            header("Location: memberview.php");
            exit();
        }

        // 3. Cek membership aktif user
        $cek_membership = $pdo->prepare("SELECT um.*, mp.name as package_name, mp.description 
                                       FROM user_memberships um
                                       JOIN membership_packages mp ON um.package_id = mp.id
                                       WHERE um.user_id = ? AND um.status = 'active' AND um.end_date > NOW()");
        $cek_membership->execute([$user_id]);
        $membership_aktif = $cek_membership->fetch();

        if (!$membership_aktif) {
            $_SESSION['error'] = "Anda tidak memiliki membership aktif";
            header("Location: memberview.php");
            exit();
        }

        // 4. Hitung jumlah absen bulan ini
        $hitung_absen_bulan_ini = $pdo->prepare("SELECT COUNT(*) as jumlah 
                                               FROM attendance 
                                               WHERE user_id = ? 
                                               AND date >= ? 
                                               AND date < ?");
        $hitung_absen_bulan_ini->execute([$user_id, $awal_bulan_ini, $awal_bulan_depan]);
        $total_absen = $hitung_absen_bulan_ini->fetch(PDO::FETCH_ASSOC)['jumlah'];

        // 5. Tentukan batas absen berdasarkan paket
        $batas_absen = 0;
        $nama_paket = $membership_aktif['package_name'];

        if (strpos($nama_paket, '4X') !== false) {
            $batas_absen = 4;
        } elseif (strpos($nama_paket, '8X') !== false) {
            $batas_absen = 8;
        } elseif (strpos($nama_paket, 'Unlimited') !== false) {
            $batas_absen = PHP_INT_MAX; // Tidak terbatas
        }

        // 6. Cek apakah sudah mencapai batas
        if ($total_absen >= $batas_absen) {
            $_SESSION['error'] = "Anda sudah mencapai batas kehadiran bulan ini (" . $batas_absen . "x) sesuai paket " . $nama_paket;
            header("Location: memberview.php");
            exit();
        }

        // 7. Jika semua pengecekan berhasil, catat absensi
        $catat_absen = $pdo->prepare("INSERT INTO attendance 
                                     (user_id, class_id, date, time, status) 
                                     VALUES (?, ?, ?, NOW(), 'present')");
        $catat_absen->execute([$user_id, $class_id, $tanggal_hari_ini]);

        $_SESSION['message'] = "Absensi berhasil dicatat untuk kelas " . $kelas['coach'] .
            " (Kehadiran bulan ini: " . ($total_absen + 1) . "/" . $batas_absen . ")";
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