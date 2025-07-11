@extends('layouts.app')

@section('title', 'Daftar Jurnal')

@section('content')
<div class="container">
<br>
<h4 class="mb-3">Daftar Transaksi Jurnal</h4>

<!-- Tombol Tambah -->
<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
    + Tambah Transaksi
</button>

<!-- Tabel -->
<table class="table table-bordered table-sm">
    <thead class="table-light">
        <tr>
            <th>Tanggal</th>
            <th>Kode</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($journals as $j)
        <tr>
            <td>{{ date('d-M-Y', strtotime($j->date)) }}</td>
            <td>{{ $j->transaction_code }}</td>
            <td>{{ $j->description }}</td>
            <td>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalLihat{{ $j->id }}">
                    <i class="fas fa-eye"></i> Lihat
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Transaksi Jurnal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        @include('journals.add')
      </div>
    </div>
  </div>
</div>

<!-- Modal Lihat Detail -->
@foreach($journals as $journal)
<div class="modal fade" id="modalLihat{{ $journal->id }}" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Transaksi: {{ $journal->transaction_code }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Tanggal:</strong> {{ $journal->date }}</p>
        <p><strong>Deskripsi:</strong> {{ $journal->description }}</p>

        <table class="table table-bordered">
            <thead><tr><th>Kode Akun</th><th>Nama Akun</th><th>Debit</th><th>Kredit</th></tr></thead>
            <tbody>
                @foreach($journal->details as $detail)
                <tr>
                    <td>{{ $detail->account->code }}</td>
                    <td>{{ $detail->account->name }}</td>
                    <td>{{ number_format($detail->debit, 2) }}</td>
                    <td>{{ number_format($detail->credit, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endforeach
@endsection
