@extends('layouts.app')

@section('title', 'Daftar Produk')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="container">
    <br>
    <h4>Daftar Produk</h4>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-sm" id="tabel-produk">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Harga</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $index => $produk)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->deskripsi }}</td>
                <td>{{ $produk->stok }}</td>
                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                <td class="text-center">
                    <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tabel-produk').DataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ]
        });
    });
</script>
@endpush