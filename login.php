<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["username"] = $user["username"];
            header("Location: admin/dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "User tidak ditemukan!";
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
