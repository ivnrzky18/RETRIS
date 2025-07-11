<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nama Perusahaan Akuntansi Anda - Solusi Keuangan Terpercaya</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Variabel Warna */
        :root {
            --primary-color: #2C3E50; /* Dark Blue */
            --accent-color: #3498DB;  /* Bright Blue */
            --light-bg: #F8F9FA;     /* Off-white */
            --dark-text: #333333;
            --light-text: #FFFFFF;
            --gray-text: #7F8C8D;
            --danger-color: #E74C3C; /* Red for Logout */
        }

        /* Base Styles */
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: var(--dark-text);
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            color: var(--primary-color);
            margin-bottom: 0.8em;
        }

        h1 { font-size: 2.8em; }
        h2 { font-size: 2.2em; }
        h3 { font-size: 1.8em; }

        p {
            margin-bottom: 1em;
        }

        a {
            color: var(--accent-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: var(--primary-color);
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: var(--light-text);
        }

        .btn-primary:hover {
            background-color: #2980B9; /* Darker accent */
        }

        .btn-secondary {
            background-color: var(--primary-color);
            color: var(--light-text);
        }

        .btn-secondary:hover {
            background-color: #212F3D; /* Darker primary */
        }

        .btn-outline-primary {
            background-color: transparent;
            color: var(--accent-color);
            border: 2px solid var(--accent-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--accent-color);
            color: var(--light-text);
        }

        .btn-large {
            padding: 15px 30px;
            font-size: 1.1em;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: var(--light-text);
        }

        .btn-danger:hover {
            background-color: #C0392B; /* Darker red */
        }

        /* Header & Navbar */
        .main-header {
            background-color: var(--light-text);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 15px 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px; /* Adjust as needed */
        }

        .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav-links li {
            margin-left: 30px;
            position: relative;
        }

        .nav-links a {
            color: var(--primary-color);
            font-weight: 500;
            padding: 10px 0;
            display: block;
        }

        .nav-links a:hover {
            color: var(--accent-color);
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: var(--light-text);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            min-width: 180px;
            z-index: 10;
            border-radius: 5px;
            overflow: hidden;
            padding: 10px 0;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            color: var(--dark-text);
            padding: 10px 20px;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: var(--light-bg);
            color: var(--accent-color);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://via.placeholder.com/1920x800?text=Akuntansi+Perusahaan') no-repeat center center/cover; /* Ganti dengan gambar yang relevan */
            color: var(--light-text);
            text-align: center;
            padding: 100px 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .hero-section h1 {
            color: var(--light-text);
            font-size: 3.5em;
            margin-bottom: 0.5em;
        }

        .hero-section p {
            font-size: 1.3em;
            margin-bottom: 2em;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons .btn {
            margin: 0 10px;
        }

        /* Services Overview */
        .services-overview {
            padding: 80px 0;
            background-color: var(--light-bg);
            text-align: center;
        }

        .services-overview h2 {
            margin-bottom: 40px;
        }

        .service-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .service-card {
            background-color: var(--light-text);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-card .icon {
            font-size: 3em;
            color: var(--accent-color);
            margin-bottom: 20px;
        }

        .service-card h3 {
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        /* Why Choose Us */
        .why-choose-us {
            padding: 80px 0;
            background-color: var(--light-text);
            text-align: center;
        }

        .why-choose-us h2 {
            margin-bottom: 40px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-item {
            padding: 30px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            text-align: center;
        }

        .feature-item i {
            font-size: 2.5em;
            color: var(--accent-color);
            margin-bottom: 15px;
        }

        .feature-item h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        /* Call to Action Section */
        .call-to-action {
            background-color: var(--primary-color);
            color: var(--light-text);
            padding: 60px 20px;
            text-align: center;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .call-to-action h2 {
            color: var(--light-text);
            margin-bottom: 20px;
        }

        .call-to-action p {
            font-size: 1.1em;
            margin-bottom: 30px;
        }


        /* Footer */
        .main-footer {
            background-color: var(--primary-color);
            color: var(--light-text);
            padding: 60px 0 20px;
            font-size: 0.9em;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .footer-col h4 {
            color: var(--light-text);
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: var(--light-text);
            opacity: 0.8;
        }

        .footer-col ul li a:hover {
            opacity: 1;
            color: var(--accent-color);
        }

        .footer-col p {
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .footer-col i {
            margin-right: 8px;
            color: var(--accent-color);
        }

        .social-icons a {
            color: var(--light-text);
            font-size: 1.5em;
            margin-right: 15px;
            opacity: 0.8;
        }

        .social-icons a:hover {
            color: var(--accent-color);
            opacity: 1;
        }

        .footer-bottom {
            text-align: center;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 20px;
            opacity: 0.7;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                margin-top: 15px;
                /* Ini akan dikontrol oleh JS untuk menu mobile, defaultnya disembunyikan */
                display: none;
            }

            .nav-links.active { /* Kelas untuk menampilkan menu mobile */
                display: flex;
            }

            .nav-links li {
                margin: 0;
                width: 100%;
                text-align: center;
            }

            .nav-links li a {
                padding: 15px 0;
                border-top: 1px solid #eee;
            }

            .dropdown-menu {
                position: static;
                box-shadow: none;
                width: 100%;
                padding: 0;
            }

            .dropdown-menu a {
                padding-left: 40px; /* Indent dropdown items */
            }

            .hero-section h1 {
                font-size: 2.5em;
            }

            .hero-section p {
                font-size: 1em;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .hero-buttons .btn {
                margin: 10px 0;
                width: 80%; /* Adjust width for mobile buttons */
                max-width: 300px;
            }

            .service-cards, .features-grid, .footer-grid {
                grid-template-columns: 1fr;
            }

            .mobile-menu-toggle {
                display: block; /* Tampilkan tombol toggle di mobile */
            }
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none; /* Sembunyikan secara default di desktop */
            background: none;
            border: none;
            font-size: 1.8em;
            color: var(--primary-color);
            cursor: pointer;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <header class="main-header">
     <nav class="navbar">
        <div class="container">
            <!-- <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('img/logo.png') }}" alt="Nama Perusahaan Logo">
            </a> -->
            <button class="mobile-menu-toggle" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li class="dropdown">
                    <a href="#">Layanan <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-menu">
                        <a href="{{ url('/layanan/pajak') }}">Pajak</a>
                        <a href="{{ url('/layanan/audit') }}">Audit</a>
                        <a href="{{ url('/layanan/pembukuan') }}">Pembukuan</a>
                        </div>
                </li>
                <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                <li><a href="{{ url('/blog') }}">Artikel</a></li>
                <li><a href="{{ url('/kontak') }}">Hubungi Kami</a></li>

                {{-- Bagian Autentikasi Laravel --}}
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}" >Register</a></li>
                    @endif
                @else
                    <li class="dropdown">
                        <a href="#">{{ Auth::user()->name }} <i class="fas fa-chevron-down"></i></a>
                        <div class="dropdown-menu">
                            <a href="{{ url('/dashboard') }}">Dashboard</a> {{-- Asumsi ada halaman dashboard --}}
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn-danger-link">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                {{-- Akhir Bagian Autentikasi --}}

            </ul>
            {{-- Tombol CTA utama (non-auth) --}}
            @guest
                @endguest
        </div>
    </nav>
    </header>

    <main class="content-wrapper">
        <section class="hero-section">
            <div class="container">
                <h1>Solusi Akuntansi Terpercaya untuk Masa Depan Keuangan Anda</h1>
                <p>Membantu bisnis Anda tumbuh dengan layanan akuntansi, pajak, dan konsultasi profesional.</p>
                <div class="hero-buttons">
                    <a href="{{ url('/konsultasi') }}" class="btn btn-primary btn-large">Mulai Konsultasi Gratis</a>
                    <a href="{{ url('/layanan') }}" class="btn btn-secondary btn-large">Lihat Layanan Kami</a>
                </div>
            </div>
        </section>

        <section class="services-overview">
            <div class="container">
                <h2>Layanan Unggulan Kami</h2>
                <div class="service-cards">
                    <div class="service-card">
                        <i class="fas fa-chart-line icon"></i>
                        <h3>Konsultasi Pajak</h3>
                        <p>Optimalkan kewajiban pajak Anda dengan panduan ahli kami.</p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-book icon"></i>
                        <h3>Pembukuan & Laporan Keuangan</h3>
                        <p>Catatan keuangan akurat untuk keputusan bisnis yang lebih baik.</p>
                    </div>
                    <div class="service-card">
                        <i class="fas fa-magnifying-glass-dollar icon"></i>
                        <h3>Audit Independen</h3>
                        <p>Memastikan transparansi dan kepatuhan finansial perusahaan Anda.</p>
                    </div>
                </div>
                <div class="text-center">
                    <a href="{{ url('/layanan') }}" class="btn btn-outline-primary">Pelajari Lebih Lanjut tentang Layanan Kami</a>
                </div>
            </div>
        </section>

        <section class="why-choose-us">
            <div class="container">
                <h2>Mengapa Memilih Kami?</h2>
                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fas fa-award"></i>
                        <h3>Pengalaman & Keahlian</h3>
                        <p>Tim profesional dengan pengalaman bertahun-tahun di berbagai industri.</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Integritas & Kepercayaan</h3>
                        <p>Menjaga kerahasiaan dan integritas data keuangan Anda adalah prioritas kami.</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-lightbulb"></i>
                        <h3>Solusi Inovatif</h3>
                        <p>Mengadopsi teknologi terbaru untuk layanan yang lebih efisien dan akurat.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="call-to-action">
            <div class="container">
                <h2>Siap Mengelola Keuangan Anda dengan Lebih Baik?</h2>
                <p>Hubungi kami hari ini untuk konsultasi gratis dan temukan bagaimana kami dapat membantu.</p>
                <a href="{{ url('/kontak') }}" class="btn btn-primary btn-large">Hubungi Kami Sekarang</a>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>Nama Perusahaan Akuntansi Anda</h4>
                    <p>Solusi keuangan terpercaya untuk bisnis Anda.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Link Cepat</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><a href="{{ url('/layanan') }}">Layanan</a></li>
                        <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Hubungi Kami</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Alamat Lengkap Anda</p>
                    <p><i class="fas fa-phone"></i> +62 XXXX XXXX XXXX</p>
                    <p><i class="fas fa-envelope"></i> info@perusahaananda.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Universitas Hang Tuah Pekanbaru.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const navLinks = document.querySelector('.nav-links');

            if (mobileMenuToggle && navLinks) {
                mobileMenuToggle.addEventListener('click', function () {
                    navLinks.classList.toggle('active');
                });
            }

            // Untuk dropdown menu di desktop
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('mouseenter', () => {
                    const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                    if (dropdownMenu) {
                        dropdownMenu.style.display = 'block';
                    }
                });
                dropdown.addEventListener('mouseleave', () => {
                    const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                    if (dropdownMenu) {
                        dropdownMenu.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>