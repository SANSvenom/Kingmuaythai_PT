<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Muaythai Indonesia</title>
    <link rel="stylesheet" href="css/welcome.css">

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">
                <img src="image/LOGOKING.png" alt="King Muaythai Logo">
                King Muaythai
            </a>
            <ul class="nav-links">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang Kami</a></li>
                <li><a href="#benefit">Benefit</a></li>
                <li><a href="#login">Masuk</a></li>
            </ul>
            <button class="mobile-menu-btn">☰</button>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="header" id="home">
        <h1>King Muaythai Indonesia</h1>
        <p>Latihan Muay Thai profesional untuk semua level. Tingkatkan kebugaran, kekuatan dan rasa percaya diri Anda bersama pelatih berpengalaman.</p>
        <a href="register.php" class="btn">Gabung Sekarang</a>
    </header>

    <!-- About Section -->
    <section class="about" id="about">
        <h2 class="section-title">Tentang Kami</h2>
        <div class="about-content">
            <div class="about-text">
                <h3>Selamat Datang di King Muaythai</h3>
                <p>King Muaythai adalah pusat pelatihan Muay Thai terkemuka di Indonesia yang didedikasikan untuk menyediakan pelatihan berkualitas tinggi bagi semua tingkat kemampuan.</p>
                <p>Dengan pelatih berpengalaman dan fasilitas modern, kami menawarkan lingkungan yang mendukung dan memotivasi untuk membantu Anda mencapai tujuan kebugaran dan bela diri Anda.</p>
                <p>Baik Anda seorang pemula yang ingin belajar dasar-dasar Muay Thai atau seorang petarung berpengalaman yang ingin mengasah keterampilan Anda, kami memiliki program yang sesuai untuk Anda.</p>
            </div>
        </div>
    </section>

    <!-- Benefit Section -->
<section class="programs" id="benefit">
    <h2 class="section-title">Benefit</h2>
    <div class="programs-container">
        <!-- Benefit Card 1 -->
        <div class="program-card">
            <div class="program-img">
                <img src="image/pelatihan.jpg" alt="Latihan Terorganisir">
            </div>
            <div class="program-content">
                <h3>Latihan Terorganisir</h3>
                <p>Setiap sesi dirancang dengan struktur yang jelas, efektif, dan disesuaikan dengan kemampuan Anda.</p>
            </div>
        </div>
        
        <!-- Benefit Card 2 -->
        <div class="program-card">
            <div class="program-img">
                <img src="image/payment.jpg" alt="Pembayaran Aman">
            </div>
            <div class="program-content">
                <h3>Pembayaran Aman & Praktis</h3>
                <p>Proses pembayaran cepat, aman, dan bisa dilakukan melalui berbagai metode digital.</p>
            </div>
        </div>
        
        <!-- Benefit Card 3 -->
        <div class="program-card">
            <div class="program-img">
                <img src="image/relation.jpg" alt="Relasi dan Trainer Luas">
            </div>
            <div class="program-content">
                <h3>Relasi & Trainer yang Luas</h3>
                <p>Dapatkan koneksi dengan komunitas Muay Thai dan pelatih profesional dari berbagai latar belakang.</p>
            </div>
        </div>
    </div>
</section>


    <!-- Login Section -->
    <section class="login-section" id="login">
        <div class="login-container">
            <h2>BERGABUNG DENGAN KAMI</h2>
            <p style="text-align: center; margin-bottom: 30px; color: #666;">Akses jadwal latihan, booking kelas, dan fitur eksklusif untuk member</p>
            
            <a href="login.php" class="login-btn" style="display: block; text-align: center; text-decoration: none; margin-bottom: 15px;">MASUK</a>
            
            <div class="divider">
                <span>ATAU</span>
            </div>
            
            <a href="register.php" class="login-btn" style="display: block; text-align: center; text-decoration: none; background-color: #333;">DAFTAR SEKARANG</a>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="forgot-password.php" style="color: #c40000; text-decoration: none; font-size: 0.9rem;">Lupa password?</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-col">
                <h3>King Muaythai</h3>
                <p>Pusat pelatihan Muay Thai profesional yang menawarkan berbagai program untuk semua tingkat kemampuan.</p>
                <div class="social-icons">
                    <a href="#"><span>FB</span></a>
                    <a href="#"><span>IG</span></a>
                    <a href="#"><span>YT</span></a>
                    <a href="#"><span>TW</span></a>
                </div>
            </div>
            
            <div class="footer-col">
                <h3>Link Cepat</h3>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#programs">Program</a></li>
                    <li><a href="#login">Masuk</a></li>
                </ul>
            </div>
            
            <div class="footer-col">
                <h3>Kontak Kami</h3>
                <p>Jl. Terusan Buah Batu No.54</p>
                <p>Kota Bandung, Jawa Barat</p>
                <p>Email: info@kingmuaythai.id</p>
                <p>Telepon: 0878-3289-1722</p>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2025 King Muaythai Indonesia. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');
        
        mobileMenuBtn.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
                
                // Close mobile menu after clicking a link
                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>