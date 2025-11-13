<?php

namespace App\Http\Controllers;

use App\Models\Penyewa; // Mengubah dari Dokter menjadi Penyewa
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    // Menampilkan daftar Penyewa
    public function index()
    {
        // Mengubah variabel dan Model
        $penyewa = Penyewa::all();
        return view('penyewa.index', compact('penyewa'));
    }

    // Menampilkan form tambah Penyewa
    public function create()
    {
        return view('penyewa.create');
    }

    // Menyimpan data Penyewa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // Mengubah 'spesialis' menjadi 'jenis_kelamin'
            'jenis_kelamin' => 'required|string|max:50', 
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255', // Menambahkan kolom yang relevan untuk penyewa
        ]);

        // Mengubah Model yang digunakan
        Penyewa::create($request->all());

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil ditambahkan.');
    }

    // Menampilkan detail Penyewa (optional) atau bisa diabaikan jika tidak ada show()
    // public function show($id)
    // {
    //     $penyewa = Penyewa::findOrFail($id);
    //     return view('penyewa.show', compact('penyewa'));
    // }

    // Menampilkan form edit Penyewa
    public function edit($id)
    {
        // Mengubah variabel, rute view, dan Model
        $penyewa = Penyewa::findOrFail($id);
        // Sesuaikan dengan struktur folder view Anda, misalnya: 'penyewa.edit'
        return view('penyewa.edit', compact('penyewa')); 
    }

    // Memperbarui data Penyewa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            // Mengubah 'spesialis' menjadi 'jenis_kelamin'
            'jenis_kelamin' => 'required|string|max:50', 
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
        ]);

        // Mengubah variabel dan Model
        $penyewa = Penyewa::findOrFail($id);
        $penyewa->update($request->all());

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil diperbarui.');
    }

    // Menghapus data Penyewa
    public function destroy($id)
    {
        // Mengubah variabel dan Model
        $penyewa = Penyewa::findOrFail($id);
        $penyewa->delete();

        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil dihapus.');
    }
}