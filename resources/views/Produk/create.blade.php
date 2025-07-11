@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container">
    <br>
    <h4>Tambah Produk</h4>
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi"></textarea>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" value="0" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection