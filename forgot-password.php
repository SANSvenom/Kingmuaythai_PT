<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai - Forgot Password</title>
    <link rel="stylesheet" href="css/forgot.css">

</head>
<body>

    <div class="main-container">
        <div class="content-box">
            <div class="left-panel">

                <div class="motivational-text">
                    Jangan Pernah Menyerah,<br>
                    Bangkit Kembali!
                </div>

                <div class="lock-icon">
                    🔐
                </div>

                <div class="help-text">
                    Hilang kendali atas akun Anda?<br>
                    Kami siap membantu Anda kembali ke arena.
                </div>
            </div>

            <div class="right-panel">
                <div class="form-header">
                    <div class="form-title">Reset Password</div>
                </div>

                <div class="form-subtitle">
                    Lupa password Anda? Jangan khawatir. Masukkan email terdaftar Anda di
                    bawah ini dan kami akan mengirimkan tautan untuk reset password.
                </div>

                <form id="reset-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Masukkan email terdaftar Anda" required>
                    </div>

                    <button type="submit" class="form-button">Kirim Link Reset</button>
                </form>

                <div class="separator">
                    <span class="separator-text">ATAU</span>
                </div>

                <div class="login-link">
                    Ingat password Anda? <a href="login.php">Login Sekarang</a>
                </div>

                <div class="login-link" style="margin-top: 8px;">
                    Belum punya akun? <a href="register.php">Daftar disini</a>
                </div>

            </div>
        </div>
    </div>

    <div class="footer">
        <div class="flag">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MDAgNjAwIj48cGF0aCBmaWxsPSIjZmZmIiBkPSJNMCAwaDkwMHY2MDBIMHoiLz48cGF0aCBmaWxsPSIjY2UxMTI2IiBkPSJNMCAwaDkwMHYzMDBIMHoiLz48L3N2Zz4=" alt="Indonesia Flag">
            <img src="image/LOGOKING.png" alt="King Muaythai Logo" class="logo"></div>
        <div>© 2025 King Muaythai</div>
    </div>

    <script>
        document.getElementById('reset-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            alert('Link reset password telah dikirim ke ' + email + '. Silakan periksa email Anda.');
        });
    </script>
</body>
</html>