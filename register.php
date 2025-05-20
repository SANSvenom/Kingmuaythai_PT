<?php
require_once 'config/auth_check.php';
require __DIR__ . '/config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input data
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];
    $phone = trim($_POST["phone"]);

    // Validate password match
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        try {
            // Check if username exists using prepared statement
            $check = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $check->execute([$username]);
            
            if ($check->rowCount() > 0) {
                $error = "Username sudah digunakan!";
            } else {
                // If role is admin, check if another admin exists
                if ($role == 'admin') {
                    $admin_check = $pdo->query("SELECT * FROM users WHERE role = 'admin'");
                    if ($admin_check->rowCount() > 0) {
                        $error = "Hanya satu pengguna yang dapat menjadi admin.";
                    }
                }

                if (!isset($error)) {
                    // Hash password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Insert using prepared statement
                    $sql = "INSERT INTO users (username, password, role, phone) VALUES (?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute([$username, $hashed_password, $role, $phone])) {
                        header("Location: login.php");
                        exit;
                    } else {
                        $error = "Terjadi kesalahan saat mendaftar";
                    }
                }
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="background-image">
        <div class="header-container">
            <div class="welcome-text">Selamat Datang di</div>
            <div class="brand-container">
                <img src="image/LOGOKING.png" alt="Logo King Muaythai" class="logo">
                <div class="brand-name">King Muaythai</div>
            </div>
        </div>
    </div>

    <div class="login-container">
        <div class="login-header">Register</div>

        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="input-group">
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            </div>

                    <!-- Input untuk nomor HP -->
            <div class="input-group">
                <input type="text" name="phone" placeholder="Nomor HP" required>
            </div>

            <div class="input-group">
                <select name="role" required>
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="login-btn">Daftar</button>
        </form>

        <div class="divider">ATAU</div>

        <div class="links">
            <a href="login.php"><strong>Sudah punya akun? Login</strong></a>
        </div>
    </div>
</body>
</html>
