@extends('layouts.app')
@section('title', 'Edit Periode Akuntansi')

@section('content')
<h4 class="mb-4">Edit Periode Akuntansi</h4>

<form method="POST" action="{{ route('periode-akuntansi.update', $periode->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nama_periode" class="form-label">Nama Periode</label>
        <input type="text" name="nama_periode" value="{{ $periode->nama_periode }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" value="{{ $periode->tanggal_awal }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" value="{{ $periode->tanggal_akhir }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="Dibuka" {{ $periode->status === 'Dibuka' ? 'selected' : '' }}>Dibuka</option>
            <option value="Ditutup" {{ $periode->status === 'Ditutup' ? 'selected' : '' }}>Ditutup</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Perbarui</button>
    <a href="{{ route('periode-akuntansi.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
