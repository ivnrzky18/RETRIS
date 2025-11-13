@extends('layouts.app')
@section('title', 'Daftar Resep Obat')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Daftar Resep Obat</h4>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
        + Tambah Resep Obat
    </button>

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('resepobat.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Resep Obat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Dosis</label>
                                <input type="text" name="dosis" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Aturan Pakai</label>
                            <textarea name="aturan_pakai" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Resep</label>
                            <input type="date" name="tanggal_resep" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Data Resep Obat -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Nama Obat</th>
                <th>Dosis</th>
                <th>Jumlah</th>
                <th>Aturan Pakai</th>
                <th>Tanggal Resep</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($resepobat as $index => $r)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $r->nama_pasien }}</td>
                    <td>{{ $r->nama_obat }}</td>
                    <td>{{ $r->dosis }}</td>
                    <td>{{ $r->jumlah }}</td>
                    <td>{{ $r->aturan_pakai }}</td>
                    <td>{{ $r->tanggal_resep }}</td>
                    <td>
                        <a href="{{ route('resepobat.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('resepobat.destroy', $r->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data resep obat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
