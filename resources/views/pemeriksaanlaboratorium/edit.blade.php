@extends('layouts.app')

@section('title', 'Edit Pemeriksaan Laboratorium')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Edit Pemeriksaan Laboratorium</h4>

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

    {{-- Pastikan variabel $Pemeriksaanlaboratorium tersedia --}}
    @if(isset($laboratorium))
    <form method="POST" action="{{ route('pemeriksaanlaboratorium.update', $Pemeriksaanlaboratorium->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_pasien" class="form-label">Nama Pasien</label>
            <input type="text" id="nama_pasien" name="nama_pasien"
                   value="{{ old('nama_pasien', $Pemeriksaanlaboratorium->nama_pasien) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jenis_tes" class="form-label">Jenis Tes</label>
            <input type="text" id="jenis_tes" name="jenis_tes"
                   value="{{ old('jenis_tes', $Pemeriksaanlaboratorium->jenis_tes) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hasil" class="form-label">Hasil</label>
            <textarea id="hasil" name="hasil" class="form-control" rows="3" required>{{ old('hasil', $laboratorium->hasil) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_tes" class="form-label">Tanggal Tes</label>
            <input type="date" id="tanggal_tes" name="tanggal_tes"
                   value="{{ old('tanggal_tes', $Pemeriksaanlaboratorium->tanggal_tes) }}"
                   class="form-control" required>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Perbarui</button>
            <a href="{{ route('pemeriksaanlaboratorium.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
    @else
        <div class="alert alert-warning text-center">
            Data pemeriksaan laboratorium tidak ditemukan.
        </div>
    @endif
</div>
@endsection
