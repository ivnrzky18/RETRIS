<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanDokter;
use Illuminate\Http\Request;

class PemeriksaanDokterController extends Controller
{
    public function index()
    {
        $pemeriksaandokter = PemeriksaanDokter::all();
        return view('pemeriksaandokter.index', compact('pemeriksaandokter'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|string',
            'tanggal_periksa' => 'required|date',
        ]);

        PemeriksaanDokter::create($validated);

        return redirect()->route('pemeriksaandokter.index')
            ->with('success', 'Data pemeriksaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemeriksaan = PemeriksaanDokter::findOrFail($id);
        return view('pemeriksaandokter.edit', compact('pemeriksaan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'tindakan' => 'nullable|string',
            'tanggal_periksa' => 'required|date',
        ]);

        $pemeriksaan = PemeriksaanDokter::findOrFail($id);
        $pemeriksaan->update($validated);

        return redirect()->route('pemeriksaandokter.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemeriksaan = PemeriksaanDokter::findOrFail($id);
        $pemeriksaan->delete();

        return redirect()->route('pemeriksaandokter.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
}
