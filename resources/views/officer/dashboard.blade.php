<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Officer - RETRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary: #0D47A1;
            --primary-light: #1565C0;
            --accent: #2ECC71;
            --bg: #eef2f7;
            --card: #ffffff;
            --text: #333;
            --muted: #777;
            --border: #e0e6ed;
        }

        body { margin: 0; font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); }

        .navbar-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            padding: 12px 25px; color: #fff; display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 999; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-custom .brand { font-size: 1.4rem; font-weight: bold; color: #fff; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .nav-right { display: flex; align-items: center; gap: 20px; }
        .avatar-circle {
            width: 35px; height: 35px; border-radius: 50%; background: rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center; font-weight: bold; border: 1px solid rgba(255,255,255,0.4);
        }

        #reader { 
            border-radius: 15px; 
            overflow: hidden; 
            border: none !important;
            background: #f8f9fa;
        }
        #reader__dashboard_section_csr span, #reader a { display: none !important; }

        .container-main { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .card-stat {
            background: var(--card); padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02); border: 1px solid var(--border);
        }
        .icon-box { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: #fff; }
        
        .table-box { background: white; padding: 25px; border-radius: 15px; border: 1px solid var(--border); }
        .search-input {
            width: 100%; padding: 12px 20px; border-radius: 10px; border: 1px solid var(--border);
            margin-bottom: 20px; outline: none;
        }

        .btn-confirm { background: var(--accent); color: white; border: none; padding: 8px 15px; border-radius: 8px; font-weight: bold; transition: 0.3s; }
        .btn-confirm:hover { background: #27ae60; transform: translateY(-2px); }
        
        .badge-custom { padding: 6px 12px; border-radius: 30px; font-size: 0.75rem; font-weight: bold; }

        .btn-camera-control {
            padding: 12px 25px; border-radius: 10px; font-weight: bold; transition: 0.3s; width: 100%; margin-bottom: 15px;
        }

        /* Styling Progress AI */
        .ai-label { font-size: 0.7rem; font-weight: bold; text-transform: uppercase; margin-bottom: 3px; display: block; }
    </style>
</head>
<body>

<div class="navbar-custom">
    <a href="#" class="brand"><i class="bi bi-recycle"></i> RETRIS <span style="font-size: 0.8rem; font-weight: normal; opacity: 0.8;">| OFFICER</span></a>
    <div class="nav-right">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-light border-0"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
        <div class="avatar-circle">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
    </div>
</div>

<div class="container-main">
    <div class="row g-3 mb-4 text-center text-md-start">
        <div class="col-md-4">
            <div class="card-stat">
                <div class="icon-box bg-primary"><i class="bi bi-truck"></i></div>
                <div>
                    <h6 class="text-muted mb-0 small uppercase">TERANGKUT HARI INI</h6>
                    <p class="fs-4 fw-bold mb-0">{{ $riwayatHariIni->count() }} Rumah</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-stat">
                <div class="icon-box bg-success"><i class="bi bi-people"></i></div>
                <div>
                    <h6 class="text-muted mb-0 small">TOTAL WARGA</h6>
                    <p class="fs-4 fw-bold mb-0">{{ $warga->count() }} Rumah</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-none d-md-block">
            <div class="card-stat">
                <div class="icon-box bg-warning text-dark"><i class="bi bi-star-fill"></i></div>
                <div>
                    <h6 class="text-muted mb-0 small">REWARD SYSTEM</h6>
                    <p class="fs-4 fw-bold mb-0">Active</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="table-box text-center shadow-sm">
                <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-qr-code-scan me-2"></i>Kontrol Scanner</h5>
                
                <button id="btn-start" class="btn btn-primary btn-camera-control shadow-sm">
                    <i class="bi bi-camera-fill me-2"></i>Buka Kamera
                </button>
                <button id="btn-stop" class="btn btn-danger btn-camera-control shadow-sm d-none">
                    <i class="bi bi-camera-video-off-fill me-2"></i>Matikan Kamera
                </button>

                <div id="reader" class="mx-auto mb-3 d-none" style="max-width: 100%;"></div>
                
                <div id="status-msg" class="badge bg-light text-dark border p-3 w-100 rounded-pill shadow-sm">
                    Kamera dalam posisi non-aktif
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="table-box shadow-sm">
                <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-cpu-fill me-2"></i>Monitoring Sampah (AI)</h5>
                <input type="text" id="searchInput" onkeyup="searchTable()" class="search-input" placeholder="Cari nama, blok, atau status kepenuhan...">
                
                <div class="table-responsive">
                    <table class="table align-middle" id="wargaTable">
                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th>Warga</th>
                                <th width="30%">Tingkat Kepenuhan (AI)</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($warga as $item)
                            @php $sudah = $riwayatHariIni->where('user_id', $item->id)->first(); @endphp
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $item->name }}</div>
                                    <div class="small text-muted">Blok {{ $item->blok ?? '-' }} No. {{ $item->no_rumah ?? '-' }}</div>
                                </td>
                                <td>
                                    <span class="ai-label">Estimasi Volume: {{ $item->persentase_kepenuhan }}%</span>
                                    <div class="progress" style="height: 10px; border-radius: 5px;">
                                        @php
                                            $color = 'bg-success';
                                            if($item->persentase_kepenuhan > 50) $color = 'bg-warning';
                                            if($item->persentase_kepenuhan > 80) $color = 'bg-danger';
                                        @endphp
                                        <div class="progress-bar {{ $color }} progress-bar-striped progress-bar-animated" 
                                             role="progressbar" 
                                             style="width: {{ $item->persentase_kepenuhan }}%">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($sudah)
                                        <span class="badge bg-success-subtle text-success badge-custom">Selesai</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning badge-custom">Menunggu</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(!$sudah)
                                        <form action="{{ route('officer.konfirmasi', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn-confirm btn-sm" title="Konfirmasi Manual">
                                                <i class="bi bi-hand-index-thumb"></i>
                                            </button>
                                        </form>
                                    @else
                                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let html5QrCode = new Html5Qrcode("reader");
    const btnStart = document.getElementById('btn-start');
    const btnStop = document.getElementById('btn-stop');
    const readerDiv = document.getElementById('reader');
    const statusMsg = document.getElementById('status-msg');

    const qrConfig = { fps: 20, qrbox: { width: 250, height: 250 } };

    btnStart.addEventListener('click', () => {
        readerDiv.classList.remove('d-none');
        btnStart.classList.add('d-none');
        btnStop.classList.remove('d-none');
        statusMsg.innerHTML = "🔍 Mencari QR Code Warga...";
        html5QrCode.start({ facingMode: "environment" }, qrConfig, onScanSuccess);
    });

    btnStop.addEventListener('click', stopCamera);

    function stopCamera() {
        html5QrCode.stop().then(() => {
            readerDiv.classList.add('d-none');
            btnStop.classList.add('d-none');
            btnStart.classList.remove('d-none');
            statusMsg.innerHTML = "Kamera dalam posisi non-aktif";
        }).catch(err => console.error("Gagal stop kamera", err));
    }

    function onScanSuccess(decodedText) {
        stopCamera();

        Swal.fire({
            title: 'Memproses AI & Poin...',
            text: 'Mencatat pengangkutan warga',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading() }
        });

        // Pastikan endpoint sesuai dengan route officer.scanQR Anda
        fetch("{{ route('officer.scanQR') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ user_id: decodedText })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Terangkut!',
                    html: `Warga: <b>${data.nama_warga}</b><br><span class="text-success fw-bold">+${data.poin_didapat} Green Points Berhasil Dikirim!</span>`,
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message
                });
            }
        })
        .catch(error => {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Masalah koneksi ke server' });
        });
    }

    function searchTable() {
        let input = document.getElementById("searchInput").value.toUpperCase();
        let tr = document.getElementById("wargaTable").getElementsByTagName("tr");
        for (let i = 1; i < tr.length; i++) {
            let txtValue = tr[i].textContent || tr[i].innerText;
            tr[i].style.display = txtValue.toUpperCase().indexOf(input) > -1 ? "" : "none";
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>