@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Supplier</h2>

    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama Supplier</label>
            <input type="text" name="nama_supplier" class="form-control" value="{{ $supplier->nama_supplier }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ $supplier->alamat }}</textarea>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $supplier->no_hp }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $supplier->email }}">
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection