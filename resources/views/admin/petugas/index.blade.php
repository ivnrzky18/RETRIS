<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Petugas - RETRIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="bi bi-people-fill me-2 text-success"></i>Daftar Petugas Lapangan</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="py-3">Nama Petugas</th>
                        <th class="py-3">Email</th>
                        <th class="py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($petugas as $p)
                    <tr>
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="py-3 fw-bold">{{ $p->name }}</td>
                        <td class="py-3 text-muted">{{ $p->email }}</td>
                        <td class="py-3 text-center">
                            <span class="badge bg-success">Aktif</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            Belum ada data petugas terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-4 p-3 bg-white rounded shadow-sm">
        <p class="mb-0 small text-muted">
            <strong>Info:</strong> Petugas di atas adalah akun yang memiliki akses untuk mengonfirmasi pengangkutan sampah di lapangan.
        </p>
    </div>
</div>

</body>
</html>