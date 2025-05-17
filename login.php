<?php
session_start();
require __DIR__ . '/config/db.php'; // This returns a PDO connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Query untuk mendapatkan data pengguna
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]); // PDO uses execute with array parameters

        // Jika user ditemukan
        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();
            
            // Verifikasi password yang di-hash
            if (password_verify($password, $user["password"])) {
                // Menyimpan data login dalam sesi
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["user_id"] = $user["id"]; // Store user ID

                // Jika user adalah admin, cek apakah sudah ada admin lain
                if ($user["role"] == 'admin') {
                    // Cek apakah sudah ada admin lainnya
                    $admin_check = "SELECT * FROM users WHERE role = 'admin' AND id != ?";
                    $admin_stmt = $pdo->prepare($admin_check);
                    $admin_stmt->execute([$user["id"]]);
                    
                    if ($admin_stmt->rowCount() > 0) {
                        // Jika sudah ada admin lain, jangan izinkan login
                        $error = "Hanya satu pengguna yang dapat menjadi admin. Admin lain sudah ada.";
                        session_destroy(); // Clear the session
                    } else {
                        // Redirect ke halaman dashboard admin
                        header("Location: admin/dashboard.php");
                        exit();
                    }
                } else {
                    // Jika bukan admin, redirect ke halaman member view
                    header("Location: members/memberview.php");
                    exit();
                }
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "User tidak ditemukan!";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Login</title>
    <!-- Import font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="css/login.css">
    
</head>
<body>
    <div class="background-image">
        <div class="header-container">
            <div class="welcome-text">Selamat Datang di</div>
            <div class="brand-container">
                <img src="image/LOGOKING.png" alt="King Muaythai Logo" class="logo">
                <div class="brand-name">King Muaythai</div>
            </div>
        </div>
    </div>
    
    <div class="login-container">
        <div class="login-header">LOG IN</div>
        
        <?php if(!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit" class="login-btn">Login</button>
        </form>
        
        <div class="divider">ATAU</div>
        
        <div class="links">
            <a href="forgot-password.php">Lupa password? <strong> Reset Password</strong> </a>
            <a href="register.php">Belum punya akun? <strong>Register Akun</strong> </a>
        </div>
    </div>
</body>
</html>
