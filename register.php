<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];  // Ambil role dari form

    $check = $conn->query("SELECT * FROM users WHERE username = '$username'");
    if ($check->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        // Memasukkan data ke database termasuk 'role'
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
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
