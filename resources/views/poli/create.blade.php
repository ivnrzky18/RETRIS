@extends('layouts.app')

@section('title', 'Tambah Poli')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Tambah Poli</h4>

    {{-- Pesan validasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('poli.store') }}">
        @csrf

        <div class="mb-3">
            <label for="kode_poli" class="form-label">Kode Poli</label>
            <input type="text" name="kode_poli" id="kode_poli" class="form-control" 
                value="{{ old('kode_poli') }}" placeholder="Masukkan kode poli" required>
        </div>

        <div class="mb-3">
            <label for="nama_poli" class="form-label">Nama Poli</label>
            <input type="text" name="nama_poli" id="nama_poli" class="form-control" 
                value="{{ old('nama_poli') }}" placeholder="Masukkan nama poli" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3" 
                placeholder="Masukkan keterangan poli (opsional)">{{ old('keterangan') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="dokter_penanggung_jawab" class="form-label">Dokter Penanggung Jawab</label>
            <input type="text" name="dokter_penanggung_jawab" id="dokter_penanggung_jawab" 
                class="form-control" value="{{ old('dokter_penanggung_jawab') }}" 
                placeholder="Masukkan nama dokter" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('poli.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
