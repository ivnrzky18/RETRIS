<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Payment; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Import facade PDF

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = Carbon::now()->format('F Y');

        $totalRumah   = User::where('role', 'warga')->count();
        $totalPetugas = User::where('role', 'petugas')->count();

        $idWargaSudahBayar = Payment::where('month', $bulanIni)
                                ->where('type', 'iuran')
                                ->where('status', 'success')
                                ->pluck('user_id')
                                ->toArray();

        $rumahMenunggak = User::where('role', 'warga')
                            ->whereNotIn('id', $idWargaSudahBayar)
                            ->count();

        $totalIuran = Payment::where('month', $bulanIni)
                        ->where('type', 'iuran')
                        ->where('status', 'success')
                        ->sum('amount');
        
        $totalWilayah = 0; 
        $wilayahs = collect(); 
        
        $rumahs = User::where('role', 'warga')
                    ->latest()
                    ->take(5)
                    ->get(); 

        $recentPayments = Payment::with('user')
                            ->where('status', 'success')
                            ->latest() 
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact(
            'totalWilayah', 'totalRumah', 'rumahMenunggak', 
            'totalIuran', 'totalPetugas', 'wilayahs', 
            'rumahs', 'bulanIni', 'recentPayments'
        ));
    }

    /**
     * Fungsi baru untuk generate PDF laporan transaksi bulan berjalan
     */
    public function cetakLaporan()
    {
        $bulanIni = Carbon::now()->format('F Y');
        
        // Ambil SEMUA transaksi sukses bulan ini untuk laporan (bukan cuma 5)
        $payments = Payment::with('user')
                    ->where('month', $bulanIni)
                    ->where('status', 'success')
                    ->latest()
                    ->get();

        $totalIuran = $payments->where('type', 'iuran')->sum('amount');
        $totalTopup = $payments->where('type', 'topup')->sum('amount');

        $pdf = Pdf::loadView('admin.laporan_pdf', [
            'payments' => $payments,
            'bulanIni' => $bulanIni,
            'totalIuran' => $totalIuran,
            'totalTopup' => $totalTopup,
            'waktuCetak' => Carbon::now()->format('d/m/Y H:i')
        ]);

        return $pdf->stream('Laporan_Transaksi_'.$bulanIni.'.pdf');
    }
}