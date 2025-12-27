<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TrashCollection;
use App\Models\PointLog;
use App\Services\WasteAiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk transaksi aman
use Carbon\Carbon;

class OfficerController extends Controller
{
    protected $aiService;

    public function __construct(WasteAiService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index()
    {
        $warga = User::where('role', 'warga')->get();

        foreach ($warga as $item) {
            // Logika AI tetap berjalan untuk prediksi
            $item->persentase_kepenuhan = $this->aiService->predictFullness($item->id);
        }

        $riwayatHariIni = TrashCollection::with('user')
            ->whereDate('collected_at', Carbon::today())
            ->orderBy('collected_at', 'desc')
            ->get();

        return view('officer.dashboard', compact('warga', 'riwayatHariIni'));
    }

    /**
     * FUNGSI UNTUK SCAN QR
     */
    public function scanQR(Request $request)
    {
        $warga = User::find($request->user_id);

        if (!$warga) {
            return response()->json(['success' => false, 'message' => 'Warga tidak ditemukan!']);
        }

        $sudahDiangkut = TrashCollection::where('user_id', $warga->id)
            ->whereDate('collected_at', Carbon::today())
            ->exists();

        if ($sudahDiangkut) {
            return response()->json(['success' => false, 'message' => 'Warga ini sudah diangkut hari ini!']);
        }

        DB::transaction(function () use ($warga) {
            // 1. Simpan data pengangkutan
            TrashCollection::create([
                'user_id' => $warga->id,
                'officer_id' => Auth::id(),
                'status' => 'Sudah Diangkut',
                'collected_at' => now(),
            ]);

            // 2. Tambah Poin
            $jumlahPoin = 10;
            $warga->increment('points', $jumlahPoin);

            // 3. RESET MONITORING AI ke 0 (Penting agar sinkron!)
            $warga->update(['persentase_kepenuhan' => 0]);

            PointLog::create([
                'user_id' => $warga->id,
                'amount' => $jumlahPoin,
                'description' => 'Setoran sampah (Scan QR)',
            ]);
        });

        return response()->json([
            'success' => true,
            'nama_warga' => $warga->name,
            'poin_didapat' => 10
        ]);
    }

    /**
     * FUNGSI KONFIRMASI MANUAL (Sesuai dengan pemanggilan rute)
     */
    public function konfirmasiManual($id) // Nama fungsi disamakan dengan rute
    {
        $warga = User::findOrFail($id);
        
        $sudahDiangkut = TrashCollection::where('user_id', $id)
            ->whereDate('collected_at', Carbon::today())
            ->exists();

        if ($sudahDiangkut) {
            return back()->with('error', 'Warga ini sudah dikonfirmasi hari ini!');
        }

        DB::transaction(function () use ($warga, $id) {
            TrashCollection::create([
                'user_id' => $id,
                'officer_id' => Auth::id(),
                'status' => 'Sudah Diangkut',
                'collected_at' => now(),
            ]);

            // Tambah poin
            $jumlahPoin = 10;
            $warga->increment('points', $jumlahPoin);

            // RESET MONITORING AI ke 0 (Agar di warga tampil 0%)
            $warga->update(['persentase_kepenuhan' => 0]);

            PointLog::create([
                'user_id' => $id,
                'amount' => $jumlahPoin,
                'description' => 'Setoran sampah (Konfirmasi Manual)',
            ]);
        });

        return back()->with('success', 'Berhasil! Poin bertambah & Monitoring AI di-reset.');
    }
}