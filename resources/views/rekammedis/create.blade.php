@extends('layouts.app')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Tambah Rekam Medis</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('rekammedis.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Diagnosa</label>
            <input type="text" name="diagnosa" value="{{ old('diagnosa') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tindakan</label>
            <input type="text" name="tindakan" value="{{ old('tindakan') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal Rekam</label>
            <input type="date" name="tanggal_rekam" value="{{ old('tanggal_rekam') }}" class="form-control" required>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Simpan</button>
            <a href="{{ route('rekammedis.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
