<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Warga - RETRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #0D47A1;
            --primary-light: #1565C0;
            --accent: #2ECC71;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --danger: #ef4444;
            --border: #e2e8f0;
            --info: #3b82f6;
            --warning: #f59e0b;
        }

        * { box-sizing: border-box; }
        body { 
            margin: 0; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg); 
            color: var(--text); 
            line-height: 1.6; 
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            padding: 15px 5%; 
            color: #fff; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: sticky; top: 0; z-index: 999; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .navbar .brand { font-size: 1.2rem; font-weight: 800; color: #fff; text-decoration: none; display: flex; align-items: center; gap: 8px; }
        .nav-right { display: flex; align-items: center; gap: 15px; }
        .nav-link { color: #fff; text-decoration: none; font-size: 0.85rem; font-weight: 600; opacity: 0.9; transition: 0.3s; }
        .nav-link:hover { opacity: 1; }
        
        .avatar-circle {
            width: 38px; height: 38px; border-radius: 12px; background: rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center; font-weight: bold; border: 1px solid rgba(255,255,255,0.3);
        }

        /* ===== LAYOUT & CARDS ===== */
        .container { 
            max-width: 1000px; /* Membatasi lebar agar tidak terlalu lebar */
            margin: 30px auto; 
            padding: 0 20px; 
        }
        
        .welcome { margin-bottom: 25px; }
        .welcome h2 { margin: 0; color: var(--text); font-weight: 700; }
        
        /* Grid System */
        .row-top { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .cards-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 20px; }
        
        @media (max-width: 768px) { 
            .row-top, .cards-grid { grid-template-columns: 1fr; } 
        }

        .card-custom {
            background: var(--card);
            padding: 20px;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        /* Special Cards */
        .bg-points { 
            background: linear-gradient(135deg, #10b981, #059669); 
            color: white; 
            border: none;
        }
        
        .progress-ai { height: 10px; border-radius: 10px; background: #f1f5f9; margin: 12px 0 8px; overflow: hidden; }
        .progress-bar-ai { height: 100%; transition: 0.8s cubic-bezier(0.4, 0, 0.2, 1); }

        /* Icon Boxes */
        .icon-box { 
            width: 48px; height: 48px; border-radius: 12px; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 1.4rem; color: #fff; flex-shrink: 0;
        }
        .bg-soft-blue { background: #dbeafe; color: var(--primary); }
        .bg-soft-orange { background: #ffedd5; color: var(--warning); }
        .bg-soft-green { background: #dcfce7; color: var(--accent); }

        .stat-card { display: flex; align-items: center; gap: 15px; }
        .stat-card h4 { margin: 0; font-size: 0.75rem; color: var(--muted); text-transform: uppercase; font-weight: 700; }
        .stat-card p { margin: 0; font-size: 1.15rem; font-weight: 700; }

        /* ===== QR & ACTION SECTION ===== */
        .main-action-grid { display: grid; grid-template-columns: 320px 1fr; gap: 20px; margin-bottom: 30px; }
        @media (max-width: 768px) { .main-action-grid { grid-template-columns: 1fr; } }

        .qr-card {
            background: white; padding: 25px; border-radius: 20px; text-align: center;
            border: 1px solid var(--border); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
        .qr-card img {
            width: 160px; height: 160px; padding: 8px; border: 1px solid var(--border);
            border-radius: 12px; margin-bottom: 15px;
        }

        .btn {
            padding: 12px 20px; border-radius: 12px; border: none; font-weight: 700; cursor: pointer;
            display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; font-size: 0.9rem;
            text-decoration: none; justify-content: center;
        }
        .btn-topup { background: var(--accent); color: white; width: 100%; margin-bottom: 10px; }
        .btn-pay { background: var(--primary); color: white; width: 100%; }
        .btn-lunas { background: #f1f5f9; color: #475569; width: 100%; cursor: default; }

        /* ===== TABLE ===== */
        .table-box { background: white; padding: 20px; border-radius: 16px; border: 1px solid var(--border); }
        .table-box h3 { margin: 0 0 15px; font-size: 1.1rem; color: var(--text); display: flex; align-items: center; gap: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 12px; border-bottom: 1px solid var(--border); color: var(--muted); font-size: 0.75rem; text-transform: uppercase; }
        td { padding: 12px; border-bottom: 1px solid #f8fafc; font-size: 0.85rem; }
        
        .badge { padding: 5px 10px; border-radius: 8px; font-size: 0.7rem; font-weight: 700; }
        .bg-light-success { background: #dcfce7; color: #166534; }
        .bg-light-primary { background: #dbeafe; color: #1e40af; }

        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.6); display: none; align-items: center; justify-content: center; z-index: 1000;
            backdrop-filter: blur(4px);
        }
        .modal-content { background: white; padding: 30px; border-radius: 24px; width: 90%; max-width: 400px; text-align: center; border: 1px solid var(--border); }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('warga.dashboard') }}" class="brand"><i class="bi bi-recycle"></i> RETRIS</a>
    <div class="nav-right">
        <a href="{{ route('warga.profile') }}" class="nav-link"><i class="bi bi-person-circle"></i> Profil</a>
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        <div class="avatar-circle">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
    </div>
</nav>

<div class="container">
    <div class="welcome">
        <h2>Halo, {{ auth()->user()->name }} 👋</h2>
        <p style="color:var(--muted); margin: 0; font-size: 0.9rem;">Kelola sampah dan pantau Green Points Anda hari ini.</p>
    </div>

    <div class="row-top">
        <div class="card-custom bg-points Stat-card">
            <div style="display:flex; justify-content: space-between; align-items: center; width: 100%;">
                <div>
                    <h6 style="margin:0; font-size: 0.75rem; text-transform: uppercase; opacity: 0.8;">Total Green Points</h6>
                    <h1 style="margin: 5px 0; font-size: 2.5rem; font-weight: 800;">{{ number_format(auth()->user()->points ?? 0) }}</h1>
                    <div style="font-size: 0.85rem;"><i class="bi bi-trophy-fill" style="color: #fbbf24;"></i> Rank: <b>{{ auth()->user()->rank ?? 'Warga Teladan' }}</b></div>
                </div>
                <i class="bi bi-stars" style="font-size: 3rem; opacity: 0.2;"></i>
            </div>
        </div>

        <div class="card-custom">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h6 style="margin:0; font-size: 0.75rem; text-transform: uppercase; color: var(--muted); font-weight: 700;">
                    <i class="bi bi-cpu-fill text-primary"></i> Monitoring AI
                </h6>
                <span class="badge {{ ($user->persentase_kepenuhan ?? 0) > 80 ? 'bg-light-danger' : 'bg-light-primary' }}" style="background: #eff6ff; color: #1e40af;">
                    {{ $user->persentase_kepenuhan ?? 0 }}% Penuh
                </span>
            </div>
            <div class="progress-ai">
                @php 
                    $p = $user->persentase_kepenuhan ?? 0;
                    $color = '#2ecc71';
                    if($p > 50) $color = '#f59e0b';
                    if($p > 80) $color = '#ef4444';
                @endphp
                <div class="progress-bar-ai" style="width: {{ $p }}%; background: {{ $color }};"></div>
            </div>
            <p style="font-size: 0.75rem; color: var(--muted); margin: 0;">
                <i class="bi bi-info-circle"></i> Estimasi volume bak sampah saat ini.
            </p>
        </div>
    </div>

    <div class="main-action-grid">
        <div class="qr-card">
            <h6 style="margin:0 0 15px; font-size: 0.75rem; text-transform: uppercase; color: var(--muted); font-weight: 700;">ID Digital Warga</h6>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data={{ auth()->id() }}" alt="QR Code">
            <div style="margin-top: 10px;">
                <h5 style="margin: 0; font-weight: 700;">{{ auth()->user()->name }}</h5>
                <p style="margin: 5px 0 0; font-size: 0.85rem; color: var(--muted);"><i class="bi bi-geo-alt-fill text-danger"></i> Blok {{ auth()->user()->blok ?? '-' }} / No. {{ auth()->user()->no_rumah ?? '-' }}</p>
            </div>
        </div>

        <div>
            <div class="cards-grid">
                <div class="card-custom stat-card">
                    <div class="icon-box bg-soft-blue"><i class="bi bi-wallet2"></i></div>
                    <div>
                        <h4>Saldo</h4>
                        <p>Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="card-custom stat-card">
                    <div class="icon-box bg-soft-orange"><i class="bi bi-cash-stack"></i></div>
                    <div>
                        <h4>Tagihan</h4>
                        <p style="color: {{ $sudahBayar ? 'var(--accent)' : 'var(--danger)' }}">
                            Rp {{ $sudahBayar ? '0' : number_format($tagihanSekarang, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div class="card-custom stat-card">
                    <div class="icon-box bg-soft-green"><i class="bi bi-truck"></i></div>
                    <div>
                        <h4>Status</h4>
                        @php $isCollectedToday = auth()->user()->isCollectedToday(); @endphp
                        <p style="font-size: 0.95rem; color: {{ $isCollectedToday ? 'var(--accent)' : 'var(--danger)' }};">
                            {{ $isCollectedToday ? 'Selesai' : 'Menunggu' }}
                        </p>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 12px;">
                <a href="{{ route('warga.topup') }}" class="btn btn-topup" style="flex: 1;">
                    <i class="bi bi-plus-circle"></i> Isi Saldo
                </a>
                <div style="flex: 1.5;">
                    @if($sudahBayar)
                        <button class="btn btn-lunas"><i class="bi bi-check-circle-fill"></i> Iuran {{ $bulanIni }} Lunas</button>
                    @else
                        <button onclick="openPayModal()" class="btn btn-pay"><i class="bi bi-credit-card-2"></i> Bayar Iuran {{ $bulanIni }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="table-box">
        <h3><i class="bi bi-clock-history text-primary"></i> Riwayat Aktivitas</h3>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Aktivitas</th>
                        <th>Detail</th>
                        <th>Poin/Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $item)
                    <tr>
                        <td>{{ $item->collected_at->format('d/m/y H:i') }}</td>
                        <td><span class="badge bg-light-success"><i class="bi bi-recycle"></i> Pengangkutan</span></td>
                        <td>Sampah diangkut petugas</td>
                        <td style="font-weight: 700; color: var(--accent);">+10 Poin</td>
                    </tr>
                    @empty
                    @endforelse

                    @foreach($riwayatTransaksi as $trx)
                    <tr>
                        <td>{{ $trx->created_at->format('d/m/y H:i') }}</td>
                        <td>
                            <span class="badge {{ $trx->type == 'topup' ? 'bg-light-success' : 'bg-light-primary' }}">
                                {{ strtoupper($trx->type) }}
                            </span>
                        </td>
                        <td>{{ $trx->type == 'iuran' ? 'Iuran '.$trx->month : 'Top Up Saldo' }}</td>
                        <td style="font-weight: 700; color: {{ $trx->type == 'topup' ? 'var(--accent)' : 'var(--danger)' }}">
                            {{ $trx->type == 'topup' ? '+' : '-' }}Rp{{ number_format($trx->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                    @if($history->isEmpty() && $riwayatTransaksi->isEmpty())
                        <tr><td colspan="4" style="text-align:center; padding:30px; color: var(--muted);">Belum ada riwayat aktivitas.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(!$sudahBayar)
<div id="payModal" class="modal-overlay">
    <div class="modal-content">
        <div style="background: #eff6ff; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: var(--primary); font-size: 1.5rem;">
            <i class="bi bi-wallet2"></i>
        </div>
        <h3 style="margin: 0 0 10px; font-weight: 800;">Konfirmasi Bayar</h3>
        <p style="color:var(--muted); font-size: 0.9rem;">Bayar iuran <b>{{ $bulanIni }}</b> sebesar <br><b style="color:var(--text); font-size: 1.2rem;">Rp {{ number_format($tagihanSekarang, 0, ',', '.') }}</b>?</p>
        <hr style="border: 0; border-top: 1px solid var(--border); margin: 20px 0;">
        <form action="{{ route('warga.bayar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-pay" style="margin-bottom: 8px;">Bayar Sekarang</button>
        </form>
        <button onclick="closeModal('payModal')" class="btn" style="width:100%; background:transparent; color:var(--muted);">Batal</button>
    </div>
</div>
@endif

<script>
    function openPayModal() { document.getElementById('payModal').style.display = 'flex'; }
    function closeModal(id) { document.getElementById(id).style.display = 'none'; }
    
    // Close modal if clicking outside
    window.onclick = function(event) {
        if (event.target.className === 'modal-overlay') {
            event.target.style.display = 'none';
        }
    }
</script>

</body>
</html>