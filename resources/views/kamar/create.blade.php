@extends('layouts.app')
@section('title', 'Tambah Kamar')

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Kamar Baru</h4>

    <form method="POST" action="{{ route('kamar.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
            <input type="text" name="nomor_kamar" class="form-control @error('nomor_kamar') is-invalid @enderror" 
                   value="{{ old('nomor_kamar') }}" required placeholder="Contoh: 101 atau VIP-A">
            @error('nomor_kamar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
            <select name="tipe_kamar" class="form-select @error('tipe_kamar') is-invalid @enderror" required>
                <option value="">-- Pilih Tipe Kamar --</option>
                <option value="ac" {{ old('tipe_kamar') == 'ac' ? 'selected' : '' }}>AC (Air Conditioner)</option>
                <option value="non ac" {{ old('tipe_kamar') == 'non ac' ? 'selected' : '' }}>Non AC</option>
                <option value="lengkap" {{ old('tipe_kamar') == 'lengkap' ? 'selected' : '' }}>Lengkap (AC & Fasilitas Premium)</option>
            </select>
            @error('tipe_kamar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga Sewa (Per Bulan)</label>
            <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" 
                   value="{{ old('harga') }}" required placeholder="Masukkan harga sewa (contoh: 800000)">
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Kamar</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="">-- Pilih Status --</option>
                <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Terisi" {{ old('status') == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                <option value="Dalam Perbaikan" {{ old('status') == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi / Fasilitas</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Contoh: Kamar mandi dalam, termasuk listrik, WiFi 24 jam.">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan Data Kamar</button>
        <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection