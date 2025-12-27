<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Wilayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-4">Manajemen Wilayah / Blok</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.wilayah.store') }}" method="POST">
                @csrf
                <div class="row g-2">
                    <div class="col-md-4">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Blok (A/B/C)" required>
                    </div>
                    <div class="col-md-4">
                        <select name="petugas_id" class="form-control" required>
                            <option value="">-- Pilih Petugas --</option>
                            @foreach($petugas as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-grid">
                        <button class="btn btn-success">Tambah Wilayah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Blok</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wilayahs as $w)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $w->nama }}</td>
                            <td>{{ $w->petugas->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data wilayah</td>
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
