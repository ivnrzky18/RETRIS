@extends('layouts.app')
@section('title', 'Daftar Poli')

@section('content')
<div class="container">
    <br>
    <h4 class="mb-3">Daftar Poli</h4>

    <!-- Tombol Tambah -->
    <a href="{{ route('poli.create') }}" class="btn btn-primary mb-3">+ Tambah Poli</a>

    <!-- Pesan sukses -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Data Poli -->
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Kode Poli</th>
                <th>Nama Poli</th>
                <th>Keterangan</th>
                <th>Dokter Penanggung Jawab</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($poli as $key => $p)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $p->kode_poli }}</td>
                <td>{{ $p->nama_poli }}</td>
                <td>{{ $p->keterangan }}</td>
                <td>{{ $p->dokter_penanggung_jawab }}</td>

                <td>
                    <a href="{{ route('poli.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('poli.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus poli ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada data poli</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
