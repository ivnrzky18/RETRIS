<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan Model User di-import

class TopupController extends Controller
{
    public function index()
    {
        return view('warga.topup');
    }

    public function store(Request $request)
    {
        // 1. Validasi (Nama input disesuaikan dengan atribut 'name' di form Blade)
        $request->validate([
            'amount'   => 'required|numeric|min:10000',
            'provider' => 'required'
        ]);

        /** @var \App\Models\User $user **/
        $user = Auth::user();

        // 2. Tambah saldo ke database
        // Menggunakan increment lebih aman untuk operasi matematika di database
        $user->increment('saldo', $request->amount);

        // 3. Simpan riwayat (Opsional - Jika Anda ingin mencatat riwayat top up di tabel lain)
        // Transaction::create([...]); 

        // 4. Redirect dengan pesan sukses
        return redirect()
            ->route('warga.dashboard')
            ->with('success', 'Top up via ' . strtoupper($request->provider) . ' sebesar Rp ' . number_format($request->amount, 0, ',', '.') . ' berhasil!');
    }
}