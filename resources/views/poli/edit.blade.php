@extends('layouts.app')
@section('title', 'Edit Poli')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Data Poli</h4>

    <form method="POST" action="{{ route('poli.update', $poli->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kode_poli" class="form-label">Kode Poli</label>
            <input type="text" name="kode_poli" value="{{ $poli->kode_poli }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nama_poli" class="form-label">Nama Poli</label>
            <input type="text" name="nama_poli" value="{{ $poli->nama_poli }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3">{{ $poli->keterangan }}</textarea>
        </div>

        <div class="mb-3">
            <label for="dokter_penanggung_jawab" class="form-label">Dokter Penanggung Jawab</label>
            <input type="text" name="dokter_penanggung_jawab" value="{{ $poli->dokter_penanggung_jawab }}" class="form-control">
        </div>


        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('poli.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
