<?php

use App\Http\Controllers\ResepObatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PembayaranSewaController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PendaftaranPasienController;
use App\Http\Controllers\PemeriksaanDokterController;
use App\Http\Controllers\PemeriksaanLaboratoriumController;
use App\Http\Controllers\RekamMedisController;
use App\Models\Kamar;
use App\Models\Penyewa;

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
    Route::resource('penyewa', PenyewaController::class);
    Route::resource('kamar', KamarController::class);
    Route::resource('poli', PoliController::class);
    
    Route::resource('pendaftaranpasien', PendaftaranPasienController::class);
    Route::resource('pemeriksaandokter', PemeriksaanDokterController::class);
    Route::resource('resepobat', ResepObatController::class);
    Route::resource('pemeriksaanlaboratorium', PemeriksaanLaboratoriumController::class);
    Route::resource('pembayaran_sewa', PembayaranSewaController::class);
    Route::resource('rekammedis', RekamMedisController::class);

   

});