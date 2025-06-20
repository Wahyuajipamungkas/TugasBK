<?php

use App\Http\Controllers\dokter\DokterProfilDokterController;
use App\Http\Controllers\dokter\JedwalPeriksaController;
use App\Http\Controllers\dokter\ObatController;
use App\Http\Controllers\dokter\MemeriksaController;
use App\Http\Controllers\dokter\ProfilDokterController;
use App\Http\Controllers\pasien\JanjiPeriksaController;
use App\Http\Controllers\pasien\RiwayatPeriksaController;
use App\Http\Controllers\pasien\PasienProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () { return view('dokter.dashboard');})->name('dokter.dashboard');
    Route::prefix('obat')->group(function(){
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('//create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
        Route::get('/{id}/restore', [ObatController::class, 'restore'])->name('dokter.obat.restore');
        Route::get('/trash', [ObatController::class, 'trashobat'])->name('dokter.obat.trash');
    });
    Route::prefix('jadwal_periksa')->group(function(){
        Route::get('/',[JedwalPeriksaController::class, 'index'])->name('dokter.jadwal_periksa.index');
        Route::get('/create',[JedwalPeriksaController::class, 'create'])->name('dokter.jadwal_periksa.create');
        Route::patch('/jadwal_periksa/{id}/toggle_status', [JedwalPeriksaController::class, 'toggleStatus'])->name('dokter.jadwal_periksa.toggleStatus');
        Route::post('/', [JedwalPeriksaController::class, 'store'])->name('dokter.jadwal_periksa.store');
        Route::delete('/jadwal_periksa/{id}', [JedwalPeriksaController::class, 'destroy'])->name('dokter.jadwal_periksa.destroy');
    });

    Route::prefix('memeriksa')->group(function(){
        Route::get('/',[MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
        Route::post('/{id}',[MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
        Route::match(['get', 'post'], 'dokter/memeriksa/periksa/{id}', [MemeriksaController::class, 'periksa'])->name('dokter.memeriksa.periksa');
        Route::get('/{id}/edit',[MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
        Route::post('/{id}/update',[MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
    });
    Route::prefix('profil')->group(function(){
        Route::get('/', [DokterProfilDokterController::class, 'edit'])->name('dokter.profile.edit');
        Route::patch('/', [DokterProfilDokterController::class, 'update'])->name('dokter.profile.update');
        Route::delete('/', [DokterProfilDokterController::class, 'destroy'])->name('dokter.profile.destroy');
    });
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    // dd(Auth::user());
    Route::get('/dashboard', function () {return view('pasien.dashboard');})->name('pasien.dashboard');
    Route::prefix('janji_periksa')->group(function(){
        Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji_periksa.index');
        Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji_periksa.store');
    });
    Route::prefix('riwayat_periksa')->group(function(){
        Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayat_periksa.index');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayat_periksa.detail');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayat_periksa.riwayat');
    });
    Route::prefix('profil')->group(function(){
        Route::get('/', [PasienProfileController::class, 'edit'])->name('pasien.profile.edit');
        Route::patch('/', [PasienProfileController::class, 'update'])->name('pasien.profile.update');
        Route::delete('/', [PasienProfileController::class, 'destroy'])->name('pasien.profile.destroy');
    });
});


require __DIR__.'/auth.php';
