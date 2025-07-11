<?php

namespace App\Http\Controllers;

use App\Models\CashBank;
use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\JournalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashBankController extends Controller
{
    public function index()
    {
        $data = CashBank::with('account')->latest()->get();
        $accounts = Account::orderBy('code')->get();

        return view('cashbank.index', compact('data', 'accounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe_transaksi' => 'required',
            'sumber' => 'required',
            'tanggal' => 'required|date',
            'deskripsi' => 'required',
            'jumlah' => 'required|numeric',
            'account_id' => 'required|exists:accounts,id',
        ]);

        DB::transaction(function () use ($request) {
            $journal = JournalEntry::create([
                'transaction_code' => 'KB-' . now()->timestamp,
                'date' => $request->tanggal,
                'description' => $request->deskripsi,
                'type' => 'Kas/Bank',
                'created_by' => auth()->id(),
            ]);

            // Tentukan akun kas/bank
            $cashAccount = Account::where('name', $request->sumber)->first();

            if ($request->tipe_transaksi === 'Masuk') {
                // Debit Kas/Bank, Kredit akun lawan
                JournalDetail::create([
                    'journal_entry_id' => $journal->id,
                    'account_id' => $cashAccount->id,
                    'debit' => $request->jumlah,
                    'credit' => 0,
                ]);
                JournalDetail::create([
                    'journal_entry_id' => $journal->id,
                    'account_id' => $request->account_id,
                    'debit' => 0,
                    'credit' => $request->jumlah,
                ]);
            } else {
                // Debit akun lawan, Kredit Kas/Bank
                JournalDetail::create([
                    'journal_entry_id' => $journal->id,
                    'account_id' => $request->account_id,
                    'debit' => $request->jumlah,
                    'credit' => 0,
                ]);
                JournalDetail::create([
                    'journal_entry_id' => $journal->id,
                    'account_id' => $cashAccount->id,
                    'debit' => 0,
                    'credit' => $request->jumlah,
                ]);
            }

            CashBank::create([
                'tipe_transaksi' => $request->tipe_transaksi,
                'sumber' => $request->sumber,
                'tanggal' => $request->tanggal,
                'deskripsi' => $request->deskripsi,
                'jumlah' => $request->jumlah,
                'account_id' => $request->account_id,
                'journal_entry_id' => $journal->id,
            ]);
        });

        return redirect()->route('cashbank.index')->with('success', 'Transaksi berhasil disimpan.');
    }
}
