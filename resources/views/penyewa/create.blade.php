@extends('layouts.app')

@section('title', 'Tambah Data Penyewa Baru')

@section('content')
<div class="container mt-4">
    {{-- Card Form: Menggunakan bg-dark untuk header agar sesuai tema --}}
    <div class="card shadow-lg border-0 rounded-3">
        {{-- Header Card dengan tema gelap --}}
        <div class="card-header bg-dark text-white rounded-top-3">
            <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i> Tambah Data Penyewa Baru</h4>
        </div>
        
        <div class="card-body">
            {{-- Form POST ke route penyewa.store --}}
            <form method="POST" action="{{ route('penyewa.store') }}">
                @csrf
                
                {{-- Nama Penyewa --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama') }}" required placeholder="Masukkan nama lengkap penyewa">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Kelamin (Dropdown) --}}
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pekerjaan (Dropdown Sesuai Permintaan) --}}
                <div class="mb-3">
                    <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                    <select name="pekerjaan" class="form-select @error('pekerjaan') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih Pekerjaan</option>
                        {{-- Opsi Bekerja --}}
                        <option value="Bekerja" {{ old('pekerjaan') == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                        {{-- Opsi Mahasiswa/i --}}
                        <option value="Mahasiswa/i" {{ old('pekerjaan') == 'Mahasiswa/i' ? 'selected' : '' }}>Mahasiswa/i</option>
                    </select>
                    @error('pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- No HP --}}
                <div class="mb-3">
                    <label for="no_hp" class="form-label fw-bold">No. HP / Telepon</label>
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                           value="{{ old('no_hp') }}" required placeholder="Contoh: 081234567890">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold">Alamat Asal</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" 
                              required placeholder="Masukkan alamat asal/domisili">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end pt-2">
                    {{-- Tombol Simpan menggunakan warna info (biru) --}}
                    <button type="submit" class="btn btn-info text-white fw-bold me-2">
                        <i class="bi bi-save me-1"></i> Simpan Data Penyewa
                    </button>
                    {{-- Tombol Batal kembali ke route penyewa.index --}}
                    <a href="{{ route('penyewa.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection