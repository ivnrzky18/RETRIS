@extends('layouts.app')

@section('title', 'Tambah Pemeriksaan Dokter')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Tambah Pemeriksaan Dokter</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pemeriksaandokter.store') }}">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nama Pasien</label>
                <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Umur</label>
                <input type="number" name="umur" value="{{ old('umur') }}" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal_periksa" value="{{ old('tanggal_periksa') }}" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Keluhan</label>
            <textarea name="keluhan" class="form-control" rows="3" required>{{ old('keluhan') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Diagnosa</label>
            <textarea name="diagnosa" class="form-control" rows="3" required>{{ old('diagnosa') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tindakan</label>
            <textarea name="tindakan" class="form-control" rows="3">{{ old('tindakan') }}</textarea>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Simpan</button>
            <a href="{{ route('pemeriksaandokter.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
