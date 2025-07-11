<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountingPeriodController;
use App\Http\Controllers\CashBankController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SupplierController;



Route::get('/', function () {
    return view('frontend');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('accounts', AccountController::class);
    Route::resource('journals', JournalEntryController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('siswa', SiswaController::class);
    Route::post('transaksi/reset', [JournalEntryController::class,'reset_transaksi'])->name('transaksi.reset');
    
    Route::get('laporan/jurnal-umum', [ReportController::class, 'jurnalUmum'])->name('laporan.jurnal-umum');
    Route::get('laporan/neraca-saldo', [ReportController::class, 'trialBalance'])->name('laporan.neraca-saldo');
    Route::get('laporan/laba-rugi', [ReportController::class, 'incomeStatement'])->name('laporan.laba-rugi');
    Route::get('neraca-saldo', [ReportController::class, 'trialBalance'])->name('laporan.neraca-saldo');
    Route::get('laba-rugi', [ReportController::class, 'incomeStatement'])->name('laporan.laba-rugi');
    Route::get('neraca', [ReportController::class, 'balanceSheet'])->name('laporan.neraca');
    Route::get('perubahan-modal', [ReportController::class, 'equityChange'])->name('laporan.perubahan-modal');
    Route::get('arus-kas', [ReportController::class, 'cashFlow'])->name('laporan.arus-kas');

    Route::get('/journals/penyesuaian/index', [JournalEntryController::class, 'indexPenyesuaian'])->name('journals.penyesuaian');
    Route::post('/journals/penyesuaian/store', [JournalEntryController::class, 'storePenyesuaian'])->name('journals.penyesuaian.store');

    Route::get('/journals/penutup/index', [JournalEntryController::class, 'indexPenutup'])->name('journals.penutup');
    Route::post('/journals/penutup/store', [JournalEntryController::class, 'storePenutup'])->name('journals.penutup.store');

    Route::get('/buku-besar', [LedgerController::class, 'index'])->name('ledger.index');

    Route::get('/kas-bank', [CashBankController::class, 'index'])->name('cashbank.index');
    Route::post('/kas-bank', [CashBankController::class, 'store'])->name('cashbank.store');

    Route::resource('/periode-akuntansi', AccountingPeriodController::class)->except(['show']);
    Route::resource('units', UnitController::class);

});
