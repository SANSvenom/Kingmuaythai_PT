<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($check->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($sql)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Terjadi kesalahan: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Login</title>
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
        <div class="login-header">Register</div>
        
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
            
            <button type="submit" class="login-btn">Sign Up</button>
        </form>
        
        <div class="divider">ATAU</div>
        
        <div class="links">
            <a href="login.php"><span class="text-gray">Sudah punya akun?</span> <strong>Login</strong></a>
         </div>

    </div>
</body>
</html>
