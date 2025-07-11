<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountingPeriod;
use App\Models\JournalDetail;
use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalEntryController extends Controller
{
    public function index()
    {
        $journals = JournalEntry::with('details.account')->orderBy('date')->get();
        $accounts = Account::orderBy('code')->get();
        return view('journals.index', compact('journals', 'accounts'));
    }

    public function create()
    {
      
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required',
            'accounts.*.account_id' => 'required|exists:accounts,id',
            'accounts.*.debit' => 'nullable|numeric',
            'accounts.*.credit' => 'nullable|numeric',
        ]);

        $periode = AccountingPeriod::where('status', 'Dibuka')->first();
        if (!$periode || now()->lt($periode->tanggal_awal) || now()->gt($periode->tanggal_akhir)) {
            return back()->withErrors(['Periode akuntansi saat ini sudah ditutup atau belum tersedia.']);
        }


        $totalDebit = collect($request->accounts)->sum('debit');
        $totalCredit = collect($request->accounts)->sum('credit');

        if ($totalDebit != $totalCredit) {
            return back()->withErrors(['message' => 'Jumlah debit dan kredit harus sama.']);
        }

        DB::transaction(function () use ($request) {
            $entry = JournalEntry::create([
                'transaction_code' => 'JU-' . now()->timestamp,
                'date' => $request->date,
                'description' => $request->description,
                'created_by' => auth()->id(),
            ]);

            foreach ($request->accounts as $row) {
                JournalDetail::create([
                    'journal_entry_id' => $entry->id,
                    'account_id' => $row['account_id'],
                    'debit' => $row['debit'] ?? 0,
                    'credit' => $row['credit'] ?? 0,
                ]);
            }
        });

        return redirect()->route('journals.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function show(string $id)
    {
        $journal = JournalEntry::with('details.account')->findOrFail($id);
        return view('journals.show', compact('journal'));
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


    //PENYESUAIAN =====================================================================

    public function indexPenyesuaian()
    {
        $journals = JournalEntry::where('type', 'Penyesuaian')->get();
        $accounts = Account::orderBy('code')->get();
        return view('journals.penyesuaian.index', compact('journals', 'accounts'));
    }

    public function storePenyesuaian(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required',
            'accounts.*.account_id' => 'required|exists:accounts,id',
            'accounts.*.debit' => 'nullable|numeric',
            'accounts.*.credit' => 'nullable|numeric',
        ]);

        $totalDebit = collect($request->accounts)->sum('debit');
        $totalCredit = collect($request->accounts)->sum('credit');

        if ($totalDebit != $totalCredit) {
            return back()->withErrors(['message' => 'Jumlah debit dan kredit harus sama.']);
        }

        \DB::transaction(function () use ($request) {
            $entry = JournalEntry::create([
                'transaction_code' => 'JU-' . now()->timestamp,
                'date' => $request->date,
                'description' => $request->description,
                'type' => 'Penyesuaian',
                'created_by' => auth()->id(),
            ]);

            foreach ($request->accounts as $row) {
                JournalDetail::create([
                    'journal_entry_id' => $entry->id,
                    'account_id' => $row['account_id'],
                    'debit' => $row['debit'] ?? 0,
                    'credit' => $row['credit'] ?? 0,
                ]);
            }
        });

        return redirect()->route('journals.penyesuaian')->with('success', 'Transaksi penyesuaian disimpan.');
    }

    //JURNAL PENUTUP =========================================================================================
    public function indexPenutup()
    {
        $journals = \App\Models\JournalEntry::where('type', 'Penutup')->get();
        $accounts = \App\Models\Account::orderBy('code')->get();
        return view('journals.penutup.index', compact('journals', 'accounts'));
    }

    public function storePenutup(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'description' => 'required',
            'accounts.*.account_id' => 'required|exists:accounts,id',
            'accounts.*.debit' => 'nullable|numeric',
            'accounts.*.credit' => 'nullable|numeric',
        ]);

        $totalDebit = collect($request->accounts)->sum('debit');
        $totalCredit = collect($request->accounts)->sum('credit');

        if ($totalDebit != $totalCredit) {
            return back()->withErrors(['message' => 'Jumlah debit dan kredit harus sama.']);
        }

        \DB::transaction(function () use ($request) {
            $entry = \App\Models\JournalEntry::create([
                'transaction_code' => 'JU-' . now()->timestamp,
                'date' => $request->date,
                'description' => $request->description,
                'type' => 'Penutup',
                'created_by' => auth()->id(),
            ]);

            foreach ($request->accounts as $row) {
                \App\Models\JournalDetail::create([
                    'journal_entry_id' => $entry->id,
                    'account_id' => $row['account_id'],
                    'debit' => $row['debit'] ?? 0,
                    'credit' => $row['credit'] ?? 0,
                ]);
            }
        });

        return redirect()->route('journals.penutup')->with('success', 'Jurnal penutup berhasil disimpan.');
    }
 
    public function reset_transaksi()
    {
        try {
            DB::beginTransaction();

            DB::table('journal_details')->delete();
            DB::table('journal_entries')->delete();
            // DB::table('adjusting_entries')->delete();
            // DB::table('closing_entries')->delete();
            // DB::table('kas_bank_details')->delete();
            // DB::table('kas_banks')->delete();
            // DB::table('sales_items')->delete();
            // DB::table('sales')->delete();
            // DB::table('purchase_items')->delete();
            // DB::table('purchases')->delete();
            // DB::table('payments')->delete();

            DB::commit();

            return back()->with('success', '✅ Semua data transaksi berhasil dikosongkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', '❌ Gagal mengosongkan transaksi: ' . $e->getMessage());
        }
    }



}
