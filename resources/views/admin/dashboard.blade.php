<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - RETRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d6efd;
            --success-color: #198754;
            --warning-color: #f7b924;
            --danger-color: #d92550;
        }
        body { background: #f0f2f5; font-family: 'Inter', sans-serif; }
        
        .card-stat { 
            border: none; 
            border-radius: 12px; 
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); 
            transition: all 0.3s ease; 
            background: white;
            position: relative;
        }
        .card-stat:hover { transform: translateY(-3px); box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); }
        
        .icon-box {
            width: 48px; height: 48px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; margin-bottom: 1rem;
        }
        
        .navbar { box-shadow: 0 2px 4px rgba(0,0,0,.08); }
        .table-box { background: white; border-radius: 12px; border: none; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .stat-label { color: #6c757d; font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-value { font-size: 1.75rem; font-weight: 700; color: #343a40; }
        .extra-small { font-size: 0.75rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-recycle me-2"></i> RETRIS ADMIN
        </a>
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle border-0" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="bi bi-box-arrow-right me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0 text-dark">Ringkasan Sistem</h4>
        <span class="badge bg-white text-dark shadow-sm py-2 px-3 rounded-pill border">
            <i class="bi bi-calendar3 me-2 text-primary"></i> {{ $bulanIni }}
        </span>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card card-stat p-3 text-decoration-none">
                <div class="icon-box bg-success-subtle text-success">
                    <i class="bi bi-person-vcard-fill"></i>
                </div>
                <div class="stat-label">Total Petugas</div>
                <div class="stat-value">{{ $totalPetugas ?? 0 }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat p-3">
                <div class="icon-box bg-primary-subtle text-primary">
                    <i class="bi bi-houses-fill"></i>
                </div>
                <div class="stat-label">Rumah Terdaftar</div>
                <div class="stat-value">{{ $totalRumah ?? 0 }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat p-3">
                <div class="icon-box bg-info-subtle text-info">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div class="stat-label">Pendapatan Iuran</div>
                <div class="stat-value" style="font-size: 1.4rem;">Rp {{ number_format($totalIuran ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stat p-3">
                <div class="icon-box bg-danger-subtle text-danger">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-label">Belum Bayar</div>
                <div class="stat-value text-danger">{{ $rumahMenunggak ?? 0 }}</div>
            </div>
        </div>
    </div>

    <div class="card table-box mb-5">
        <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0"><i class="bi bi-arrow-left-right me-2 text-primary"></i>Transaksi Terbaru</h5>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalPreview">
                    <i class="bi bi-printer me-1"></i> Cetak Laporan
                </button>
                <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Lihat Semua</button>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 border-0 text-muted small">WARGA</th>
                            <th class="border-0 text-muted small">KATEGORI</th>
                            <th class="border-0 text-muted small">NOMINAL</th>
                            <th class="border-0 text-muted small">PERIODE</th>
                            <th class="border-0 text-muted small">WAKTU</th>
                            <th class="pe-4 border-0 text-muted small text-end">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentPayments as $payment)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="bi bi-person text-secondary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $payment->user->name ?? 'User Terhapus' }}</div>
                                        <div class="text-muted extra-small">{{ $payment->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($payment->type == 'topup')
                                    <span class="badge rounded-pill bg-info-subtle text-info px-3">Top Up</span>
                                @else
                                    <span class="badge rounded-pill bg-primary-subtle text-primary px-3">Iuran</span>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td><span class="text-muted small">{{ $payment->month ?? 'N/A' }}</span></td>
                            <td>
                                <div class="small text-dark">{{ $payment->created_at->format('d M Y') }}</div>
                                <div class="text-muted extra-small">{{ $payment->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="pe-4 text-end">
                                <span class="badge bg-success-subtle text-success px-2 py-1 border border-success-subtle">
                                    Sukses
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <span class="text-muted">Belum ada transaksi bulan ini</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPreview" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-body p-4 text-center">
                <div class="icon-box bg-primary-subtle text-primary mx-auto mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-file-earmark-pdf fs-2"></i>
                </div>
                <h6 class="fw-bold mb-1">Rekap Transaksi</h6>
                <p class="text-muted extra-small mb-3">Periode {{ $bulanIni }}</p>
                
                <div class="bg-light p-3 rounded-3 mb-4 text-start">
                    <div class="d-flex justify-content-between mb-1 small">
                        <span>Total Iuran:</span>
                        <span class="fw-bold text-success">Rp {{ number_format($totalIuran, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span>Menunggak:</span>
                        <span class="fw-bold text-danger">{{ $rumahMenunggak }} Rumah</span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.dashboard.cetak') }}" target="_blank" class="btn btn-primary rounded-pill">
                        Unduh PDF
                    </a>
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>