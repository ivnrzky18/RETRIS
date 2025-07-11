@extends('layouts.app')
@section('title', 'Tambah Periode Akuntansi')

@section('content')
<h4 class="mb-4">Tambah Periode Akuntansi</h4>

<form method="POST" action="{{ route('periode-akuntansi.store') }}">
    @csrf

    <div class="mb-3">
        <label for="nama_periode" class="form-label">Nama Periode</label>
        <input type="text" name="nama_periode" class="form-control" required placeholder="Contoh: Januari 2025">
    </div>

    <div class="mb-3">
        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('periode-akuntansi.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
