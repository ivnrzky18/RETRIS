<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\JournalDetail;

class LedgerController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Account::orderBy('code')->get();
        $selectedAccount = null;
        $ledgerEntries = [];

        if ($request->filled('account_id')) {
            $selectedAccount = Account::findOrFail($request->account_id);

            $ledgerEntries = JournalDetail::with('journalEntry')
                ->where('account_id', $selectedAccount->id)
                ->whereHas('journalEntry', function ($query) use ($request) {
                    if ($request->tanggal_awal && $request->tanggal_akhir) {
                        $query->whereBetween('date', [$request->tanggal_awal, $request->tanggal_akhir]);
                    }
                })
                ->join('journal_entries', 'journal_entries.id', '=', 'journal_details.journal_entry_id')
                ->orderBy('journal_entries.date')
                ->select('journal_details.*')
                ->get();

        }

        return view('ledger.index', compact('accounts', 'selectedAccount', 'ledgerEntries'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
