<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\RekamMedisPasien;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Menampilkan daftar rekam medis
     */
    public function index()
    {
        $rekamMedis = RekamMedis::all();
        return view('rekammedis.index', compact('rekamMedis'));
    }

    /**
     * Menyimpan data rekam medis baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'diagnosa' => 'required|string|max:255',
            'tindakan' => 'required|string|max:255',
            'tanggal_rekam' => 'required|date',
        ]);

        RekamMedis::create($validated);

        return redirect()->route('rekammedis.index')
            ->with('success', 'Data rekam medis berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit rekam medis
     */
    public function edit($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        return view('rekammedis.edit', compact('rekamMedis'));
    }

    /**
     * Memperbarui data rekam medis
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'diagnosa' => 'required|string|max:255',
            'tindakan' => 'required|string|max:255',
            'tanggal_rekam' => 'required|date',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update($validated);

        return redirect()->route('rekammedis.index')
            ->with('success', 'Data rekam medis berhasil diperbarui.');
    }

    /**
     * Menghapus data rekam medis
     */
    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();

        return redirect()->route('rekammedis.index')
            ->with('success', 'Data rekam medis berhasil dihapus.');
    }
}
