<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi RETRIS</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #f2f2f2; padding: 8px; border: 1px solid #ddd; text-align: left; }
        td { padding: 8px; border: 1px solid #ddd; }
        .footer { text-align: right; margin-top: 30px; font-style: italic; }
        .summary { width: 40%; margin-left: 60%; }
        .summary table { border: none; }
        .summary td { border: none; padding: 4px; }
        .text-success { color: #198754; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin-bottom: 5px;">LAPORAN TRANSAKSI MASUK - RETRIS</h2>
        <span>Periode: {{ $bulanIni }}</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Warga</th>
                <th>Kategori</th>
                <th>Nominal</th>
                <th>Periode Tagihan</th>
                <th>Waktu Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $payment->user->name ?? 'User Terhapus' }}</td>
                <td>{{ strtoupper($payment->type) }}</td>
                <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                <td>{{ $payment->month ?? '-' }}</td>
                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <td>Total Pendapatan Iuran:</td>
                <td class="text-success">Rp {{ number_format($totalIuran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Top Up:</td>
                <td>Rp {{ number_format($totalTopup, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Dicetak otomatis oleh Sistem RETRIS pada {{ $waktuCetak }}
    </div>
</body>
</html>