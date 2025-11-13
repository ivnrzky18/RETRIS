<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranSewa; // Asumsi nama modelnya adalah PembayaranSewa

class PembayaranSewaController extends Controller
{
    /**
     * Menampilkan daftar data pembayaran sewa.
     */
    public function index()
    {
        // variabel dan view dipertahankan untuk meminimalkan perubahan di file lain
        $pembayaran = PembayaranSewa::all();
        // PERBAIKAN: Mengubah 'pembayaransewa.index' menjadi 'pembayaran_sewa.index'
       return view('pembayaran_sewa.index', compact('pembayaran'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        return view('pembayaran_sewa.create');
    }

    /**
     * Menyimpan data pembayaran sewa baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Validasi dipertahankan, asumsikan nama kolom telah diperbaiki di sini
            'nama_penyewa'      => 'required|max:100', 
            'jumlah'            => 'required|numeric',
            'metode_pembayaran' => 'required|string|max:50',
            'tanggal_pembayaran'=> 'required|date',
        ]);

        PembayaranSewa::create($validated);

        // PERBAIKAN: Mengubah 'pembayaransewa.index' menjadi 'pembayaran_sewa.index'
        return redirect()->route('pembayaran_sewa.index') 
            ->with('success', 'Data pembayaran sewa berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(string $id)
    {
        $pembayaran = PembayaranSewa::findOrFail($id);
        return view('pembayaran_sewa.edit', compact('pembayaran'));
    }

    /**
     * Memperbarui data pembayaran sewa yang ada.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_penyewa'      => 'required|max:100',
            'jumlah'            => 'required|numeric',
            'metode_pembayaran' => 'required|string|max:50',
            'tanggal_pembayaran'=> 'required|date',
        ]);

        $pembayaran = PembayaranSewa::findOrFail($id);
        $pembayaran->update($validated);
        
        // PERBAIKAN: Mengubah 'pembayaransewa.index' menjadi 'pembayaran_sewa.index'
        return redirect()->route('pembayaran_sewa.index')
            ->with('success', 'Data pembayaran sewa berhasil diperbarui.');
    }

    /**
     * Menghapus data pembayaran sewa.
     */
    public function destroy(string $id)
    {
        $pembayaran = PembayaranSewa::findOrFail($id);
        $pembayaran->delete();

        // PERBAIKAN: Mengubah 'pembayaransewa.index' menjadi 'pembayaran_sewa.index'
        return redirect()->route('pembayaran_sewa.index')
            ->with('success', 'Data pembayaran sewa berhasil dihapus.');
    }
}