@extends('layouts.app')

@section('title', 'Tambah Pemeriksaan Laboratorium')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Tambah Pemeriksaan Laboratorium</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pemeriksaanlaboratorium.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Tes</label>
            <input type="text" name="jenis_tes" value="{{ old('jenis_tes') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Hasil</label>
            <textarea name="hasil" class="form-control" rows="3" required>{{ old('hasil') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tanggal Tes</label>
            <input type="date" name="tanggal_tes" value="{{ old('tanggal_tes') }}" class="form-control" required>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Simpan</button>
            <a href="{{ route('pemeriksaanlaboratorium.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
