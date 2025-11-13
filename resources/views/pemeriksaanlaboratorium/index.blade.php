@extends('layouts.app')
@section('title', 'Daftar Pemeriksaan Laboratorium')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Daftar Pemeriksaan Laboratorium</h4>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
        + Tambah Pemeriksaan
    </button>

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('pemeriksaanlaboratorium.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pemeriksaan Laboratorium</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Tes</label>
                            <input type="text" name="jenis_tes" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Hasil</label>
                            <textarea name="hasil" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Tes</label>
                            <input type="date" name="tanggal_tes" class="form-control" required>
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

    <!-- Tabel Data PemeriksaanLaboratorium -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Jenis Tes</th>
                <th>Hasil</th>
                <th>Tanggal Tes</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemeriksaanlaboratorium as $index => $l)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $l->nama_pasien }}</td>
                    <td>{{ $l->jenis_tes }}</td>
                    <td>{{ $l->hasil }}</td>
                    <td>{{ $l->tanggal_tes }}</td>
                    <td>
                        <a href="{{ route('pemeriksaanlaboratorium.edit', $l->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pemeriksaanlaboratorium.destroy', $l->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data pemeriksaan laboratorium.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
