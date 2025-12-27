<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RETRIS - Retribusi Sampah RT</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --primary: #0D47A1;
            --accent: #2ECC71;
            --light: #F4F6F8;
            --dark: #333;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: var(--light);
            margin: 0;
            color: var(--dark);
        }

        /* ===== HEADER ===== */
        .main-header {
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            padding: 15px 0;
        }
        .navbar {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo h2 {
            margin: 0;
            color: var(--primary);
        }
        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .nav-links li {
            margin-left: 20px;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--primary);
            font-weight: 500;
        }
        .nav-links a:hover {
            color: var(--accent);
        }

        /* ===== HERO ===== */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,.55), rgba(0,0,0,.55)),
                        url("{{ asset('img/sampah.png') }}") center/cover no-repeat;
            color: #fff;
            text-align: center;
            padding: 120px 20px;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }
        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .hero-image {
            margin: 30px auto;
            max-width: 420px;
        }
        .hero-image img {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,.4);
        }
        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            margin: 8px;
        }
        .btn-primary {
            background: var(--accent);
            color: #fff;
        }
        .btn-primary:hover {
            background: #27AE60;
        }
        .btn-secondary {
            background: var(--primary);
            color: #fff;
        }
        .btn-secondary:hover {
            background: #1565C0;
        }

        /* ===== SECTION ===== */
        section {
            padding: 70px 20px;
            max-width: 1200px;
            margin: auto;
            text-align: center;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }
        .card {
            background: #fff;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
            transition: .3s;
        }
        .card:hover {
            transform: translateY(-6px);
        }
        .card i {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 15px;
        }

        /* ===== FOOTER ===== */
        .retris-footer {
            background: linear-gradient(135deg, #0D2C6C, #081F4D);
            color: #fff;
            padding: 70px 20px 25px;
            margin-top: 80px;
        }
        .footer-container {
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 40px;
        }
        .footer-col h3 {
            margin-bottom: 18px;
            position: relative;
        }
        .footer-col h3::after {
            content: "";
            width: 50px;
            height: 3px;
            background: var(--accent);
            position: absolute;
            left: 0;
            bottom: -8px;
            border-radius: 5px;
        }
        .footer-col p, .footer-col a {
            color: #ddd;
            font-size: .95rem;
            line-height: 1.7;
            text-decoration: none;
        }
        .footer-col a:hover {
            color: var(--accent);
        }
        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-col ul li {
            margin-bottom: 8px;
        }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,.2);
            margin-top: 40px;
            padding-top: 15px;
            text-align: center;
            font-size: .9rem;
            color: #ccc;
        }
    </style>
</head>
<body>

<header class="main-header">
    <nav class="navbar">
        <div class="logo">
            <h2><i class="fas fa-recycle"></i> RETRIS</h2>
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="#fitur">Fitur</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#kontak">Kontak</a></li>

            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ url('/register/choose') }}">Register</a></li>
                <li>
                    <a href="{{ url('/admin/login') }}" style="color:#E67E22;font-weight:bold;">
                        Login Admin
                    </a>
                </li>
            @else
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </nav>
</header>

<main>
    <section class="hero-section">
        <h1>Kelola Retribusi Sampah Jadi Lebih Mudah</h1>
        <p>Sistem digital untuk pembayaran online dan konfirmasi angkut sampah di lingkungan RT Anda.</p>


        <a href="{{ url('/register/choose') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Daftar Sekarang
        </a>
        <a href="#fitur" class="btn btn-secondary">
            <i class="fas fa-info-circle"></i> Lihat Fitur
        </a>
    </section>

    <section id="fitur">
        <h2>Fitur Utama RETRIS</h2>
        <div class="cards">
            <div class="card">
                <i class="fas fa-wallet"></i>
                <h3>Top Up Saldo Online</h3>
                <p>Warga dapat mengisi saldo retribusi secara online tanpa pungutan langsung.</p>
            </div>
            <div class="card">
                <i class="fas fa-truck"></i>
                <h3>Konfirmasi Angkut</h3>
                <p>Petugas mengonfirmasi rumah yang sampahnya telah diangkut secara real-time.</p>
            </div>
            <div class="card">
                <i class="fas fa-chart-line"></i>
                <h3>Monitoring RT</h3>
                <p>RT dapat memantau data pembayaran dan pengangkutan dengan transparan.</p>
            </div>
        </div>
    </section>

    <section id="tentang">
        <h2>Tentang RETRIS</h2>
        <p>
            RETRIS adalah sistem digital untuk membantu RT mengelola retribusi sampah
            secara adil, transparan, dan berbasis data.
        </p>
    </section>

    <section id="kontak">
        <h2>Hubungi Kami</h2>
        <p>Email: retris@rtbersih.id | Telp: 08xxxxxxxxxx</p>
    </section>
</main>

<footer class="retris-footer">
    <div class="footer-container">
        <div class="footer-col">
            <h3>RETRIS</h3>
            <p>Sistem Retribusi & Angkut Sampah berbasis digital untuk lingkungan RT.</p>
        </div>
        <div class="footer-col">
            <h3>Navigasi</h3>
            <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="#fitur">Fitur</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h3>Kontak</h3>
            <p>Pekanbaru, Riau</p>
            <p>08xxxxxxxxxx</p>
            <p>retris@rtbersih.id</p>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} RETRIS - Sistem Retribusi & Angkut Sampah RT
    </div>
</footer>

</body>
</html>
