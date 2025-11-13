@extends('layouts.app')

@section('title', 'Edit Pembayaran Sewa')

@section('content')
<div class="container mt-4">
    {{-- Card Form: Menggunakan shadow, rounded-3, dan max-width untuk tampilan terpusat yang profesional --}}
    <div class="card shadow-lg border-0 rounded-3" style="max-width: 600px; margin: 0 auto;">
        
        {{-- Header Card dengan tema gelap (bg-dark) khas Kos Manager Pro --}}
        <div class="card-header bg-dark text-white rounded-top-3">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Pembayaran Sewa</h4>
        </div>

        <div class="card-body">
            {{-- Menampilkan pesan sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Menampilkan error validasi jika ada --}}
            @if($errors->any() && !session('success'))
                <div class="alert alert-danger">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> Validasi Gagal</h6>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(isset($pembayaran))
            {{-- Form PUT ke route pembayaran.update --}}
            <form method="POST" action="{{ route('pembayaran_sewa.update', $pembayaran->id) }}">
                @csrf
                @method('PUT')

                {{-- Field: Nama Penyewa (Menggunakan field nama_penyewa) --}}
                <div class="mb-3">
                    <label for="nama_penyewa" class="form-label fw-bold">Nama Penyewa</label>
                    <input type="text" id="nama_penyewa" name="nama_penyewa"
                           value="{{ old('nama_penyewa', $pembayaran->nama_penyewa) }}" 
                           class="form-control @error('nama_penyewa') is-invalid @enderror" 
                           required placeholder="Masukkan nama penyewa">
                    @error('nama_penyewa')
                        {{-- Penggunaan $message sudah benar --}}
                        
                    @enderror
                </div>

                {{-- Field: Jumlah Pembayaran --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label fw-bold">Jumlah Pembayaran (Rp)</label>
                    {{-- Menggunakan step="1000" yang sesuai untuk pembayaran sewa kos --}}
                    <input type="number" step="1000" id="jumlah" name="jumlah"
                           value="{{ old('jumlah', $pembayaran->jumlah) }}"
                           class="form-control @error('jumlah') is-invalid @enderror" 
                           required placeholder="Contoh: 1500000">
                    @error('jumlah')
                       
                    @enderror
                </div>

                {{-- Field: Metode Pembayaran --}}
                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label fw-bold">Metode Pembayaran</label>
                    <select id="metode_pembayaran" name="metode_pembayaran" 
                            class="form-select @error('metode_pembayaran') is-invalid @enderror" 
                            required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Cash" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Cash' ? 'selected' : '' }}>Cash (Tunai)</option>
                        <option value="Transfer" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="E-Wallet" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet (Dana, GoPay, dll.)</option>
                    </select>
                    @error('metode_pembayaran')
                        
                    @enderror
                </div>

                {{-- Field: Tanggal Pembayaran --}}
                <div class="mb-3">
                    <label for="tanggal_pembayaran" class="form-label fw-bold">Tanggal Pembayaran</label>
                    <input type="date" id="tanggal_pembayaran" name="tanggal_pembayaran"
                           value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran) }}"
                           class="form-control @error('tanggal_pembayaran') is-invalid @enderror" 
                           required>
                    @error('tanggal_pembayaran')
                        
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end pt-3">
                    <button type="submit" class="btn btn-info text-white fw-bold px-4 me-2 shadow-sm">
                        <i class="fas fa-arrow-up-circle me-1"></i> Perbarui Pembayaran
                    </button>
                    <a href="{{ route('pembayaran_sewa.index') }}" class="btn btn-secondary px-4 shadow-sm">
                        <i class="fas fa-times-circle me-1"></i> Batal
                    </a>
                </div>
            </form>
            @else
                <div class="alert alert-warning text-center">
                    Data pembayaran tidak ditemukan.
                </div>
            @endif
        </div>
        
    </div>
</div>
@endsection