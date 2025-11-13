<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Diperlukan untuk validasi unik saat update

class KamarController extends Controller
{
    /**
     * Menampilkan daftar data Kamar.
     */
    public function index()
    {
        $kamar = Kamar::all();
        // Mengganti view 'pasien.index' menjadi 'kamar.index'
        return view('kamar.index', compact('kamar'));
    }

    /**
     * Menampilkan form untuk membuat data Kamar baru.
     */
    public function create()
    {
        // Mengganti view 'pasien.create' menjadi 'kamar.create'
        return view('kamar.create');
    }

    /**
     * Menyimpan data Kamar baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Validasi data Kamar: nomor_kamar harus unik
            'nomor_kamar' => 'required|string|max:10|unique:kamar,nomor_kamar', 
            // Tambahkan validasi untuk tipe kamar
            'tipe_kamar'  => 'required|in:ac,non ac,lengkap', 
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:Tersedia,Terisi,Dalam Perbaikan',
            'deskripsi'   => 'nullable|string',
        ], [
            // Custom messages for better user experience
            'nomor_kamar.required' => 'Nomor Kamar wajib diisi.',
            'nomor_kamar.unique'   => 'Nomor Kamar ini sudah terdaftar. Gunakan nomor lain.',
            'tipe_kamar.required'  => 'Tipe Kamar wajib dipilih.',
            'tipe_kamar.in'        => 'Tipe Kamar harus salah satu dari: AC, Non AC, atau Lengkap.',
            'harga.required'       => 'Harga sewa wajib diisi.',
            'status.required'      => 'Status kamar wajib dipilih.',
        ]);

        Kamar::create($request->all());

        // Mengganti route 'pasien.index' menjadi 'kamar.index'
        return redirect()->route('kamar.index')->with('success', 'Data Kamar berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data Kamar.
     */
    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        // Mengganti view 'pasien.edit' menjadi 'kamar.edit'
        return view('kamar.edit', compact('kamar'));
    }

    /**
     * Memperbarui data Kamar yang ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // Validasi unik nomor_kamar, mengabaikan ID kamar saat ini
            'nomor_kamar' => [
                'required',
                'string',
                'max:10',
                Rule::unique('kamar', 'nomor_kamar')->ignore($id),
            ],
            // Tambahkan validasi untuk tipe kamar
            'tipe_kamar'  => 'required|in:ac,non ac,lengkap', 
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:Tersedia,Terisi,Dalam Perbaikan',
            'deskripsi'   => 'nullable|string',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->all());

        // Mengganti route 'pasien.index' menjadi 'kamar.index'
        return redirect()->route('kamar.index')->with('success', 'Data Kamar berhasil diperbarui.');
    }

    /**
     * Menghapus data Kamar.
     */
    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        // Mengganti route 'pasien.index' menjadi 'kamar.index'
        return redirect()->route('kamar.index')->with('success', 'Data Kamar berhasil dihapus.');
    }
}