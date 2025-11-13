<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanLaboratorium;
use Illuminate\Http\Request;

class PemeriksaanLaboratoriumController extends Controller
{
    /**
     * Menampilkan daftar pemeriksaan laboratorium
     */
    public function index()
    {
        $pemeriksaanlaboratorium = PemeriksaanLaboratorium::all();
        return view('pemeriksaanlaboratorium.index', compact('pemeriksaanlaboratorium'));
    }

    /**
     * Menyimpan data pemeriksaan laboratorium baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'jenis_tes' => 'required|string|max:100',
            'hasil' => 'required|string|max:255',
            'tanggal_tes' => 'required|date',
        ]);

        PemeriksaanLaboratorium::create($validated);

        return redirect()->route('pemeriksaanlaboratorium.index')
            ->with('success', 'Data pemeriksaan laboratorium berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pemeriksaan laboratorium
     */
    public function edit($id)
    {
        $pemeriksaanlaboratorium = PemeriksaanLaboratorium::findOrFail($id);
        return view('pemeriksaanlaboratorium.edit', compact('pemeriksaanlaboratorium'));
    }

    /**
     * Memperbarui data pemeriksaan laboratorium
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'jenis_tes' => 'required|string|max:100',
            'hasil' => 'required|string|max:255',
            'tanggal_tes' => 'required|date',
        ]);

        $pemeriksaanlaboratorium = PemeriksaanLaboratorium::findOrFail($id);
        $pemeriksaanlaboratorium->update($validated);

        return redirect()->route('pemeriksaanlaboratorium.index')
            ->with('success', 'Data pemeriksaan laboratorium berhasil diperbarui.');
    }

    /**
     * Menghapus data pemeriksaan laboratorium
     */
    public function destroy($id)
    {
        $pemeriksaanlaboratorium = PemeriksaanLaboratorium::findOrFail($id);
        $pemeriksaanlaboratorium->delete();

        return redirect()->route('pemeriksaanlaboratorium.index')
            ->with('success', 'Data pemeriksaan laboratorium berhasil dihapus.');
    }
}
