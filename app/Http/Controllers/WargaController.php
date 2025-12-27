<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrashCollection; // Riwayat Pengangkutan
use App\Models\Payment; 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WargaController extends Controller 
{
    public function index()
    {
        // fresh() memastikan data poin dan saldo terbaru diambil dari database
        $user = Auth::user()->fresh(); 
        
        // Mengambil riwayat pengangkutan sampah terbaru
        $history = TrashCollection::where('user_id', $user->id)
                    ->orderBy('collected_at', 'desc')
                    ->take(5)
                    ->get();

        // 1. AMBIL RIWAYAT TRANSAKSI (Top Up & Iuran)
        $riwayatTransaksi = Payment::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        $bulanIni = Carbon::now()->format('F Y');

        $pembayaranAktif = Payment::where('user_id', $user->id)
                                ->where('month', $bulanIni)
                                ->where('status', 'success')
                                ->first();

        $sudahBayar = $pembayaranAktif ? true : false;
        $tagihanSekarang = $sudahBayar ? 0 : $user->harga_tagihan;

        // 2. LOGIKA MONITORING AI (SINKRONISASI)
        // Ambil persentase langsung dari kolom database yang sama dengan Officer
        $persentase = $user->persentase_kepenuhan ?? 0; 

        return view('warga.dashboard', compact(
            'user', 
            'history', 
            'tagihanSekarang', 
            'sudahBayar', 
            'bulanIni',
            'pembayaranAktif',
            'riwayatTransaksi',
            'persentase' // Pastikan ini dikirim ke blade
        ));
    }

    public function bayarTagihan(Request $request)
    {
        // lockForUpdate mencegah double transaction jika user klik berkali-kali
        $user = User::lockForUpdate()->find(Auth::id());
        $nominalLayanan = $user->harga_tagihan;
        $bulanIni = Carbon::now()->format('F Y');

        $cek = Payment::where('user_id', $user->id)
                        ->where('month', $bulanIni)
                        ->where('status', 'success')
                        ->exists();

        if ($cek) {
            return back()->with('error', "Tagihan periode $bulanIni sudah lunas.");
        }

        if ($user->saldo < $nominalLayanan) {
            return back()->with('error', "Saldo tidak cukup. Silakan Top Up terlebih dahulu.");
        }

        try {
            DB::transaction(function () use ($user, $nominalLayanan, $bulanIni) {
                // Kurangi saldo user
                $user->decrement('saldo', $nominalLayanan);
                $user->update(['tunggakan' => 0]);

                // Buat catatan pembayaran
                Payment::create([
                    'user_id' => $user->id,
                    'amount'  => $nominalLayanan,
                    'type'    => 'iuran',
                    'status'  => 'success',
                    'month'   => $bulanIni,
                ]);
            });

            return back()->with('success', "Pembayaran iuran $bulanIni berhasil!");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran.');
        }
    }
}