@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Supplier</h2>

    <form action="{{ route('supplier.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection