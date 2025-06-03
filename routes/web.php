<?php

use App\Http\Controllers\dokter\JedwalPeriksaController;
use App\Http\Controllers\dokter\ObatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () { return view('dokter.dashboard');})->name('dokter.dashboard');
    Route::prefix('obat')->group(function(){
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('//create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/{id}/edit', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::patch('/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });
    Route::prefix('jadwal_periksa')->group(function(){
        Route::get('/',[JedwalPeriksaController::class, 'index'])->name('dokter.jadwal_periksa.index');
        Route::get('/create',[JedwalPeriksaController::class, 'create'])->name('dokter.jadwal_periksa.create');
        Route::patch('/jadwal_periksa/{id}/toggle_status', [JedwalPeriksaController::class, 'toggleStatus'])->name('dokter.jadwal_periksa.toggleStatus');
        Route::post('/', [JedwalPeriksaController::class, 'store'])->name('dokter.jadwal_periksa.store');
        Route::delete('/jadwal_periksa/{id}', [JedwalPeriksaController::class, 'destroy'])->name('dokter.jadwal_periksa.destroy');
    });
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    // dd(Auth::user());
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
});


require __DIR__.'/auth.php';
