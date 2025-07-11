@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Supplier</h2>
    <a href="{{ route('supplier.create') }}" class="btn btn-primary mb-3">+ Tambah Supplier</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $s)
            <tr>
                <td>{{ $s->nama_supplier }}</td>
                <td>{{ $s->alamat }}</td>
                <td>{{ $s->no_hp }}</td>
                <td>{{ $s->email }}</td>
                <td>
                    <a href="{{ route('supplier.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('supplier.destroy', $s->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus supplier ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection