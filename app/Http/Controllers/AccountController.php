<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::orderBy('code')->get();
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:accounts',
            'name' => 'required',
            'type' => 'required',
            'normal_balance' => 'required'
        ]);

        Account::create($request->all());
        return redirect()->route('accounts.index')->with('success', 'Akun berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $account = Account::findOrFail($id);
        return view('accounts.show', compact('account'));
    }

    public function edit(string $id)
    {
        $account = Account::findOrFail($id);
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, string $id)
    {
        $account = Account::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:accounts,code,' . $account->id,
            'name' => 'required',
            'type' => 'required',
            'normal_balance' => 'required'
        ]);

        $account->update($request->all());
        return redirect()->route('accounts.index')->with('success', 'Akun berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Akun berhasil dihapus');
    }
}
