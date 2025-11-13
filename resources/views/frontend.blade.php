<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Kos - Griya Amanah</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            /* Tema Warna Baru: Biru Tua & Oranye (Properti/Keuangan) */
            --primary-color: #0D47A1; /* Biru Tua */
            --accent-color: #FFA000; /* Oranye Kuning */
            --light-bg: #F8F9FA;
            --dark-text: #333333;
            --light-text: #FFFFFF;
            --danger-color: #E74C3C;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 0;
            color: var(--dark-text);
        }

        /* Header */
        .main-header {
            background-color: var(--light-text);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px; /* Tambahkan padding agar tidak mentok */
        }
        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .nav-links li {
            margin-left: 20px;
            position: relative;
        }
        .nav-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        .nav-links a:hover {
            color: var(--accent-color);
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 5px;
            top: 100%;
            left: 0;
            min-width: 150px; /* Tambah lebar agar tombol logout muat */
        }
        .dropdown-menu a {
            display: block;
            padding: 8px 15px;
            color: var(--dark-text);
        }
        .dropdown-menu a:hover {
            background-color: #eee;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            /* Ubah URL background (asumsi Anda memiliki gambar yang lebih sesuai) */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url("{{ asset('img/kosan.png') }}") center/cover no-repeat; 
            color: #fff;
            text-align: center;
            padding: 120px 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.2rem;
        }
        /* Buttons - Konsisten dengan tema warna baru */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            text-decoration: none; /* Penting untuk tag <a> */
            transition: background-color 0.3s;
        }
        .btn-primary {
            background: var(--accent-color);
            color: var(--light-text);
        }
        .btn-primary:hover {
            background-color: #FFB300; /* Oranye lebih terang */
        }
        .btn-secondary {
            background: var(--primary-color);
            color: var(--light-text);
        }
        .btn-secondary:hover {
            background-color: #1565C0; /* Biru sedikit lebih terang */
        }
        .btn-danger {
            background: var(--danger-color);
            color: #fff;
        }

        /* Foto Adila di hero (Ganti menjadi Ilustrasi/Logo Kos) */
        .foto-adila {
            position: absolute;
            bottom: 30px;
            right: 30px;
            width: 150px; /* Diperkecil */
            height: 150px;
            border-radius: 50%;
            border: 4px solid #fff3e0; /* Krem lembut */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            object-fit: cover;
            background-color: #fff;
            z-index: 10;
            /* Hapus animasi untuk kesederhanaan */
            /* animation: fadeIn 1.2s ease-in-out; */
        }

        /* Services */
        .services-overview {
            padding: 80px 20px;
            text-align: center;
            max-width: 1200px;
            margin: auto;
        }
        .service-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
            gap: 20px;
        }
        .service-card {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        .service-card:hover { transform: translateY(-5px); }
        .service-card .icon {
            font-size: 3em;
            color: var(--accent-color);
        }

        /* Why Choose Us */
        .why-choose-us {
            padding: 80px 20px;
            background: var(--light-bg);
            text-align: center;
            max-width: 1200px;
            margin: auto;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
            gap: 20px;
        }
        .feature-item {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .feature-item i {
            font-size: 2.5em;
            color: var(--accent-color);
            margin-bottom: 10px;
        }

        /* Footer */
        .main-footer {
            background: var(--primary-color);
            color: #fff;
            padding: 40px 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<header class="main-header">
    <nav class="navbar">
        <div class="logo">
            <h2 style="color: var(--primary-color)"><i class="fas fa-house-chimney-crack"></i> Kos Manager Pro</h2>
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/kamar') }}">Daftar Kamar</a></li>
            <li><a href="{{ url('/fitur') }}">Fitur Kami</a></li>
            <li><a href="{{ url('/tentang') }}">Tentang Kami</a></li>
            <li><a href="{{ url('/kontak') }}">Kontak</a></li>

            {{-- Autentikasi Laravel (TETAP SAMA) --}}
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                @if(Route::has('register'))
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            @else
                <li class="dropdown">
                    <a href="#">{{ Auth::user()->name }} <i class="fas fa-chevron-down"></i></a>
                    <div class="dropdown-menu">
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </nav>
</header>

<main>
    <section class="hero-section">
        <img src="{{ asset('img/kosan.png') }}" alt="Ilustrasi Kos" class="foto-adila">
        
        <h1>Kelola Kos-kosan Anda Tanpa Ribet</h1>
        <p>Sistem terpadu untuk Kamar, Penyewa, dan Pembayaran Sewa. Lebih efisien dan akurat.</p>
        <div class="hero-buttons">
            <a href="{{ route('register') }}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Mulai Coba Gratis</a>
            <a href="{{ url('/fitur') }}" class="btn btn-secondary"><i class="fas fa-magnifying-glass"></i> Jelajahi Fitur</a>
        </div>
    </section>

    <section class="services-overview">
        <h2>Fokus Kami Untuk Bisnis Kos Anda</h2>
        <div class="service-cards">
            <div class="service-card">
                <i class="fas fa-house-user icon"></i>
                <h3>Manajemen Kamar & Penyewa</h3>
                <p>Data Kamar dan informasi Penyewa tersusun rapi dan mudah diakses.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-cash-register icon"></i>
                <h3>Pelacakan Pembayaran Sewa</h3>
                <p>Catat dan lacak pembayaran sewa, otomatisasi pengingat jatuh tempo.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-screwdriver-wrench icon"></i>
                <h3>Log Perawatan & Kerusakan</h3>
                <p>Pencatatan kerusakan kamar, monitoring perbaikan, dan biaya maintenance.</p>
            </div>
        </div>
    </section>

    <section class="why-choose-us">
        <h2>Mengapa Kos Manager Pro?</h2>
        <div class="features-grid">
            <div class="feature-item">
                <i class="fas fa-chart-line"></i>
                <h3>Laporan Keuangan Akurat</h3>
                <p>Rekapitulasi pendapatan sewa dan biaya pengeluaran real-time.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-mobile-alt"></i>
                <h3>Akses Kapan Saja</h3>
                <p>Pantau bisnis kos Anda dari mana saja, menggunakan perangkat apa pun.</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-shield-virus"></i>
                <h3>Keamanan Data Terjamin</h3>
                <p>Data properti dan penyewa Anda aman dengan sistem otentikasi terbaik.</p>
            </div>
        </div>
    </section>
</main>

<footer class="main-footer">
    <p>&copy; {{ date('Y') }} Kos Manager Pro - Solusi Manajemen Kos Terpercaya.</p>
</footer>

</body>
</html>