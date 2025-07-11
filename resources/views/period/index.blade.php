@extends('layouts.app')
@section('title', 'Periode Akuntansi')
@section('content')
<div class="container">
    <br>
<h4 class="mb-3">Daftar Periode Akuntansi</h4>

<!-- Tombol -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCreate">
    + Tambah Periode
</button>

<!-- Modal Create -->
<div class="modal fade" id="modalCreate" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('periode-akuntansi.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Periode Akuntansi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Nama Periode</label>
                <input type="text" name="nama_periode" class="form-control" placeholder="Contoh: Januari 2025" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Awal</label>
                <input type="date" name="tanggal_awal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>


<table class="table table-bordered table-sm">
    <thead>
        <tr>
            <th>Nama Periode</th>
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $p)
        <tr>
            <td>{{ $p->nama_periode }}</td>
            <td>{{ $p->tanggal_awal }}</td>
            <td>{{ $p->tanggal_akhir }}</td>
            <td>{{ $p->status }}</td>
            <td>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $p->id }}">Edit</button>

                <form action="{{ route('periode-akuntansi.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus periode ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        <!-- Modal Edit -->
        <div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <form method="POST" action="{{ route('periode-akuntansi.update', $p->id) }}">
                @csrf @method('PUT')
                <div class="modal-header">
                <h5 class="modal-title">Edit Periode: {{ $p->nama_periode }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Periode</label>
                        <input type="text" name="nama_periode" value="{{ $p->nama_periode }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" value="{{ $p->tanggal_awal }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" value="{{ $p->tanggal_akhir }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option value="Dibuka" {{ $p->status == 'Dibuka' ? 'selected' : '' }}>Dibuka</option>
                            <option value="Ditutup" {{ $p->status == 'Ditutup' ? 'selected' : '' }}>Ditutup</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-success">Perbarui</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        @endforeach
    </tbody>
</table>
@endsection
