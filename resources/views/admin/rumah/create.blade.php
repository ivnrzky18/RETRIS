<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Warga Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0">Form Tambah Warga Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.rumah.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan nama warga" required>
                            <small class="text-muted">Nama ini akan muncul di daftar warga.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="contoh@warga.com" required>
                            <small class="text-muted">Gunakan email aktif untuk login warga.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                            <small class="text-muted">Berikan password sementara untuk warga.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kategori Bangunan</label>
                            <select name="kategori" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <option value="rumah">Rumah (Rp 20.000)</option>
                                <option value="toko">Toko (Rp 35.000)</option>
                                <option value="ruko">Ruko (Rp 50.000)</option>
                            </select>
                            <small class="text-muted">Kategori menentukan besaran iuran bulanan warga.</small>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.rumah.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Data Warga</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="mt-3 text-center">
                <p class="text-muted small">Data yang ditambahkan otomatis memiliki role sebagai <strong>Warga</strong>.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>