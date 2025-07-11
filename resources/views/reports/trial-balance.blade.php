@extends('layouts.app')
@section('title', 'Neraca Saldo')

@section('content')
<div class="container">
      <br>
<h4 class="mb-3">Laporan Neraca Saldo</h4>

<!-- 🔍 Form Filter Periode -->
<form method="GET" class="row mb-4">
    <div class="col-md-3">
        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') ?? date('Y-m-01') }}" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') ?? date('Y-m-t') }}" class="form-control" required>
    </div>
    <div class="col-md-3 align-self-end">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

<!-- 📊 Tabel Laporan -->
<table class="table table-bordered table-sm">
    <thead class="table-light">
        <tr>
            <th>Kode Akun</th>
            <th>Nama Akun</th>
            <th>Saldo Normal</th>
            <th>Debit</th>
            <th>Kredit</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d['code'] }}</td>
            <td>{{ $d['name'] }}</td>
            <td>{{ $d['normal_balance'] }}</td>
            <td>{{ number_format($d['debit'], 0) }}</td>
            <td>{{ number_format($d['credit'], 0) }}</td>
            <td>{{ number_format($d['saldo'], 0) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
