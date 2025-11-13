@extends('layouts.app')
@section('title', 'Daftar Rekam Medis')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Daftar Rekam Medis</h4>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
        + Tambah Rekam Medis
    </button>

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('rekammedis.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Rekam Medis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Diagnosa</label>
                            <input type="text" name="diagnosa" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tindakan</label>
                            <input type="text" name="tindakan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Rekam</label>
                            <input type="date" name="tanggal_rekam" class="form-control" required>
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

    <!-- Tabel Data Rekam Medis -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Diagnosa</th>
                <th>Tindakan</th>
                <th>Tanggal Rekam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekamMedis as $index => $r)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $r->nama_pasien }}</td>
                    <td>{{ $r->diagnosa }}</td>
                    <td>{{ $r->tindakan }}</td>
                    <td>{{ $r->tanggal_rekam }}</td>
                    <td>
                        <a href="{{ route('rekammedis.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('rekammedis.destroy', $r->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data rekam medis.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
