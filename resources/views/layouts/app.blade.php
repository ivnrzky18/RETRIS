<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Akuntansi - Kelola Keuangan Anda')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* CSS Tambahan untuk Tampilan Awal yang Elegan */
        .hero-section {
            background: linear-gradient(to right, #dc3545, #8a0c1a); /* Gradient dari merah gelap ke merah tua */
            color: white;
            padding: 100px 0;
            text-align: center;
            min-height: calc(100vh - 56px); /* Menyesuaikan tinggi agar mengisi viewport, dikurangi tinggi navbar */
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

        .hero-section .btn {
            font-size: 1.2rem;
            padding: 15px 30px;
            border-radius: 50px; /* Tombol lebih membulat */
            transition: all 0.3s ease;
        }

        .hero-section .btn-light {
            background-color: white;
            color: #dc3545; /* Teks merah pada tombol putih */
            border: 2px solid white;
        }

        .hero-section .btn-light:hover {
            background-color: transparent;
            color: white;
            border-color: white;
        }

        .hero-section .btn-outline-light {
            color: white;
            border: 2px solid white;
        }

        .hero-section .btn-outline-light:hover {
            background-color: white;
            color: #dc3545; /* Teks merah pada hover */
        }

        /* Penyesuaian jika ada footer */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container.mt-4 {
            flex-grow: 1; /* Konten utama mengisi ruang yang tersisa */
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/dashboard') }}">Akuntansi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuTransaksi" data-bs-toggle="dropdown">
                            Transaksi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('journals.index') }}">Jurnal Umum</a></li>
                            <li><a class="dropdown-item" href="{{ route('journals.penyesuaian') }}">Jurnal Penyesuaian</a></li>
                            <li><a class="dropdown-item" href="{{ route('journals.penutup') }}">Jurnal Penutup</a></li>
                            <li><a class="dropdown-item" href="{{ route('ledger.index') }}">Buku Besar</a></li>
                            <li><a class="dropdown-item" href="{{ route('cashbank.index') }}">Kas & Bank</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuMaster" data-bs-toggle="dropdown">
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('accounts.index') }}">Daftar Akun</a></li>
                            <li><a class="dropdown-item" href="{{ route('periode-akuntansi.index') }}">Periode Akuntansi</a></li>
                            <li><a class="dropdown-item" href="{{ route('units.index') }}">Unit / Departemen</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuMaster" data-bs-toggle="dropdown">
                            Data Akademik Sekolah
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('siswa.index') }}">Daftar Siswa</a></li>
                            <li><a class="dropdown-item" href="{{ route('periode-akuntansi.index') }}">Daftar Guru</a></li>
                            <li><a class="dropdown-item" href="{{ route('units.index') }}">Jadwal Guru</a></li>
                            <li><a class="dropdown-item" href="{{ route('produk.index') }}">Daftar Produk</a></li>
                            <li><a class="dropdown-item" href="{{ route('supplier.index') }}">Daftar Supplier</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuLaporan" data-bs-toggle="dropdown">
                            Laporan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('laporan.jurnal-umum') }}">Jurnal Umum</a></li>
                            <li><a class="dropdown-item" href="{{ route('laporan.neraca-saldo') }}">Neraca Saldo</a></li>
                            <li><a class="dropdown-item" href="{{ route('laporan.laba-rugi') }}">Laba Rugi</a></li>
                            <li><a class="dropdown-item" href="{{ route('laporan.neraca') }}">Neraca</a></li>
                            <li><a class="dropdown-item" href="{{ route('laporan.perubahan-modal') }}">Perubahan Modal</a></li>
                            <li><a class="dropdown-item" href="{{ route('laporan.arus-kas') }}">Arus Kas</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuPengaturan" data-bs-toggle="dropdown">
                            Pengaturan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Manajemen User</a></li>
                            <li>
                                <form action="{{ route('transaksi.reset') }}" method="POST" onsubmit="return confirm('Yakin ingin mengosongkan semua data transaksi? Semua data akan dihapus secara permanen!')">
                                    @csrf
                                    <button class="btn btn-danger w-100" type="submit">
                                        Kosongkan
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name ?? 'Guest' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            {{-- Anda bisa menambahkan link terkait user lain di sini jika dibutuhkan --}}
                            {{-- <li><a class="dropdown-item" href="#">Profile</a></li> --}}
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container-fluid p-0"> {{-- Dulu: p-0, sekarang pakai p-4 agar ada ruang --}}

    @yield('content') {{-- Ini adalah placeholder utama untuk konten spesifik halaman anak --}}

    {{-- Default Home Page Content (Hero Section) --}}
    @if (!trim($__env->yieldContent('content')))
        <section class="hero-section">
            <div class="container">
                <h1 class="animate_animated animate_fadeInDown">Aplikasi Akuntansi Modern</h1>
                <p class="lead animate_animated animate_fadeInUp">
                    Kelola semua aspek keuangan bisnis Anda dengan mudah, akurat, dan efisien.
                </p>
                <div class="mt-4 animate_animated animatefadeInUp animate_delay-1s">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-light me-3">
                            <i class="bi bi-speedometer2 me-2"></i> Pergi ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light me-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light">
                            <i class="bi bi-person-plus me-2"></i> Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </section>
    @endif

</div>


    <div class="container mt-4"> {{-- Pesan flash dan error tetap di container terpisah --}}
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