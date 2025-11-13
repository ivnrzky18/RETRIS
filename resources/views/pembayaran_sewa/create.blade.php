@extends('layouts.app')

@section('title', 'Tambah Pembayaran Sewa Baru')

@section('content')
<div class="container mt-4">
    {{-- Card Form: Menggunakan bg-dark untuk header agar sesuai tema Kos Manager Pro --}}
    <div class="card shadow-lg border-0 rounded-3" style="max-width: 600px; margin: 0 auto;">
        {{-- Header Card dengan tema gelap --}}
        <div class="card-header bg-dark text-white rounded-top-3">
            <h4 class="mb-0"><i class="fas fa-money-check-alt me-2"></i> Tambah Pembayaran Sewa</h4>
        </div>

        <div class="card-body">
            {{-- Menampilkan error validasi jika ada --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form POST ke route pembayaran.store (akan memanggil PembayaranSewaController::store) --}}
            <form method="POST" action="{{ route('pembayaran_sewa.store') }}">
                @csrf

                {{-- Field: Nama Penyewa (menggantikan Nama Pasien) --}}
                <div class="mb-3">
                    <label for="nama_penyewa" class="form-label fw-bold">Nama Penyewa</label>
                    {{-- Ganti nama_pasien menjadi nama_penyewa --}}
                    <input type="text" name="nama_penyewa" value="{{ old('nama_penyewa') }}" 
                           class="form-control @error('nama_penyewa') is-invalid @enderror" 
                           required placeholder="Masukkan nama penyewa">
                    @error('nama_penyewa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Field: Jumlah Pembayaran --}}
                <div class="mb-3">
                    <label for="jumlah" class="form-label fw-bold">Jumlah Pembayaran (Rp)</label>
                    <input type="number" step="1000" name="jumlah" value="{{ old('jumlah') }}" 
                           class="form-control @error('jumlah') is-invalid @enderror" 
                           required placeholder="Contoh: 1500000">
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Field: Metode Pembayaran --}}
                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label fw-bold">Metode Pembayaran</label>
                    <select name="metode_pembayaran" 
                            class="form-select @error('metode_pembayaran') is-invalid @enderror" 
                            required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash (Tunai)</option>
                        <option value="Transfer" {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet (Dana, GoPay, dll.)</option>
                    </select>
                    @error('metode_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Field: Tanggal Pembayaran --}}
                <div class="mb-3">
                    <label for="tanggal_pembayaran" class="form-label fw-bold">Tanggal Pembayaran</label>
                    <input type="date" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', date('Y-m-d')) }}" 
                           class="form-control @error('tanggal_pembayaran') is-invalid @enderror" 
                           required>
                    @error('tanggal_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end pt-3">
                    <button type="submit" class="btn btn-info text-white fw-bold me-2">
                        <i class="fas fa-save me-1"></i> Simpan Pembayaran
                    </button>
                    <a href="{{ route('pembayaran_sewa.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times-circle me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection