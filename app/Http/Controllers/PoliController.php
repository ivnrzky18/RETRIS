<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    // Menampilkan daftar semua poli
    public function index()
    {
        $poli = Poli::all();
        return view('poli.index', compact('poli'));
    }

    // Form tambah poli
    public function create()
    {
        return view('poli.create');
    }

    // Proses simpan data poli baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_poli' => 'required|string|max:20|unique:polis,kode_poli',
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'dokter_penanggung_jawab' => 'nullable|string|max:255',
        ]);

        Poli::create([
            'kode_poli' => $request->kode_poli,
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
            'dokter_penanggung_jawab' => $request->dokter_penanggung_jawab,
        ]);

        return redirect()->route('poli.index')->with('success', 'Data poli berhasil ditambahkan.');
    }

    // Form edit data poli
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('poli.edit', compact('poli'));
    }

    // Proses update data poli
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_poli' => 'required|string|max:20|unique:polis,kode_poli,' . $id,
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'dokter_penanggung_jawab' => 'nullable|string|max:255',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update([
            'kode_poli' => $request->kode_poli,
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
            'dokter_penanggung_jawab' => $request->dokter_penanggung_jawab,
        ]);

        return redirect()->route('poli.index')->with('success', 'Data poli berhasil diperbarui.');
    }

    // Hapus data poli
    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'Data poli berhasil dihapus.');
    }
}
