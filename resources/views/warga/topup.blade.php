<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Top Up Saldo | RETRIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f4f6f9;
        }

        /* Navbar */
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: 1px;
        }

        /* Card metode */
        .method-card {
            cursor: pointer;
            border: 2px solid #dee2e6;
            border-radius: 14px;
            transition: .3s;
            padding: 25px;
        }
        .method-card:hover {
            border-color: #0d6efd;
        }
        .method-active {
            border-color: #198754;
            background: #e9f7ef;
        }

        /* QR Box */
        .qr-box {
            border: 2px dashed #adb5bd;
            padding: 25px;
            border-radius: 14px;
        }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-dark bg-primary shadow-sm px-4">
    <a class="navbar-brand" href="{{ route('warga.dashboard') }}">
        ♻️ RETRIS
    </a>
</nav>

{{-- CONTENT --}}
<div class="container-fluid my-4">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xl-6">

            <div class="text-center mb-4">
                <h3 class="fw-bold">Isi Saldo</h3>
                <p class="text-muted mb-0">
                    Saldo saat ini:
                    <b class="text-success">
                        Rp {{ number_format(auth()->user()->saldo ?? 0,0,',','.') }}
                    </b>
                </p>
            </div>

            <form id="topupForm" method="POST" action="{{ route('warga.topup.store') }}">
                @csrf

                {{-- NOMINAL --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-body p-4">
                        <label class="form-label fw-semibold fs-5">
                            Nominal Top Up
                        </label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text fw-bold">Rp</span>
                            <input type="number"
                                   class="form-control"
                                   id="nominal"
                                   name="amount"
                                   min="10000"
                                   placeholder="10000"
                                   required>
                        </div>
                    </div>
                </div>

                {{-- METODE --}}
                <div class="card mb-4 shadow-sm">
                    <div class="card-body p-4">
                        <label class="form-label fw-semibold fs-5 mb-3">
                            Metode Pembayaran
                        </label>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="method-card text-center" onclick="selectMethod('qris')">
                                    <i class="fa-solid fa-qrcode fa-3x mb-3"></i>
                                    <h5 class="fw-bold mb-0">QRIS</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="method-card text-center" onclick="selectMethod('bank')">
                                    <i class="fa-solid fa-building-columns fa-3x mb-3"></i>
                                    <h5 class="fw-bold mb-0">Transfer Bank</h5>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="provider" id="provider">
                    </div>
                </div>

                <button type="button"
                        onclick="processTopup()"
                        class="btn btn-success btn-lg w-100 mb-2">
                    Konfirmasi Top Up
                </button>

                <a href="{{ route('warga.dashboard') }}"
                   class="btn btn-outline-secondary w-100">
                    Kembali ke Dashboard
                </a>
            </form>
        </div>
    </div>
</div>

{{-- MODAL QRIS --}}
<div class="modal fade" id="qrisModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Scan QRIS</h5>
            </div>
            <div class="modal-body text-center">
                <div class="qr-box mb-3">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=RETRIS-TOPUP"
                         class="img-fluid">
                </div>
                <p class="fw-semibold mb-2">Gunakan aplikasi:</p>
                <span class="badge bg-success">DANA</span>
                <span class="badge bg-primary">OVO</span>
                <span class="badge bg-danger">GoPay</span>

                <div class="alert alert-warning small mt-3">
                    QR berlaku selama <b>5 menit</b>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success w-100" onclick="submitTopup()">
                    Saya Sudah Bayar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL BANK --}}
<div class="modal fade" id="bankModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Transfer Bank</h5>
            </div>
            <div class="modal-body">
                <label class="fw-semibold mb-1">Pilih Bank</label>
                <select class="form-select mb-3">
                    <option>BCA</option>
                    <option>BRI</option>
                    <option>BNI</option>
                    <option>Mandiri</option>
                    <option>CIMB Niaga</option>
                </select>

                <div class="alert alert-info">
                    Virtual Account:
                    <br>
                    <b>8808 1234 5678 90</b>
                </div>

                <p class="small text-muted mb-0">
                    Transfer sesuai nominal agar otomatis terverifikasi.
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success w-100" onclick="submitTopup()">
                    Saya Sudah Transfer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedMethod = null;

    function selectMethod(method) {
        selectedMethod = method;
        document.getElementById('provider').value = method.toUpperCase();

        document.querySelectorAll('.method-card')
            .forEach(el => el.classList.remove('method-active'));

        event.currentTarget.classList.add('method-active');
    }

    function processTopup() {
        let nominal = document.getElementById('nominal').value;
        if (!nominal || !selectedMethod) {
            Swal.fire('Lengkapi Data', 'Nominal dan metode wajib dipilih', 'warning');
            return;
        }

        if (selectedMethod === 'qris') {
            new bootstrap.Modal(document.getElementById('qrisModal')).show();
        } else {
            new bootstrap.Modal(document.getElementById('bankModal')).show();
        }
    }

    function submitTopup() {
        Swal.fire({
            title: 'Memproses...',
            timer: 1800,
            didOpen: () => Swal.showLoading()
        }).then(() => {
            document.getElementById('topupForm').submit();
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>