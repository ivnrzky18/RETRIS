@extends('layouts.app')

@section('title', 'Daftar Pembayaran Sewa')

@section('content')
<div class="container mt-4">
    {{-- Card Table: Menggunakan bg-dark untuk header agar sesuai tema --}}
    <div class="card shadow-lg border-0 rounded-3">
        {{-- Header Card dengan tema gelap --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-3">
            <h4 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i> Daftar Pembayaran Sewa</h4>
            
            {{-- Tombol 'Tambah' yang mengarah ke form create terpisah --}}
            <a href="{{ route('pembayaran_sewa.create') }}" class="btn btn-info btn-sm text-white fw-bold">
                <i class="fas fa-plus-circle me-1"></i> Tambah Pembayaran Baru
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" style="width: 5%;">No</th>
                            {{-- Mengubah Pasien menjadi Penyewa --}}
                            <th scope="col" style="width: 25%;">Nama Penyewa</th>
                            <th scope="col" style="width: 15%;">Jumlah</th>
                            <th scope="col" style="width: 20%;">Metode Pembayaran</th>
                            <th scope="col" style="width: 20%;">Tanggal Pembayaran</th>
                            <th scope="col" style="width: 15%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Looping Data Pembayaran --}}
                        @forelse($pembayaran as $index => $p)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                {{-- Menggunakan nama_penyewa (sesuai Model dan Controller) --}}
                                <td>{{ $p->nama_penyewa }}</td> 
                                <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                                <td><span class="badge bg-primary py-2 px-3 rounded-pill">{{ $p->metode_pembayaran }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($p->tanggal_pembayaran)->isoFormat('D MMMM YYYY') }}</td>
                                <td class="text-center">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('pembayaran_sewa.edit', $p->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Ubah Data">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    
                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('pembayaran_sewa.destroy', $p->id) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pembayaran ini? Data tidak dapat dikembalikan!');">
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
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-info-circle me-1"></i> Belum ada data pembayaran sewa yang tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted bg-light rounded-bottom-3">
            Total Transaksi: {{ $pembayaran->count() }}
        </div>
    </div>
</div>
@endsection