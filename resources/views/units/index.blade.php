@extends('layouts.app')
@section('title', 'Unit / Departemen')

@section('content')
<div class="container">
    <br>
<h4 class="mb-3">Daftar Unit / Departemen</h4>

<button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalCreate">+ Tambah Unit</button>

<table class="table table-bordered">
    <thead><tr><th>Kode</th><th>Nama</th><th>Keterangan</th><th>Aksi</th></tr></thead>
    <tbody>
        @foreach($units as $u)
        <tr>
            <td>{{ $u->kode }}</td>
            <td>{{ $u->nama }}</td>
            <td>{{ $u->keterangan }}</td>
            <td>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $u->id }}">Edit</button>
                <form action="{{ route('units.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>

        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit{{ $u->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('units.update', $u->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5>Edit Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input name="kode" class="form-control mb-2" value="{{ $u->kode }}" required>
                            <input name="nama" class="form-control mb-2" value="{{ $u->nama }}" required>
                            <textarea name="keterangan" class="form-control">{{ $u->keterangan }}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

{{ $units->links() }}

<!-- Modal Tambah -->
<div class="modal fade" id="modalCreate">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('units.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input name="kode" class="form-control mb-2" placeholder="Kode" required>
                    <input name="nama" class="form-control mb-2" placeholder="Nama Unit" required>
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan (Opsional)"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
