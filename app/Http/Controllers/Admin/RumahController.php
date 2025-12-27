<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Kita hanya butuh model User
use Illuminate\Http\Request;

class RumahController extends Controller
{
    /**
     * Menampilkan daftar warga (pengganti daftar rumah)
     */
    public function index()
    {
        // Kita ambil semua data user yang rolenya warga
        $rumahs = User::where('role', 'warga')->latest()->get();
        
        // Kita tetap kirim dengan nama variabel $rumahs agar tidak perlu banyak ubah file Blade
        return view('admin.rumah.index', compact('rumahs'));
    }

    /**
     * Menampilkan form tambah warga baru
     */
    public function create()
    {
        return view('admin.rumah.create');
    }

    /**
     * Menyimpan data warga baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
            'kategori' => 'required|string', // Penambahan validasi kategori
        ]);

        // Simpan sebagai User (Warga) termasuk field kategori
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'warga', // Otomatis jadi warga
            'kategori' => $request->kategori, // Penambahan penyimpanan kategori
        ]);

        return redirect()->route('admin.rumah.index')
            ->with('success', 'Data warga berhasil ditambahkan');
    }
}