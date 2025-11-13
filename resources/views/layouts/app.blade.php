<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    {{-- Ubah Title ke Nama Aplikasi Kos --}}
    <title>@yield('title', 'Kos Manager Pro - Solusi Cerdas untuk Manajemen Kos')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Tambahkan Font Awesome untuk ikon yang lebih variatif --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Definisi Warna Tema Kos Manager Pro */
        :root {
            --primary-color: #0e53b9ff; /* Biru Tua */
            --accent-color: #FFC107; /* Kuning/Emas */
        }
        
        /* WARNA NAVIGASI */
        .bg-primary-custom {
            background-color: var(--primary-color) !important;
        }

        /* WARNA HERO SECTION (Ganti Hijau ke Biru Tua) */
        .hero-section {
            background: linear-gradient(to right, #0D47A1, #1a5391ff); /* Gradient Biru Tua */
            color: white;
            padding: 100px 0;
            text-align: center;
            min-height: calc(100vh - 56px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-section .lead {
            font-size: 1.5rem;
            margin-bottom: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Tombol yang ada di Hero Section */
        .hero-section .btn {
            font-size: 1.2rem;
            padding: 15px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .hero-section .btn-light {
            background-color: white;
            color: var(--primary-color); /* Teks Biru Tua pada tombol putih */
            border: 2px solid white;
        }

        .hero-section .btn-light:hover {
            background-color: transparent;
            color: white;
            border-color: white;
        }
        
        /* Tambahan: Ganti warna teks dropdown item agar tidak bentrok */
        .dropdown-item {
            color: var(--primary-color);
        }
        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: var(--primary-color);
        }

        /* Penyesuaian jika ada footer */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container.mt-4 {
            flex-grow: 1;
        }
    </style>

    @stack('styles')
</head>
<body>
    {{-- UBAH WARNA NAV BAR DARI bg-success menjadi custom Biru Tua --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary-custom">
        <div class="container">
            {{-- UBAH NAMA APLIKASI --}}
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                <i class="fas fa-house-chimney me-2"></i> Kos Manager Pro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                    {{-- GANTI DARI Kesehatan menjadi PROPERTI --}}
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}">
                            <i class="fas fa-chart-line me-1"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuTransaksi" data-bs-toggle="dropdown">
                            <i class="fas fa-exchange-alt me-1"></i> Transaksi & Log
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="menuTransaksi">
                            {{-- MAPPING: Pendaftaran Pasien -> Reservasi / Pencatatan Masuk --}}
                            <li><a class="dropdown-item" href="{{ route('pendaftaranpasien.index') }}">
                                <i class="fas fa-user-check me-2"></i> Pendaftaran Penyewa
                            </a></li>
                            {{-- MAPPING: Pembayaran -> Pembayaran Sewa --}}
                            <li><a class="dropdown-item" href="{{ route('pembayaran_sewa.index') }}">
                                <i class="fas fa-money-bill-wave me-2"></i> Pembayaran Sewa
                            </a></li>
                            {{-- MAPPING: Rekam Medis -> Laporan Kerusakan --}}
                            <li><a class="dropdown-item" href="{{ route('rekammedis.index') }}">
                                <i class="fas fa-tools me-2"></i> Laporan Kerusakan
                            </a></li>
                            {{-- MAPPING: Pemeriksaan Dokter/Lab -> Biaya Tambahan/Inspeksi --}}
                            <li><a class="dropdown-item" href="{{ route('pemeriksaandokter.index') }}">
                                <i class="fas fa-file-invoice me-2"></i> Biaya Tambahan
                            </a></li>
                            
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuMaster" data-bs-toggle="dropdown">
                            <i class="fas fa-database me-1"></i> Data Utama
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="menuMaster">
                            {{-- MAPPING: Dokter -> Penyewa --}}
                            <li><a class="dropdown-item" href="{{ route('penyewa.index') }}">
                                <i class="fas fa-user-friends me-2"></i> Daftar Penyewa
                            </a></li>
                            {{-- MAPPING: Pasien -> Kamar --}}
                            <li><a class="dropdown-item" href="{{ route('kamar.index') }}">
                                <i class="fas fa-door-open me-2"></i> Daftar Kamar
                            </a></li>
                            {{-- MAPPING: Poli -> Tipe Kamar --}}
                            <li><a class="dropdown-item" href="{{ route('poli.index') }}">
                                <i class="fas fa-tags me-2"></i> Tipe Kamar
                            </a></li>
                        </ul>
                    </li>
                    
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name ?? 'Guest' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            {{-- Menu Logout --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container-fluid p-0"> 

    @yield('content') 

    {{-- Default Home Page Content (Hero Section) --}}
    @if (!trim($__env->yieldContent('content')))
        <section class="hero-section">
            <div class="container">
                {{-- UBAH TEKS JUDUL HERO --}}
                <h1 class="animate_animated animate_fadeInDown">Dashboard Manajemen Kos Properti</h1>
                <p class="lead animate_animated animate_fadeInUp">
                    Kelola kamar, penyewa, pembayaran sewa, dan laporan kerusakan secara terpadu. Ubah data lama Anda menjadi efisien dan akurat!
                </p>
                <div class="mt-4 animate_animated animatefadeInUp animate_delay-1s">
                    @auth
                        {{-- UBAH ICON DAN WARNA TOMBOL --}}
                        <a href="{{ url('/dashboard') }}" class="btn btn-light me-3" style="color: var(--primary-color)">
                            <i class="fas fa-tachometer-alt me-2"></i> Masuk Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light me-3" style="color: var(--primary-color)">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light">
                            <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </section>
    @endif

</div>


    <div class="container mt-4"> 
        {{-- Tempat untuk pesan flash dan error --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @stack('scripts')
</body>
</html>