<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// KENDARAAN
Route::prefix('kendaraan')->name('kendaraan.')->group(function () {
    Route::get('/', [KendaraanController::class, 'index'])->name('index');
    Route::get('/create', [KendaraanController::class, 'create'])->name('create');
    Route::post('/', [KendaraanController::class, 'store'])->name('store');
    Route::get('/{kendaraan}/edit', [KendaraanController::class, 'edit'])->name('edit');
    Route::put('/{kendaraan}', [KendaraanController::class, 'update'])->name('update');
    Route::delete('/{kendaraan}', [KendaraanController::class, 'destroy'])->name('destroy');
});

// PELANGGAN
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/', [PelangganController::class, 'index'])->name('index');
    Route::get('/create', [PelangganController::class, 'create'])->name('create');
    Route::post('/', [PelangganController::class, 'store'])->name('store');
    Route::get('/{pelanggan}/edit', [PelangganController::class, 'edit'])->name('edit');
    Route::put('/{pelanggan}', [PelangganController::class, 'update'])->name('update');
    Route::delete('/{pelanggan}', [PelangganController::class, 'destroy'])->name('destroy');
});

// TRANSAKSI
Route::prefix('transaksi')->name('transaksi.')->group(function () {
    Route::get('/', [TransaksiController::class, 'index'])->name('index');
    Route::get('/create', [TransaksiController::class, 'create'])->name('create');
    Route::post('/', [TransaksiController::class, 'store'])->name('store');
    Route::get('/{transaksi}', [TransaksiController::class, 'show'])->name('show');
    Route::get('/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('edit');
    Route::put('/{transaksi}', [TransaksiController::class, 'update'])->name('update');
    Route::post('/{transaksi}/bayar', [TransaksiController::class, 'bayar'])->name('bayar');
    Route::delete('/{transaksi}', [TransaksiController::class, 'destroy'])->name('destroy');
});

// PENGEMBALIAN
Route::prefix('pengembalian')->name('pengembalian.')->group(function () {
    Route::get('/', [PengembalianController::class, 'index'])->name('index');
    Route::get('/create', [PengembalianController::class, 'create'])->name('create');
    Route::post('/', [PengembalianController::class, 'store'])->name('store');
    Route::get('/{pengembalian}/edit', [PengembalianController::class, 'edit'])->name('edit');
    Route::put('/{pengembalian}', [PengembalianController::class, 'update'])->name('update');
    Route::delete('/{pengembalian}', [PengembalianController::class, 'destroy'])->name('destroy');
});

// Route untuk reset semua data (tombol darurat untuk testing)
Route::post('/reset', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true]);
    return redirect('/')->with('success', 'Database berhasil direset dan di-seed ulang');
})->name('reset');
