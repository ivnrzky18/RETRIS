<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('kode')->paginate(10);
        return view('units.index', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:units',
            'nama' => 'required',
        ]);

        Unit::create($request->only('kode', 'nama', 'keterangan'));

        return back()->with('success', 'Unit berhasil ditambahkan.');
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'kode' => 'required|unique:units,kode,' . $unit->id,
            'nama' => 'required',
        ]);

        $unit->update($request->only('kode', 'nama', 'keterangan'));

        return back()->with('success', 'Unit berhasil diperbarui.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return back()->with('success', 'Unit berhasil dihapus.');
    }

}
