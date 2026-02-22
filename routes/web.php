<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/api/desas/{kecamatan}', function ($kecamatan) {
    return \App\Models\Desa::where('kecamatan', $kecamatan)->orderBy('nama_desa')->get(['id', 'nama_desa', 'kode_desa']);
});

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store']);

Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'store'])->name('password.store');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/laporan/buat', [App\Http\Controllers\DashboardController::class, 'createReport'])->middleware(['auth'])->name('dashboard.laporan.buat');
Route::delete('/dashboard/laporan/{id}', [App\Http\Controllers\DashboardController::class, 'destroyLaporan'])->middleware(['auth'])->name('dashboard.laporan.destroy');
Route::post('/dashboard/laporan/simpan', [App\Http\Controllers\DashboardController::class, 'storeReport'])->middleware(['auth'])->name('dashboard.laporan.simpan');
Route::post('/dashboard/laporan/{id}/setujui', [App\Http\Controllers\DashboardController::class, 'approveLaporan'])->middleware(['auth'])->name('dashboard.laporan.approve');
Route::post('/dashboard/laporan/{id}/tolak', [App\Http\Controllers\DashboardController::class, 'rejectLaporan'])->middleware(['auth'])->name('dashboard.laporan.reject');
Route::get('/dashboard/laporan/{id}', [App\Http\Controllers\DashboardController::class, 'showLaporan'])->middleware(['auth'])->name('dashboard.laporan.detail');
Route::get('/dashboard/desa/{id}', [App\Http\Controllers\DashboardController::class, 'showDesa'])->middleware(['auth'])->name('dashboard.desa.detail');
Route::post('/dashboard/desa/{id}/toggle-wisata', [App\Http\Controllers\DashboardController::class, 'toggleWisata'])->middleware(['auth'])->name('dashboard.desa.toggle-wisata');
Route::get('/dashboard/dpmd/edit-profil', [App\Http\Controllers\DashboardController::class, 'editDpmdProfile'])->middleware(['auth'])->name('dashboard.dpmd.edit-profil');
Route::post('/dashboard/dpmd/update-profil', [App\Http\Controllers\DashboardController::class, 'updateDpmdProfile'])->middleware(['auth'])->name('dashboard.dpmd.update-profil');
Route::delete('/dashboard/dpmd/gallery/{id}', [App\Http\Controllers\DashboardController::class, 'destroyDpmdGallery'])->middleware(['auth'])->name('dashboard.dpmd.gallery.destroy');

Route::get('/dashboard/pesans', [App\Http\Controllers\DashboardController::class, 'indexPesans'])->middleware(['auth'])->name('dashboard.pesans');
Route::get('/dashboard/pesans/{id}', [App\Http\Controllers\DashboardController::class, 'showPesan'])->middleware(['auth'])->name('dashboard.pesans.detail');
Route::post('/dashboard/pesans/{id}/reply', [App\Http\Controllers\DashboardController::class, 'replyPesan'])->middleware(['auth'])->name('dashboard.pesans.reply');
Route::delete('/dashboard/pesans/{id}', [App\Http\Controllers\DashboardController::class, 'destroyPesan'])->middleware(['auth'])->name('dashboard.pesans.destroy');


Route::get('/dashboard/beritas', [App\Http\Controllers\BeritaController::class, 'index'])->middleware(['auth'])->name('dashboard.beritas.index');
Route::get('/dashboard/beritas/create', [App\Http\Controllers\BeritaController::class, 'create'])->middleware(['auth'])->name('dashboard.beritas.create');
Route::post('/dashboard/beritas/store', [App\Http\Controllers\BeritaController::class, 'store'])->middleware(['auth'])->name('dashboard.beritas.store');
Route::get('/dashboard/beritas/{id}/edit', [App\Http\Controllers\BeritaController::class, 'edit'])->middleware(['auth'])->name('dashboard.beritas.edit');
Route::post('/dashboard/beritas/{id}/update', [App\Http\Controllers\BeritaController::class, 'update'])->middleware(['auth'])->name('dashboard.beritas.update');
Route::delete('/dashboard/beritas/{id}/delete', [App\Http\Controllers\BeritaController::class, 'destroy'])->middleware(['auth'])->name('dashboard.beritas.destroy');

Route::get('/dashboard/profil-desa/edit', [App\Http\Controllers\DashboardController::class, 'editDesa'])->middleware(['auth'])->name('dashboard.desa.edit');
Route::post('/dashboard/profil-desa/update', [App\Http\Controllers\DashboardController::class, 'updateDesa'])->middleware(['auth'])->name('dashboard.desa.update');
Route::delete('/dashboard/profil-desa/gallery/{id}', [App\Http\Controllers\DashboardController::class, 'destroyGallery'])->middleware(['auth'])->name('dashboard.desa.gallery.destroy');

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.regulasi.')->group(function () {
    Route::get('/regulasi', [App\Http\Controllers\RegulasiController::class, 'index'])->name('index');
    Route::post('/regulasi', [App\Http\Controllers\RegulasiController::class, 'store'])->name('store');
    Route::get('/regulasi/{regulasi}/edit', [App\Http\Controllers\RegulasiController::class, 'edit'])->name('edit');
    Route::patch('/regulasi/{regulasi}', [App\Http\Controllers\RegulasiController::class, 'update'])->name('update');
    Route::delete('/regulasi/{regulasi}', [App\Http\Controllers\RegulasiController::class, 'destroy'])->name('destroy');
    Route::get('/regulasi/{regulasi}/download', [App\Http\Controllers\RegulasiController::class, 'download'])->name('download');
});

Route::middleware(['auth'])->prefix('dashboard')->name('pengumuman.')->group(function () {
    Route::get('/pengumuman', [App\Http\Controllers\PengumumanController::class, 'index'])->name('index');
    Route::post('/pengumuman', [App\Http\Controllers\PengumumanController::class, 'store'])->name('store');
    Route::delete('/pengumuman/{pengumuman}', [App\Http\Controllers\PengumumanController::class, 'destroy'])->name('destroy');
    Route::post('/pengumuman/{pengumuman}/toggle', [App\Http\Controllers\PengumumanController::class, 'toggle'])->name('toggle');
});

// Village Management for DPMD
Route::middleware(['auth'])->prefix('dashboard/dpmd/desa')->name('dashboard.dpmd.desa.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Dashboard\DesaManagementController::class, 'index'])->name('index');
    Route::get('/create', [\App\Http\Controllers\Dashboard\DesaManagementController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\Dashboard\DesaManagementController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [\App\Http\Controllers\Dashboard\DesaManagementController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [\App\Http\Controllers\Dashboard\DesaManagementController::class, 'update'])->name('update');
    Route::delete('/{id}', [\App\Http\Controllers\Dashboard\DesaManagementController::class, 'destroy'])->name('destroy');
});

// Public Pages Routes
Route::prefix('jelajah')->group(function () {
    Route::get('/desa-wisata', [App\Http\Controllers\Public\DesaController::class, 'desaWisata'])->name('public.desa-wisata');
    Route::get('/desa/{id}', [App\Http\Controllers\Public\DesaController::class, 'showProfil'])->name('public.desa.profil');
    Route::get('/kuliner', [App\Http\Controllers\Public\DesaController::class, 'kuliner'])->name('public.kuliner');
    Route::get('/komoditi', [App\Http\Controllers\Public\DesaController::class, 'komoditi'])->name('public.komoditi');
    Route::get('/kerajinan', [App\Http\Controllers\Public\DesaController::class, 'kerajinan'])->name('public.kerajinan');
    Route::get('/event', [App\Http\Controllers\Public\DesaController::class, 'event'])->name('public.event');
});

Route::get('/potensi-wisata', [App\Http\Controllers\Public\DesaController::class, 'potensiWisata'])->name('public.potensi-wisata');
Route::get('/layanan/kontak', [App\Http\Controllers\Public\DesaController::class, 'kontak'])->name('public.kontak');
Route::post('/layanan/kontak/submit', [App\Http\Controllers\Public\DesaController::class, 'submitKontak'])->name('public.kontak.submit');
Route::get('/berita', [App\Http\Controllers\Public\DesaController::class, 'berita'])->name('public.berita');
Route::get('/berita/{slug}', [App\Http\Controllers\Public\DesaController::class, 'showBerita'])->name('public.berita.detail');
Route::get('/profil', [App\Http\Controllers\Public\DesaController::class, 'profil'])->name('public.profil');
Route::get('/laporan-desa', [App\Http\Controllers\Public\DesaController::class, 'laporanDesa'])->name('public.laporan-desa');

Route::prefix('layanan')->group(function () {
    Route::get('/panduan', [App\Http\Controllers\Public\DesaController::class, 'panduan'])->name('public.panduan');
    Route::get('/kontak', [App\Http\Controllers\Public\DesaController::class, 'kontak'])->name('public.kontak');
    Route::get('/galeri-video', [App\Http\Controllers\Public\DesaController::class, 'videoGallery'])->name('public.video-gallery');
    Route::get('/bank-data', [App\Http\Controllers\RegulasiController::class, 'publicIndex'])->name('public.bank-data');
});

Route::middleware(['auth'])->prefix('dashboard/dokumen')->name('dashboard.dokumen.')->group(function () {
    Route::get('/', [App\Http\Controllers\Dashboard\DokumenController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Dashboard\DokumenController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Dashboard\DokumenController::class, 'store'])->name('store');
    Route::get('/{id}/download', [App\Http\Controllers\Dashboard\DokumenController::class, 'download'])->name('download');
    Route::delete('/{id}', [App\Http\Controllers\Dashboard\DokumenController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth'])->prefix('dashboard/potensi')->name('dashboard.potensi.')->group(function () {
    Route::get('/', [App\Http\Controllers\Dashboard\PotensiController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Dashboard\PotensiController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\Dashboard\PotensiController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\Dashboard\PotensiController::class, 'edit'])->name('edit');
    Route::post('/{id}/update', [App\Http\Controllers\Dashboard\PotensiController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\Dashboard\PotensiController::class, 'destroy'])->name('destroy');
    Route::delete('/gallery/{id}', [App\Http\Controllers\Dashboard\PotensiController::class, 'destroyGallery'])->name('gallery.destroy');
});

