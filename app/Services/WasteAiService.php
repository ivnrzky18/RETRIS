<?php

namespace App\Services;

use App\Models\TrashCollection;
use Carbon\Carbon;

class WasteAiService
{
    /**
     * Logika AI untuk memprediksi tingkat kepenuhan sampah (%)
     * Perbaikan: Menggunakan 'collected_at' agar sinkron dengan Controller
     */
    public function predictFullness($userId)
    {
        // 1. Ambil 3 data terakhir berdasarkan 'collected_at' (bukan created_at)
        $history = TrashCollection::where('user_id', $userId)
                                  ->orderBy('collected_at', 'desc')
                                  ->take(3)
                                  ->get();

        // Jika belum pernah diangkut sama sekali
        if ($history->isEmpty()) {
            return 0; // Default awal benar-benar kosong
        }

        // 2. Jika baru ada 1 riwayat, gunakan estimasi waktu standar (misal 3 hari untuk penuh)
        if ($history->count() < 2) {
            $daysSinceLastScan = now()->diffInMinutes($history->first()->collected_at) / (24 * 60);
            $prediction = ($daysSinceLastScan / 3) * 100; // Asumsi rata-rata 3 hari penuh
            return max(0, min(round($prediction), 100));
        }

        // 3. Hitung selisih antar penjemputan (Interval)
        $intervals = [];
        for ($i = 0; $i < $history->count() - 1; $i++) {
            // Menggunakan diffInMinutes dibagi jam agar lebih presisi daripada diffInDays
            $diff = Carbon::parse($history[$i]->collected_at)->diffInMinutes(Carbon::parse($history[$i+1]->collected_at)) / (24 * 60);
            $intervals[] = $diff > 0 ? $diff : 0.5; // Minimal 0.5 hari
        }
        
        // Rata-rata interval kebiasaan warga
        $avgInterval = array_sum($intervals) / count($intervals);

        // 4. Hitung waktu yang sudah lewat sejak penjemputan terakhir hingga SEKARANG
        $lastCollection = Carbon::parse($history->first()->collected_at);
        
        // Jika collected_at ada di masa depan (error input), jadikan 0
        if ($lastCollection->isFuture()) {
            return 0;
        }

        $daysSinceLastScan = now()->diffInMinutes($lastCollection) / (24 * 60);

        // 5. RUMUS PREDIKSI AI:
        $prediction = ($daysSinceLastScan / $avgInterval) * 100;

        // PERBAIKAN VITAL: Gunakan max(0, ...) agar tidak muncul angka negatif
        return max(0, min(round($prediction), 100));
    }
}