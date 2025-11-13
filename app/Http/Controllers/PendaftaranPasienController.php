<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use Illuminate\Http\Request;

class PendaftaranPasienController extends Controller
{
    /**
     * Tampilkan semua data pendaftaran pasien.
     */
    public function index()
    {
        $pendaftaranpasien = PendaftaranPasien::latest()->get();
        return view('pendaftaranpasien.index', compact('pendaftaranpasien'));
    }

    /**
     * Simpan data baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'poli_tujuan' => 'required|string',
            'dokter_tujuan' => 'required|string',
            'tanggal_daftar' => 'required|date',
        ]);

        PendaftaranPasien::create($validated);

        return redirect()->route('pendaftaranpasien.index')
                         ->with('success', 'Data pendaftaran pasien berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit data pasien.
     */
    public function edit($id)
    {
        // variabel diganti jadi $pendaftaran agar sama dengan yang dipanggil di view
        $pendaftaran = PendaftaranPasien::findOrFail($id);
        return view('pendaftaranpasien.edit', compact('pendaftaran'));
    }

    /**
     * Update data di database.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'umur' => 'required|integer',
            'jenis_kelamin' => 'required|string',
            'poli_tujuan' => 'required|string',
            'dokter_tujuan' => 'required|string',
            'tanggal_daftar' => 'required|date',
        ]);

        $pendaftaran = PendaftaranPasien::findOrFail($id);
        $pendaftaran->update($validated);

        return redirect()->route('pendaftaranpasien.index')
                         ->with('success', 'Data pendaftaran pasien berhasil diperbarui!');
    }

    /**
     * Hapus data dari database.
     */
    public function destroy($id)
    {
        $pendaftaran = PendaftaranPasien::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaranpasien.index')
                         ->with('success', 'Data pendaftaran pasien berhasil dihapus!');
    }
}
