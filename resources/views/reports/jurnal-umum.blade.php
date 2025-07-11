@extends('layouts.app')
@section('title', 'Laporan Jurnal Umum')

@section('content')
<div class="container">
    <br>
<h4 class="mb-3">Laporan Jurnal Umum</h4>

<form method="GET" class="row mb-4">
    <div class="col-md-3">
        <label class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" 
            value="{{ request('tanggal_awal') ?? date('Y-m-01') }}" 
            class="form-control" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" 
            value="{{ request('tanggal_akhir') ?? date('Y-m-t') }}" 
            class="form-control" required>
    </div>
    <div class="col-md-3 align-self-end">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>


<table class="table table-bordered table-sm">
    <thead class="table-light">
        <tr>
            <th>Tanggal</th>
            <th>No Transaksi</th>
            <th>Keterangan</th>
            <th>Akun</th>
            <th class="text-end">Debet</th>
            <th class="text-end">Kredit</th>
        </tr>
    </thead>
    <tbody>
        @php
            $grandTotalDebit = 0;
            $grandTotalKredit = 0;
        @endphp

        @foreach ($journals as $journal)
            @php
                $totalDebit = 0;
                $totalKredit = 0;
            @endphp

            @foreach ($journal->details as $index => $detail)
                <tr>
                    <td>{{ $index == 0 ? \Carbon\Carbon::parse($journal->date)->format('d-m-Y') : '' }}</td>                   
                    <td>{{ $index == 0 ? $journal->transaction_code : '' }}</td>
                    <td>{{ $index == 0 ? $journal->description : '' }}</td>
                    <td>{{ $detail->account->name }}</td>
                    <td class="text-end">{{ $detail->debit ? number_format($detail->debit, 2) : '' }}</td>
                    <td class="text-end">{{ $detail->credit ? number_format($detail->credit, 2) : '' }}</td>
                </tr>
                @php
                    $totalDebit += $detail->debit;
                    $totalKredit += $detail->credit;
                    $grandTotalDebit += $detail->debit;
                    $grandTotalKredit += $detail->credit;
                @endphp
            @endforeach
{{-- 
            <tr class="table-secondary fw-bold">
                <td colspan="4" class="text-end">Total Transaksi</td>
                <td class="text-end">{{ number_format($totalDebit, 2) }}</td>
                <td class="text-end">{{ number_format($totalKredit, 2) }}</td>
            </tr> --}}
        @endforeach

        <tr class="table-dark fw-bold">
            <td colspan="4" class="text-end">Total Keseluruhan</td>
            <td class="text-end">{{ number_format($grandTotalDebit, 2) }}</td>
            <td class="text-end">{{ number_format($grandTotalKredit, 2) }}</td>
        </tr>
    </tbody>
</table>
</div>
@endsection
