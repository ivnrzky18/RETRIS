@extends('layouts.app')
@section('title', 'Buku Besar')

@section('content')
<div class="container">
<br>
<h4 class="mb-3">Buku Besar</h4>

<form method="GET" class="row mb-4">
    <div class="col-md-4">
        <label class="form-label">Pilih Akun</label>
        <select name="account_id" class="form-select" required>
            <option value="">-- Pilih Akun --</option>
            @foreach($accounts as $acc)
                <option value="{{ $acc->id }}" {{ request('account_id') == $acc->id ? 'selected' : '' }}>
                    {{ $acc->code }} - {{ $acc->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') ?? date('Y-m-01') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') ?? date('Y-m-t') }}" required>
    </div>
    <div class="col-md-2 align-self-end">
        <button class="btn btn-primary">Tampilkan</button>
    </div>
</form>

@if($selectedAccount)
    <div class="card">
        <div class="card-header bg-info text-white">
            Buku Besar: {{ $selectedAccount->code }} - {{ $selectedAccount->name }}
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode Transaksi</th>
                        <th>Deskripsi</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @php $saldo = 0; @endphp
                    @foreach($ledgerEntries as $entry)
                        @php
                            $debit = $entry->debit;
                            $credit = $entry->credit;
                            $saldo += $selectedAccount->normal_balance === 'Debit' ? $debit - $credit : $credit - $debit;
                        @endphp
                        <tr>
                            <td>{{ $entry->journalEntry->date }}</td>
                            <td>{{ $entry->journalEntry->transaction_code }}</td>
                            <td>{{ $entry->journalEntry->description }}</td>
                            <td>{{ number_format($debit, 0) }}</td>
                            <td>{{ number_format($credit, 0) }}</td>
                            <td>{{ number_format($saldo, 0) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endif
@endsection
