<?php

use App\Livewire\Auth\Login;
use App\Livewire\PengajuanKegiatan\FormtambahKegiatan;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::middleware(['auth', 'role:Bendahara'])->group(function () {
    Route::get('/', function () {
        return view('pages.home.index');
    });

    Route::get('/home', function () {
        return view('pages.home.index');
    })->name('home');

    Route::get('/my-profile', function () {
        return view('pages.home.user-profile');
    })->name('home.profile');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');

    Route::get('/pengajuan-kegiatan', function () {
        return view('pages.admin.pengajuan-kegiatan');
    })->name('pengajuan-kegiatan');

    Route::get('/pengajuan-kegiatan/tambah-kegiatan', FormtambahKegiatan::class)->name('pengajuan-kegiatan.tambah');

    Route::get('/transaksi', function () {
        return view('pages.admin.transaksi');
    })->name('transaksi');

    Route::get('/laporan-rekap', function () {
        return view('pages.admin.laporan-rekap');
    })->name('laporan-rekap');

    Route::get('/master-data', function () {
        return view('pages.admin.master-data');
    })->name('master-data');

    Route::get('/profile', function () {
        return view('pages.admin.my-profile');
    })->name('profile');
});

Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout')->middleware('auth');
