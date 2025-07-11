<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\AccountingPeriod;
use Illuminate\Http\Request;

class AccountingPeriodController extends Controller
{
    public function index()
    {
        $data = AccountingPeriod::orderByDesc('tanggal_awal')->get();
        return view('period.index', compact('data'));
    }

    public function create()
    {
        return view('period.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        AccountingPeriod::create($request->all());

        return redirect()->route('periode-akuntansi.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $periode = AccountingPeriod::findOrFail($id);
        return view('period.edit', compact('periode'));
    }

    public function update(Request $request, $id)
    {
        $periode = AccountingPeriod::findOrFail($id);
        $periode->update($request->all());

        return redirect()->route('periode-akuntansi.index')->with('success', 'Periode diperbarui.');
    }

    public function destroy($id)
    {
        AccountingPeriod::findOrFail($id)->delete();
        return back()->with('success', 'Periode dihapus.');
    }
}
