<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Peran - RETRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #0D47A1, #081F4D);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px; /* Tambahan agar tidak mepet di HP */
        }

        .choose-container {
            background: #fff;
            max-width: 800px;
            width: 100%;
            border-radius: 20px; /* Sedikit lebih bulat */
            box-shadow: 0 15px 40px rgba(0,0,0,.35);
            padding: 50px 40px;
            text-align: center;
        }

        .choose-header i {
            font-size: 3.5rem; /* Sedikit lebih besar */
            color: #2ECC71;
            margin-bottom: 10px;
        }

        .choose-header h2 {
            color: #0D47A1;
            margin: 10px 0;
            font-weight: 700;
        }

        .choose-header p {
            color: #666;
            margin-bottom: 40px;
        }

        .role-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Ukuran lebih pas */
            gap: 25px;
            justify-content: center;
        }

        .role-card {
            background: #ffffff;
            border: 2px solid #f0f0f0; /* Tambah border halus */
            border-radius: 16px;
            padding: 40px 25px;
            transition: all .3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .role-card:hover {
            transform: translateY(-8px);
            border-color: #2ECC71; /* Highlight saat hover */
            box-shadow: 0 10px 25px rgba(0,0,0,.1);
        }

        .role-card i {
            font-size: 3.5rem;
            margin-bottom: 20px;
        }

        .role-card h3 {
            margin: 10px 0;
            color: #0D47A1;
            font-size: 1.4rem;
        }

        .role-card p {
            font-size: .95rem;
            color: #555;
            line-height: 1.5;
            margin-bottom: 30px;
            min-height: 60px; /* Biar tinggi kartu seimbang */
        }

        .btn-role {
            display: block; /* Buat tombol full width di dalam kartu */
            padding: 14px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            transition: .3s;
            text-align: center;
        }

        .btn-warga { background: #2ECC71; }
        .btn-warga:hover { background: #27AE60; }

        .btn-petugas { background: #0D47A1; }
        .btn-petugas:hover { background: #1565C0; }

        .back-link {
            margin-top: 40px;
            display: inline-block;
            color: #0D47A1;
            text-decoration: none;
            font-weight: 500;
            transition: .2s;
        }

        .back-link:hover { color: #2ECC71; }
    </style>
</head>
<body>

<div class="choose-container">
    <div class="choose-header">
        <i class="fas fa-recycle"></i>
        <h2>Pilih Peran Anda</h2>
        <p>Bergabunglah dengan RETRIS untuk pengelolaan sampah yang lebih baik</p>
    </div>

    <div class="role-cards">
        <div class="role-card">
            <div>
                <i class="fas fa-house-user" style="color:#2ECC71;"></i>
                <h3>Warga</h3>
                <p>Bayar retribusi dengan mudah, cek saldo, dan pantau jadwal pengangkutan sampah rumah Anda.</p>
            </div>
            <a href="{{ route('register') }}?role=warga" class="btn-role btn-warga">
                Daftar sebagai Warga
            </a>
        </div>

        <div class="role-card">
            <div>
                <i class="fas fa-truck-fast" style="color:#0D47A1;"></i>
                <h3>Petugas</h3>
                <p>Kelola data pengangkutan sampah harian dan konfirmasi kunjungan ke rumah warga secara real-time.</p>
            </div>
            <a href="{{ route('register') }}?role=petugas" class="btn-role btn-petugas">
                Daftar sebagai Petugas
            </a>
        </div>
    </div>

    <a href="{{ url('/') }}" class="back-link">← Kembali ke Beranda</a>
</div>

</body>
</html>