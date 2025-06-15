<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KonsumsiController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\JadwalRapatController;
use App\Http\Controllers\ProfileController;

Route::controller(HomeController::class)->group(function () {
    
    // Dashboard
    Route::get('/', 'index')->name('home');
    Route::get('/list-rapat-per-tanggal/{tanggal}', 'listRapatPerTanggal')->name('home.listRapatPerTanggal');
    
    // Autentikasi
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    
    // middleware('auth'): Logout hanya bisa diakses jika sudah login
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('/jadwal-rapat', [JadwalRapatController::class, 'listJadwal'])->name('jadwal-rapat.list_jadwal');
Route::get('/berita/{id}/download', [BeritaAcaraController::class, 'downloadPDF'])->name('berita.download');




/*-----------------------------------------------------
* Routes dibawah ini hanya bisa diakses jika sudah login
*-----------------------------------------------------*/

Route::middleware('auth')->group(function () {

    //form rapat
    Route::get('/rapat', [jadwalRapatController::class, 'index'])->name('rapat');
    Route::post('/jadwal-rapat/store', [JadwalRapatController::class, 'store'])->name('jadwal-rapat.store');
    Route::put('/jadwal-rapat/{id_jadwal}', [JadwalRapatController::class, 'update'])->name('jadwal_rapat.update');
    Route::delete('/jadwal-rapat/{id_jadwal}', [JadwalRapatController::class, 'destroy'])->name('jadwal_rapat.destroy');

    Route::get('/form/rapat', [JadwalRapatcontroller::class, 'create'])->name('form.jadwal');
    
    //form konsumsi
    Route::get('/form/konsumsi', [KonsumsiController::class, 'create'])->name('form.konsumsi');
    Route::post('/form/konsumsi', [KonsumsiController::class, 'store'])->name('konsumsi.store');
    
    //form sarpras
    Route::get('/form/sarpras', [SarprasController::class, 'create'])->name('form.sarpras');
    
    // Simpan semua ke DB
    Route::post('/submit-all', [SarprasController::class, 'submitAll'])->name('submit.all');
    
    // berita
    Route::get('/berita', [BeritaAcaraController::class, 'index'])->name('berita');
    Route::post('/berita', [BeritaAcaraController::class, 'store'])->name('store.berita');

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
});
