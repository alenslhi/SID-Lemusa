<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public Portal Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil-desa', [HomeController::class, 'profil'])->name('profil.index');
Route::get('/layanan-publik', [HomeController::class, 'layanan'])->name('layanan.index');
Route::get('/kabar-desa', [HomeController::class, 'beritaIndex'])->name('berita.index');
Route::get('/kabar-desa/{slug}', [HomeController::class, 'beritaShow'])->name('berita.show');

// Auth Routes
Route::get('/admin/login', \App\Livewire\Auth\Login::class)->name('login');
Route::post('/admin/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Secure File Download Route for private disks
Route::get('/download/{path}', [\App\Http\Controllers\FileDownloadController::class, 'download'])
    ->name('file.download')
    ->where('path', '.*')
    ->middleware('auth');

// Citizen Portal (Warga) Dashboard
Route::get('/warga/dashboard', \App\Livewire\Citizen\Dashboard::class)
    ->name('citizen.dashboard')
    ->middleware('auth');

// Unified Gateway Portal
Route::get('/portal', \App\Livewire\Portal::class)
    ->name('portal')
    ->middleware('auth');

// Custom Admin Dashboard
Route::prefix('admin')
    ->name('desa.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
        
        // Placeholder routes for phase 2
        Route::get('/penduduk', \App\Livewire\Admin\Penduduk\Index::class)->name('penduduk.index');
        Route::get('/penduduk/create', \App\Livewire\Admin\Penduduk\Form::class)->name('penduduk.create');
        Route::get('/penduduk/{id}/edit', \App\Livewire\Admin\Penduduk\Form::class)->name('penduduk.edit');
        Route::get('/keluarga', \App\Livewire\Admin\Keluarga\Index::class)->name('keluarga.index');
        Route::get('/keluarga/create', \App\Livewire\Admin\Keluarga\Form::class)->name('keluarga.create');
        Route::get('/keluarga/{id}/edit', \App\Livewire\Admin\Keluarga\Form::class)->name('keluarga.edit');
        Route::get('/surat', \App\Livewire\Admin\Surat\Index::class)->name('surat.index');
        Route::get('/surat/{id}/edit', \App\Livewire\Admin\Surat\Form::class)->name('surat.edit');
        Route::get('/pengaduan', \App\Livewire\Admin\Pengaduan\Index::class)->name('pengaduan.index');
        Route::get('/pengaduan/{id}/edit', \App\Livewire\Admin\Pengaduan\Form::class)->name('pengaduan.edit');
        
        // Publikasi Web
        Route::get('/berita', \App\Livewire\Admin\Berita\Index::class)->name('berita.index');
        Route::get('/berita/create', \App\Livewire\Admin\Berita\Form::class)->name('berita.create');
        Route::get('/berita/{id}/edit', \App\Livewire\Admin\Berita\Form::class)->name('berita.edit');
        Route::get('/agenda', \App\Livewire\Admin\Agenda\Index::class)->name('agenda.index');
        Route::get('/agenda/create', \App\Livewire\Admin\Agenda\Form::class)->name('agenda.create');
        Route::get('/agenda/{id}/edit', \App\Livewire\Admin\Agenda\Form::class)->name('agenda.edit');
        Route::get('/pengumuman', \App\Livewire\Admin\Pengumuman\Index::class)->name('pengumuman.index');
        Route::get('/pengumuman/create', \App\Livewire\Admin\Pengumuman\Form::class)->name('pengumuman.create');
        Route::get('/pengumuman/{id}/edit', \App\Livewire\Admin\Pengumuman\Form::class)->name('pengumuman.edit');
        Route::get('/galeri', \App\Livewire\Admin\Galeri\Index::class)->name('galeri.index');
        Route::get('/galeri/create', \App\Livewire\Admin\Galeri\Form::class)->name('galeri.create');
        Route::get('/galeri/{id}/edit', \App\Livewire\Admin\Galeri\Form::class)->name('galeri.edit');

        // Master Data
        Route::get('/master-data', \App\Livewire\Admin\Master\Index::class)->name('master.index');
        Route::get('/users', \App\Livewire\Admin\User\Index::class)->name('user.index');
        Route::get('/profil-desa', \App\Livewire\Admin\Profil\Index::class)->name('profil.index');
    });
