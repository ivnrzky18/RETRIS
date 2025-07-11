@extends('layouts.app')
@section('title', 'Kas & Bank')
@section('content')
<div class="container">
<br>
<h4 class="mb-3">Transaksi Kas & Bank</h4>

<form method="POST" action="{{ route('cashbank.store') }}" class="row mb-4">
    @csrf
    <div class="col-md-2">
        <select name="tipe_transaksi" class="form-select" required>
            <option value="Masuk">Masuk</option>
            <option value="Keluar">Keluar</option>
        </select>
    </div>
    <div class="col-md-2">
        <select name="sumber" class="form-select" required>
            <option value="Kas">Kas</option>
            <option value="Bank">Bank</option>
        </select>
    </div>
    <div class="col-md-2">
        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') ?? date('Y-m-01') }}" required>
    </div>
    <div class="col-md-3">
        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
    </div>
    <div class="col-md-2">
        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
    </div>
    <div class="col-md-3 mt-2">
        <select name="account_id" class="form-select" required>
            <option value="">-- Lawan Akun --</option>
            @foreach($accounts as $a)
                <option value="{{ $a->id }}">{{ $a->code }} - {{ $a->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 mt-2">
        <button class="btn btn-success">Simpan</button>
    </div>
</form>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Sumber</th>
            <th>Jumlah</th>
            <th>Deskripsi</th>
            <th>Lawan Akun</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{ $d->tanggal }}</td>
            <td>{{ $d->tipe_transaksi }}</td>
            <td>{{ $d->sumber }}</td>
            <td>{{ number_format($d->jumlah, 0) }}</td>
            <td>{{ $d->deskripsi }}</td>
            <td>{{ $d->account->code }} - {{ $d->account->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
