@extends('layouts.app')
@section('title', 'Daftar Pendaftaran Pasien')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Daftar Pendaftaran Pasien</h4>

    <!-- Tombol Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
        + Tambah Pendaftaran Pasien
    </button>

    <!-- Modal Create -->
    <div class="modal fade" id="modalCreate" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('pendaftaranpasien.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pendaftaran Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Umur</label>
                            <input type="number" name="umur" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Poli Tujuan</label>
                            <input type="text" name="poli_tujuan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Dokter Tujuan</label>
                            <input type="text" name="dokter_tujuan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Daftar</label>
                            <input type="date" name="tanggal_daftar" class="form-control" required>
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

    <!-- Tabel Data Pasien -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Poli Tujuan</th>
                <th>Dokter Tujuan</th>
                <th>Tanggal Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftaranpasien as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->nama_pasien }}</td>
                    <td>{{ $p->umur }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->poli_tujuan }}</td>
                    <td>{{ $p->dokter_tujuan }}</td>
                    <td>{{ $p->tanggal_daftar }}</td>
                    <td>
                        <a href="{{ route('pendaftaranpasien.edit', $p->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <form action="{{ route('pendaftaranpasien.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data pendaftaran pasien.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
