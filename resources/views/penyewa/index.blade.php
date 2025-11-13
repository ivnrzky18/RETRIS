@extends('layouts.app')

@section('title', 'Data Penyewa Kos')

@section('content')
<div class="container mt-4">
    {{-- Card Table: Menerapkan Card dan tema gelap --}}
    <div class="card shadow-lg border-0 rounded-3">
        
        {{-- Header Card dengan tema gelap --}}
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-3">
            <h4 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i> Daftar Data Penyewa</h4>
            {{-- Tombol Tambah diarahkan ke halaman create.blade.php yang sudah dibuat sebelumnya --}}
            <a href="{{ route('penyewa.create') }}" class="btn btn-info btn-sm text-white fw-bold">
                <i class="bi bi-plus-circle me-1"></i> Tambah Data Penyewa
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            {{-- Mengubah Spesialis menjadi Jenis Kelamin --}}
                            <th>Jenis Kelamin</th>
                            {{-- Menambahkan Pekerjaan --}}
                            <th>Pekerjaan</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penyewa as $key => $p) {{-- Mengubah $dokter menjadi $penyewa dan $d menjadi $p --}}
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->jenis_kelamin }}</td>
                            <td>{{ $p->pekerjaan ?? '-' }}</td> {{-- Menampilkan Pekerjaan --}}
                            <td>{{ $p->no_hp }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td class="text-center">
                                {{-- Tombol Edit --}}
                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $p->id }}" title="Ubah Data">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                
                                {{-- Form Hapus --}}
                                <form action="{{ route('penyewa.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penyewa {{ $p->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    {{-- Mengubah rute ke penyewa.update --}}
                                    <form method="POST" action="{{ route('penyewa.update', $p->id) }}">
                                        @csrf @method('PUT')
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title">Edit Penyewa: {{ $p->nama }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Nama Lengkap</label>
                                                <input type="text" name="nama" value="{{ old('nama', $p->nama) }}" class="form-control" required>
                                            </div>
                                            {{-- Mengubah Spesialis menjadi Jenis Kelamin (Dropdown) --}}
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-select" required>
                                                    <option value="Laki-laki" {{ old('jenis_kelamin', $p->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ old('jenis_kelamin', $p->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                            {{-- Menambahkan Pekerjaan --}}
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Pekerjaan</label>
                                                <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $p->pekerjaan) }}" class="form-control" placeholder="Contoh: Mahasiswa / Karyawan Swasta">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">No. HP / Telepon</label>
                                                <input type="text" name="no_hp" value="{{ old('no_hp', $p->no_hp) }}" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Alamat Asal</label>
                                                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $p->alamat) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-info text-white fw-bold">
                                                <i class="bi bi-arrow-up-circle me-1"></i> Perbarui
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <span class="text-muted fst-italic">Belum ada data penyewa yang tercatat.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer text-muted bg-light rounded-bottom-3">
            Total Penyewa: {{ $penyewa->count() ?? 0 }}
        </div>
    </div>
</div>
@endsection