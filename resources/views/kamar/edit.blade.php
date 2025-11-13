@extends('layouts.app')
@section('title', 'Edit Kamar')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Data Kamar</h4>

    {{-- Pastikan variabel $kamar tersedia dan berisi data kamar yang akan diedit --}}
    <form method="POST" action="{{ route('kamar.update', $kamar->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
            {{-- Menggunakan old() untuk retain input jika validasi gagal, atau nilai dari database --}}
            <input type="text" name="nomor_kamar" 
                   value="{{ old('nomor_kamar', $kamar->nomor_kamar) }}" 
                   class="form-control @error('nomor_kamar') is-invalid @enderror" required 
                   placeholder="Contoh: 101 atau VIP-A">
            @error('nomor_kamar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="tipe_kamar" class="form-label">Tipe Kamar</label>
            <select name="tipe_kamar" class="form-select @error('tipe_kamar') is-invalid @enderror" required>
                <option value="">-- Pilih Tipe Kamar --</option>
                {{-- Opsi AC --}}
                <option value="ac" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'ac' ? 'selected' : '' }}>
                    AC (Air Conditioner)
                </option>
                {{-- Opsi Non AC --}}
                <option value="non ac" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'non ac' ? 'selected' : '' }}>
                    Non AC
                </option>
                {{-- Opsi Lengkap --}}
                <option value="lengkap" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'lengkap' ? 'selected' : '' }}>
                    Lengkap (AC & Fasilitas Premium)
                </option>
            </select>
            @error('tipe_kamar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga Sewa (Per Bulan)</label>
            <input type="number" name="harga" 
                   value="{{ old('harga', $kamar->harga) }}" 
                   class="form-control @error('harga') is-invalid @enderror" required 
                   placeholder="Masukkan harga sewa (contoh: 800000)">
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status Kamar</label>
            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                <option value="">-- Pilih Status --</option>
                {{-- Opsi Tersedia --}}
                <option value="Tersedia" {{ old('status', $kamar->status) == 'Tersedia' ? 'selected' : '' }}>
                    Tersedia
                </option>
                {{-- Opsi Terisi --}}
                <option value="Terisi" {{ old('status', $kamar->status) == 'Terisi' ? 'selected' : '' }}>
                    Terisi
                </option>
                {{-- Opsi Dalam Perbaikan --}}
                <option value="Dalam Perbaikan" {{ old('status', $kamar->status) == 'Dalam Perbaikan' ? 'selected' : '' }}>
                    Dalam Perbaikan
                </option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi / Fasilitas</label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" 
                      placeholder="Contoh: Kamar mandi dalam, termasuk listrik, WiFi 24 jam.">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui Data Kamar</button>
        <a href="{{ route('kamar.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection