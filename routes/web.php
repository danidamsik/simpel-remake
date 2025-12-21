<?php
use App\Livewire\PengajuanKegiatan\FormtambahKegiatan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home.index');
})->name('home');

Route::get('/home', function () {
    return view('pages.home.index');
})->name('home.alt');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/pengajuan-kegiatan', function () {
    return view('pages.pengajuan-kegiatan');
});

Route::get('/pengajuan-kegiatan/tambah-kegiatan', FormtambahKegiatan::class);

Route::get('/transaksi', function() {
    return view('pages./transaksi');
});

Route::get('/laporan-rekap', function () {
    return view('pages.laporan-rekap');
});

Route::get('/master-data', function () {
    return view('pages.master-data');
});

Route::get('/profile', function () {
    return view('pages.my-profile');
});

