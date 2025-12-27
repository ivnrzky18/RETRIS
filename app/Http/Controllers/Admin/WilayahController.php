<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use App\Models\User;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        $wilayahs = Wilayah::with('petugas')->get();
        $petugas  = User::where('role', 'petugas')->get();

        return view('admin.wilayah.index', compact('wilayahs', 'petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'petugas_id' => 'required'
        ]);

        Wilayah::create([
            'nama' => $request->nama,
            'petugas_id' => $request->petugas_id
        ]);

        return redirect()->back()->with('success', 'Wilayah berhasil ditambahkan');
    }
}
