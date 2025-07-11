@extends('layouts.app')
@section('title', 'Laporan Neraca')

@section('content')
<div class="container">
      <br>
<h4 class="mb-3">Laporan Neraca</h4>

<form method="GET" class="row mb-4">
    <div class="col-md-3">
        <label class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') ?? date('Y-m-01') }}" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') ?? date('Y-m-t') }}" class="form-control" required>
    </div>
    <div class="col-md-3 align-self-end">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

<table class="table table-bordered table-sm">
    <tr><th>Total Aset</th><td>{{ number_format($aset, 0) }}</td></tr>
    <tr><th>Total Kewajiban</th><td>{{ number_format($kewajiban, 0) }}</td></tr>
    <tr><th>Total Modal</th><td>{{ number_format($modal, 0) }}</td></tr>
    <tr class="table-info">
        <th>Jumlah Kewajiban + Modal</th>
        <td><strong>{{ number_format($kewajiban + $modal, 0) }}</strong></td>
    </tr>
</table>
</div>
@endsection
