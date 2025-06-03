<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KonsumsiController;
use App\Http\Controllers\SarprasController;
use App\Http\Controllers\JadwalRapatController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(SarprasController::class)->prefix('sarpras')->group(function () {
        Route::get('', 'index')->name('sarpras');
        Route::get('create', 'create')->name('sarpras.create');
        Route::post('store', 'store')->name('sarpras.store');
        Route::get('show/{id}', 'show')->name('sarpras.show');
        Route::get('edit/{id}', 'edit')->name('sarpras.edit');
        Route::put('edit/{id}', 'update')->name('sarpras.update');
        Route::delete('destroy/{id}', 'destroy')->name('sarpras.destroy');
    });



    //form rapat
    Route::get('/rapat', [jadwalRapatController::class, 'rapat'])->name('rapat'); 
    Route::post('/jadwal-rapat/store', [JadwalRapatController::class, 'store'])->name('jadwal-rapat.store');
    Route::put('/jadwal-rapat/{id_jadwal}', [JadwalRapatController::class, 'update'])->name('jadwal_rapat.update');
    Route::delete('/jadwal-rapat/{id_jadwal}', [JadwalRapatController::class, 'destroy'])->name('jadwal_rapat.destroy');
    Route::get('/jadwal-rapat', [JadwalRapatController::class, 'index'])->name('jadwal-rapat.index');
    Route::get('/list-rapat-per-tanggal/{tanggal}', [JadwalRapatController::class, 'listRapatPerTanggal'])->name('jadwal-rapat.list-tanggal');
    Route::get('/form/rapat', [JadwalRapatcontroller::class, 'create'])->name('form.jadwal');
    Route::get('/jadwal-rapat', [JadwalRapatController::class, 'index']);
    //form konsumsi
    Route::get('/form/konsumsi', [KonsumsiController::class, 'create'])->name('form.konsumsi');
    Route::post('/form/konsumsi', [KonsumsiController::class, 'store'])->name('konsumsi.store');
    //form sarpras
    Route::get('/form/sarpras', [SarprasController::class, 'create'])->name('form.sarpras');
    // Route::post('/form/sarpras', [SarprasController::class, 'store'])->name('sarpras.store');
    //submit
    Route::post('/submit-all', [SarprasController::class, 'submitAll'])->name('submit.all');
    // berita
    Route::get('/berita', [AuthController::class, 'berita'])->name('berita'); 
    Route::post('/berita', [AuthController::class, 'store'])->name('store.berita'); 
    Route::get('/berita-acara/{id}/download', [AuthController::class, 'downloadPDF'])->name('berita-acara.download');
    Route::get('/berita-acara/{id}', [AuthController::class, 'edit'])->name('berita-acara.edit');
    Route::put('/berita-acara/{id}', [AuthController::class, 'updateBerita'])->name('berita-acara.update');
    Route::delete('/berita-acara/{id}', [AuthController::class, 'destroy'])->name('berita-acara.destroy');
    Route::get('/berita/form', [AuthController::class, 'form'])->name('berita.form');
    //profil
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [App\Http\Controllers\AuthController::class, 'update'])->name('profile.update');
});
