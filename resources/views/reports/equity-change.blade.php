@extends('layouts.app')
@section('title', 'Perubahan Modal')

@section('content')
<div class="container">
      <br>
<h4 class="mb-3">Laporan Perubahan Modal</h4>

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

<table class="table table-bordered">
    <tr><th>Modal Awal</th><td>{{ number_format($modalAwal, 0) }}</td></tr>
    <tr><th>+ Laba Bersih</th><td>{{ number_format($labaBersih, 0) }}</td></tr>
    <tr><th>- Prive</th><td>{{ number_format($prive, 0) }}</td></tr>
    <tr class="table-info"><th>Modal Akhir</th><td><strong>{{ number_format($modalAkhir, 0) }}</strong></td></tr>
</table>
</div>
@endsection
