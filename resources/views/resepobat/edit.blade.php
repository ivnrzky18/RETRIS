@extends('layouts.app')

@section('title', 'Edit Resep Obat')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Edit Resep Obat</h4>

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

    {{-- Pastikan variabel $resep tersedia --}}
    @if(isset($resep))
    <form method="POST" action="{{ route('resepobat.update', $resep->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_pasien" class="form-label">Nama Pasien</label>
            <input type="text" id="nama_pasien" name="nama_pasien"
                   value="{{ old('nama_pasien', $resep->nama_pasien) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nama_obat" class="form-label">Nama Obat</label>
            <input type="text" id="nama_obat" name="nama_obat"
                   value="{{ old('nama_obat', $resep->nama_obat) }}"
                   class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="dosis" class="form-label">Dosis</label>
                <input type="text" id="dosis" name="dosis"
                       value="{{ old('dosis', $resep->dosis) }}"
                       class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah"
                       value="{{ old('jumlah', $resep->jumlah) }}"
                       class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="aturan_pakai" class="form-label">Aturan Pakai</label>
            <textarea id="aturan_pakai" name="aturan_pakai" class="form-control" rows="3" required>{{ old('aturan_pakai', $resep->aturan_pakai) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal_resep" class="form-label">Tanggal Resep</label>
            <input type="date" id="tanggal_resep" name="tanggal_resep"
                   value="{{ old('tanggal_resep', $resep->tanggal_resep) }}"
                   class="form-control" required>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Perbarui</button>
            <a href="{{ route('resepobat.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
    @else
        <div class="alert alert-warning text-center">
            Data resep obat tidak ditemukan.
        </div>
    @endif
</div>
@endsection
