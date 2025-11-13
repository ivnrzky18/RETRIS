@extends('layouts.app')

@section('title', 'Edit Pemeriksaan Dokter')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Edit Pemeriksaan Dokter</h4>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pesan error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Pastikan variabel $pemeriksaan tersedia --}}
    @if(isset($pemeriksaan))
    <form method="POST" action="{{ route('pemeriksaandokter.update', $pemeriksaan->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_pasien" class="form-label">Nama Pasien</label>
                <input type="text" id="nama_pasien" name="nama_pasien"
                       value="{{ old('nama_pasien', $pemeriksaan->nama_pasien) }}"
                       class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" id="umur" name="umur"
                       value="{{ old('umur', $pemeriksaan->umur) }}"
                       class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $pemeriksaan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $pemeriksaan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="tanggal_periksa" class="form-label">Tanggal Pemeriksaan</label>
                <input type="date" id="tanggal_periksa" name="tanggal_periksa"
                       value="{{ old('tanggal_periksa', $pemeriksaan->tanggal_periksa) }}"
                       class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan Pasien</label>
            <textarea id="keluhan" name="keluhan" class="form-control" rows="3" required>{{ old('keluhan', $pemeriksaan->keluhan) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="diagnosa" class="form-label">Diagnosa Dokter</label>
            <textarea id="diagnosa" name="diagnosa" class="form-control" rows="3" required>{{ old('diagnosa', $pemeriksaan->diagnosa) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tindakan" class="form-label">Tindakan (Opsional)</label>
            <textarea id="tindakan" name="tindakan" class="form-control" rows="3">{{ old('tindakan', $pemeriksaan->tindakan) }}</textarea>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Perbarui</button>
            <a href="{{ route('pemeriksaandokter.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
    @else
        <div class="alert alert-warning text-center">
            Data pemeriksaan tidak ditemukan.
        </div>
    @endif
</div>
@endsection
