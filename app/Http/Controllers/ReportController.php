<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\JournalEntry;

class ReportController extends Controller
{
    public function jurnalUmum(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $journals = JournalEntry::with(['details.account'])
            ->when($tanggalAwal && $tanggalAkhir, function ($query) use ($tanggalAwal, $tanggalAkhir) {
                $query->whereBetween('date', [$tanggalAwal, $tanggalAkhir]);
            })
            ->orderBy('date')
            ->get();

        return view('reports.jurnal-umum', compact('journals'));
    }

    public function trialBalance(Request $request)
    {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;

        $accounts = Account::with(['journalDetails' => function($query) use ($start, $end) {
            if ($start && $end) {
                $query->whereHas('journalEntry', function ($q) use ($start, $end) {
                    $q->whereBetween('date', [$start, $end]);
                });
            }
        }])->get();

        $data = $accounts->map(function ($a) {
            $debit = $a->journalDetails->sum('debit');
            $credit = $a->journalDetails->sum('credit');
            $saldo = $a->normal_balance === 'Debit' ? $debit - $credit : $credit - $debit;

            return [
                'code' => $a->code,
                'name' => $a->name,
                'type' => $a->type,
                'normal_balance' => $a->normal_balance,
                'saldo' => $saldo,
                'debit' => $debit,
                'credit' => $credit,
            ];
        });

        return view('reports.trial-balance', compact('data'));
    }

    public function incomeStatement(Request $request)
    {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;

        $accounts = Account::with(['journalDetails' => function($query) use ($start, $end) {
            if ($start && $end) {
                $query->whereHas('journalEntry', function ($q) use ($start, $end) {
                    $q->whereBetween('date', [$start, $end]);
                });
            }
        }])->get();

        $pendapatan = $accounts->where('type', 'Pendapatan')->sum(fn($a) => $a->journalDetails->sum('credit') - $a->journalDetails->sum('debit'));
        $beban = $accounts->where('type', 'Beban')->sum(fn($a) => $a->journalDetails->sum('debit') - $a->journalDetails->sum('credit'));
        $labaBersih = $pendapatan - $beban;

        return view('reports.income-statement', compact('pendapatan', 'beban', 'labaBersih'));
    }

    public function balanceSheet(Request $request)
    {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;

        $accounts = Account::with(['journalDetails' => function($query) use ($start, $end) {
            if ($start && $end) {
                $query->whereHas('journalEntry', function ($q) use ($start, $end) {
                    $q->whereBetween('date', [$start, $end]);
                });
            }
        }])->get();

        $aset = $accounts->where('type', 'Aset')->sum(fn($a) => $this->hitungSaldo($a));
        $kewajiban = $accounts->where('type', 'Kewajiban')->sum(fn($a) => $this->hitungSaldo($a));
        $modal = $accounts->where('type', 'Modal')->sum(fn($a) => $this->hitungSaldo($a));

        return view('reports.balance-sheet', compact('aset', 'kewajiban', 'modal'));
    }

    public function equityChange(Request $request)
    {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;

        $accounts = Account::with(['journalDetails' => function($query) use ($start, $end) {
            if ($start && $end) {
                $query->whereHas('journalEntry', function ($q) use ($start, $end) {
                    $q->whereBetween('date', [$start, $end]);
                });
            }
        }])->get();

        $modalAwal = $accounts->where('type', 'Modal')->sum(fn($a) => $this->hitungSaldo($a));
        $prive = $accounts->where('name', 'like', '%Prive%')->sum(fn($a) => $a->journalDetails->sum('debit'));
        $labaBersih = $this->hitungLabaBersih($accounts);
        $modalAkhir = $modalAwal + $labaBersih - $prive;

        return view('reports.equity-change', compact('modalAwal', 'prive', 'labaBersih', 'modalAkhir'));
    }

    public function cashFlow(Request $request)
    {
        $start = $request->tanggal_awal;
        $end = $request->tanggal_akhir;

        $accounts = Account::with(['journalDetails' => function($query) use ($start, $end) {
            if ($start && $end) {
                $query->whereHas('journalEntry', function ($q) use ($start, $end) {
                    $q->whereBetween('date', [$start, $end]);
                });
            }
        }])->get();

        $kas = $accounts->where('name', 'like', '%Kas%')->first();
        $debitKas = $kas?->journalDetails->sum('debit') ?? 0;
        $kreditKas = $kas?->journalDetails->sum('credit') ?? 0;
        $saldoKas = $debitKas - $kreditKas;

        $labaBersih = $this->hitungLabaBersih($accounts);
        $penyesuaian = 0;
        $kasAwal = $saldoKas - $labaBersih;

        return view('reports.cash-flow', compact('kasAwal', 'labaBersih', 'penyesuaian', 'saldoKas'));
    }

    private function hitungSaldo($akun)
    {
        $debit = $akun->journalDetails->sum('debit');
        $credit = $akun->journalDetails->sum('credit');
        return $akun->normal_balance === 'Debit' ? $debit - $credit : $credit - $debit;
    }

    private function hitungLabaBersih($accounts)
    {
        $pendapatan = $accounts->where('type', 'Pendapatan')->sum(fn($a) => $a->journalDetails->sum('credit') - $a->journalDetails->sum('debit'));
        $beban = $accounts->where('type', 'Beban')->sum(fn($a) => $a->journalDetails->sum('debit') - $a->journalDetails->sum('credit'));

        return $pendapatan - $beban;
    }
}
