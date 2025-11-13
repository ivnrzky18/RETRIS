@extends('layouts.app')
@section('title', 'Daftar Kamar')

@section('content')
<div class="container mt-4">
    {{-- Card Table: Menggunakan bg-dark untuk header agar sesuai tema --}}
    <div class="card shadow-lg border-0 rounded-3">
        
        {{-- Header Card dengan tema gelap --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-3">
            <h4 class="mb-0"><i class="fas fa-bed me-2"></i> Daftar Kamar</h4>
            
            {{-- Tombol 'Tambah' yang mengarah ke form create, menggunakan style btn-info --}}
            <a href="{{ route('kamar.create') }}" class="btn btn-info btn-sm text-white fw-bold">
                <i class="fas fa-plus-circle me-1"></i> Tambah Kamar Baru
            </a>
        </div>

        <div class="card-body p-0">
            <!-- Pesan sukses -->
            @if(session('success'))
                <div class="alert alert-success rounded-0 mb-0">{{ session('success') }}</div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    {{-- Header Tabel menggunakan table-secondary, sesuai contoh Anda --}}
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" style="width: 5%;">No</th>
                            <th scope="col" style="width: 15%;">Nomor Kamar</th>
                            <th scope="col" style="width: 15%;">Tipe Kamar</th>
                            <th scope="col" style="width: 15%;">Harga Sewa</th>
                            <th scope="col" style="width: 15%;">Status</th>
                            <th scope="col" style="width: 25%;">Deskripsi</th>
                            <th scope="col" style="width: 10%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kamar as $index => $k)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $k->nomor_kamar }}</td>
                            <td>
                                {{-- LOGIKA PERUBAHAN TIPE KAMAR: Jika 'lengkap', gunakan bg-warning (orange) --}}
                                <span class="badge {{ 
                                    $k->tipe_kamar == 'ac' ? 'bg-info text-dark' : 
                                    ($k->tipe_kamar == 'lengkap' ? 'bg-warning text-dark' : 'bg-secondary') 
                                }} py-2 px-3 rounded-pill">
                                    {{ strtoupper($k->tipe_kamar) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                            <td>
                                {{-- Menampilkan Status dengan badge (tidak diubah) --}}
                                <span class="badge {{ 
                                    $k->status == 'Tersedia' ? 'bg-success' : 
                                    ($k->status == 'Terisi' ? 'bg-danger' : 'bg-warning text-dark') 
                                }} py-2 px-3 rounded-pill">
                                    {{ $k->status }}
                                </span>
                            </td>
                            <td>{{ Str::limit($k->deskripsi, 50) }}</td>
                            <td class="text-center">
                                {{-- Tombol Edit menggunakan outline-warning, sesuai contoh Anda --}}
                                <a href="{{ route('kamar.edit', $k->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Ubah Data">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                
                                {{-- Tombol Hapus menggunakan outline-danger, sesuai contoh Anda --}}
                                <form action="{{ route('kamar.destroy', $k->id) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini? Data tidak dapat dikembalikan!');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Data">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-info-circle me-1"></i> Belum ada data kamar yang terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Footer Card dengan bg-light --}}
        <div class="card-footer text-muted bg-light rounded-bottom-3">
            Total Kamar: {{ $kamar->count() }}
        </div>
    </div>
</div>
@endsection