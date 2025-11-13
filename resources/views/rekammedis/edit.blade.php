@extends('layouts.app')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 text-center">Edit Rekam Medis</h4>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pesan error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Pastikan variabel $rekamMedis tersedia --}}
    @if(isset($rekamMedis))
    <form method="POST" action="{{ route('rekammedis.update', $rekamMedis->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_pasien" class="form-label">Nama Pasien</label>
            <input type="text" id="nama_pasien" name="nama_pasien"
                   value="{{ old('nama_pasien', $rekamMedis->nama_pasien) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="diagnosa" class="form-label">Diagnosa</label>
            <input type="text" id="diagnosa" name="diagnosa"
                   value="{{ old('diagnosa', $rekamMedis->diagnosa) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tindakan" class="form-label">Tindakan</label>
            <input type="text" id="tindakan" name="tindakan"
                   value="{{ old('tindakan', $rekamMedis->tindakan) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_rekam" class="form-label">Tanggal Rekam</label>
            <input type="date" id="tanggal_rekam" name="tanggal_rekam"
                   value="{{ old('tanggal_rekam', $rekamMedis->tanggal_rekam) }}"
                   class="form-control" required>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Perbarui</button>
            <a href="{{ route('rekammedis.index') }}" class="btn btn-secondary px-4">Batal</a>
        </div>
    </form>
    @else
        <div class="alert alert-warning text-center">
            Data rekam medis tidak ditemukan.
        </div>
    @endif
</div>
@endsection
