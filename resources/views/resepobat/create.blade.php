@extends('layouts.app')

@section('title', 'Tambah Resep Obat')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Tambah Resep Obat</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('resepobat.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="nama_pasien" value="{{ old('nama_pasien') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" value="{{ old('nama_obat') }}" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Dosis</label>
                <input type="text" name="dosis" value="{{ old('dosis') }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Jumlah</label>
                <input type="number" name="jumlah" value="{{ old('jumlah') }}" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Aturan Pakai</label>
            <textarea name="aturan_pakai" class="form-control" rows="3" required>{{ old('aturan_pakai') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Tanggal Resep</label>
            <input type="date" name="tanggal_resep" value="{{ old('tanggal_resep') }}" class="form-control" required>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Simpan</button>
            <a href="{{ route('resepobat.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
</div>
@endsection
