<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use Illuminate\Http\Request;

class ResepObatController extends Controller
{
    /**
     * Menampilkan daftar resep & obat
     */
    public function index()
    {
        $resepobat = ResepObat::all();
        return view('resepobat.index', compact('resepobat'));
    }

    /**
     * Menyimpan data resep baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'nama_obat' => 'required|string|max:100',
            'dosis' => 'required|string|max:100',
            'jumlah' => 'required|integer',
            'aturan_pakai' => 'required|string|max:255',
            'tanggal_resep' => 'required|date',
        ]);

        ResepObat::create($validated);

        return redirect()->route('resepobat.index')
            ->with('success', 'Data resep dan obat berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit resep
     */
    public function edit($id)
    {
        $resep = ResepObat::findOrFail($id);
        return view('resepobat.edit', compact('resep'));
    }

    /**
     * Memperbarui data resep
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'nama_obat' => 'required|string|max:100',
            'dosis' => 'required|string|max:100',
            'jumlah' => 'required|integer',
            'aturan_pakai' => 'required|string|max:255',
            'tanggal_resep' => 'required|date',
        ]);

        $resep = ResepObat::findOrFail($id);
        $resep->update($validated);

        return redirect()->route('resepobat.index')
            ->with('success', 'Data resep dan obat berhasil diperbarui.');
    }

    /**
     * Menghapus data resep
     */
    public function destroy($id)
    {
        $resep = ResepObat::findOrFail($id);
        $resep->delete();

        return redirect()->route('resepobat.index')
            ->with('success', 'Data resep dan obat berhasil dihapus.');
    }
}
