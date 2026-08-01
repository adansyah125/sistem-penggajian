<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/', [AuthController::class, 'index'])->name('login');

    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware(['auth.check'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile/{id}', [ProfleController::class, 'profile'])->name('profile');
    Route::post('/profile/{id}/update', [ProfleController::class, 'update'])->name('profile.update');

    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::post('/karyawan/{id}/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('/karyawan/{id}/delete', [KaryawanController::class, 'destroy'])->name('karyawan.delete');

    Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');
    Route::get('/gaji/{id}/edit', [GajiController::class, 'edit'])->name('gaji.edit');
    Route::post('/gaji/{id}/update', [GajiController::class, 'update'])->name('gaji.update');
    Route::get('/gaji/create', [GajiController::class, 'create'])->name('gaji.create');
    Route::post('/gaji/store', [GajiController::class, 'store'])->name('gaji.store');
    Route::get('/gaji/{id}/delete', [GajiController::class, 'destroy'])->name('gaji.delete');
    Route::get('/gaji/cetak/{id}', [GajiController::class, 'cetak'])->name('gaji.cetak');
    Route::get('/gaji/cetak_all', [GajiController::class, 'cetak_all'])->name('gaji.cetak_all');
    Route::get('/gaji/{id}/delete', [GajiController::class, 'destroy'])->name('gaji.delete');

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/{id}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
    Route::post('/absensi/{id}/update', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::get('/absensi/{id}/delete', [AbsensiController::class, 'destroy'])->name('absensi.delete');
    Route::get('/absensi/{idKaryawan}/week/{mingguMulai}/delete', [AbsensiController::class, 'destroyWeek'])->name('absensi.delete.week');
    Route::get('/absensi/export/excel', [AbsensiController::class, 'export'])->name('absensi.export');
    Route::get('absensi-export', [AbsensiController::class, 'export_excel'])->name('absensi.export_excel');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});
