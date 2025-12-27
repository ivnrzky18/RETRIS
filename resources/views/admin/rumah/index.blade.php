<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-4">Daftar Warga Terdaftar</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.rumah.create') }}" class="btn btn-primary mb-3">
        + Tambah Warga Baru
    </a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Warga</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Terdaftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rumahs as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->email }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ ucfirst($r->role) }}</span>
                            </td>
                            <td>{{ $r->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data warga terdaftar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>