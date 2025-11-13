@extends('layouts.app')

@section('title', 'Edit Pendaftaran Pasien')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Edit Pendaftaran Pasien</h4>

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

    {{-- Pastikan variabel $pendaftaran tersedia --}}
    @if(isset($pendaftaran))
    <form method="POST" action="{{ route('pendaftaranpasien.update', $pendaftaran->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_pasien" class="form-label">Nama Pasien</label>
                <input type="text" id="nama_pasien" name="nama_pasien"
                       value="{{ old('nama_pasien', $pendaftaran->nama_pasien) }}"
                       class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" id="umur" name="umur"
                       value="{{ old('umur', $pendaftaran->umur) }}"
                       class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                <input type="date" id="tanggal_daftar" name="tanggal_daftar"
                       value="{{ old('tanggal_daftar', $pendaftaran->tanggal_daftar) }}"
                       class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="poli_tujuan" class="form-label">Poli Tujuan</label>
                <input type="text" id="poli_tujuan" name="poli_tujuan"
                       value="{{ old('poli_tujuan', $pendaftaran->poli_tujuan) }}"
                       class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="dokter_tujuan" class="form-label">Dokter Tujuan</label>
                <input type="text" id="dokter_tujuan" name="dokter_tujuan"
                       value="{{ old('dokter_tujuan', $pendaftaran->dokter_tujuan) }}"
                       class="form-control" required>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Perbarui</button>
            <a href="{{ route('pendaftaranpasien.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
    @else
        <div class="alert alert-warning text-center">
            Data pasien tidak ditemukan.
        </div>
    @endif
</div>
@endsection
