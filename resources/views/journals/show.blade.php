@extends('layouts.app')

@section('title', 'Detail Jurnal')

@section('content')
    <h4>Detail Transaksi: {{ $journal->transaction_code }}</h4>
    <p><strong>Tanggal:</strong> {{ $journal->date }}</p>
    <p><strong>Deskripsi:</strong> {{ $journal->description }}</p>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Kode Akun</th>
                <th>Nama Akun</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
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

    <a href="{{ route('journals.index') }}" class="btn btn-secondary">← Kembali</a>
@endsection
