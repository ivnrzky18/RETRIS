<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\OfficerController; 
use App\Http\Controllers\WargaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OfficerManagementController;
use App\Http\Controllers\Admin\RumahController;

Route::get('/admin/dashboard/cetak', [DashboardController::class, 'cetakLaporan'])->name('admin.dashboard.cetak');

/*
|--------------------------------------------------------------------------
| ROUTE FRONTEND RETRIS
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('frontend');
})->name('home');

Route::get('/register/choose', function () {
    return view('auth.choose-role');
})->name('register.choose');


/*
|--------------------------------------------------------------------------
| LOGIN KHUSUS ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


/*
|--------------------------------------------------------------------------
| AUTH & REDIRECT DASHBOARD BY ROLE
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'petugas' || $role === 'officer') { 
            // Mengarahkan user dengan role petugas ke dashboard officer
            return redirect()->route('officer.dashboard'); 
        } else {
            return redirect()->route('warga.dashboard');
        }
    })->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| OFFICER AREA (DENGAN SCANNER)
|--------------------------------------------------------------------------
*/
// Prefix: URL akan menjadi /officer/...
// Name: Nama rute akan menjadi officer....
Route::middleware(['auth', 'role:petugas'])
    ->prefix('officer')
    ->name('officer.')
    ->group(function () {
        
        // Menampilkan Dashboard Officer
        Route::get('/dashboard', [OfficerController::class, 'index'])->name('dashboard');
        
        // Memproses Scan QR Code
        Route::post('/scan-qr', [OfficerController::class, 'scanQR'])->name('scanQR');
        
        // Memproses Konfirmasi Manual via Tombol
        Route::post('/konfirmasi/{id}', [OfficerController::class, 'konfirmasiManual'])->name('konfirmasi');
});


/*
|--------------------------------------------------------------------------
| WARGA AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga/dashboard', [WargaController::class, 'index'])->name('warga.dashboard');
    Route::post('/warga/bayar-tagihan', [WargaController::class, 'bayarTagihan'])->name('warga.bayar');
    Route::get('/warga/topup', [TopupController::class, 'index'])->name('warga.topup');
    Route::post('/warga/topup', [TopupController::class, 'store'])->name('warga.topup.store');
    Route::get('/warga/profile', [ProfileController::class, 'edit'])->name('warga.profile');
    Route::post('/warga/profile', [ProfileController::class, 'update'])->name('warga.profile.update');
});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/petugas', [OfficerManagementController::class, 'index'])->name('petugas.index');
        Route::get('/rumah', [RumahController::class, 'index'])->name('rumah.index');
        Route::get('/rumah/create', [RumahController::class, 'create'])->name('rumah.create');
        Route::post('/rumah', [RumahController::class, 'store'])->name('rumah.store');
});