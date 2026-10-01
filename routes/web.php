<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FatwaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriFatwaController;
use App\Http\Controllers\KonsultasiAdminController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\Fatwa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'index'])->name('home.public');

Route::get('/berita', [BeritaController::class, 'list'])->name('berita.list');
Route::get('/berita/{slug}', [BeritaController::class, 'detail'])->name('berita.detail');

Route::get('/profil-mui', function () {
    return view('pages.profilemui');
})->name('profilemui');

Route::get('/visi-misi', function () {
    return view('pages.visi-misi');
})->name('visi-misi');

Route::get('/struktur-organisasi', function () {
    return view('pages.struktur-organisasi');
})->name('struktur-organisasi');

Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');

Route::get('/tanya-ulama', [KonsultasiController::class, 'index'])->name('tanya-ulama');
Route::post('/tanya-ulama', [KonsultasiController::class, 'store'])->name('tanya-ulama.store');
Route::get('/konsultasi', [KonsultasiController::class, 'list'])->name('konsultasi.list');
Route::get('/konsultasi/{konsultasi}', [KonsultasiController::class, 'detail'])->name('konsultasi.detail');

Route::get('/fatwa', [FatwaController::class, 'publicList'])->name('fatwa');
Route::post('/fatwa/{fatwa}/baca', [FatwaController::class, 'incrementViews'])->name('fatwa.increment-views');
Route::get('/surat', [SuratController::class, 'publicList'])->name('surat');

Auth::routes(['register' => false]);

/*
|--------------------------------------------------------------------------
| Post-Login Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'operator' => redirect()->route('operator.dashboard'),
        default => redirect()->route('login'),
    };
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users (AJAX CRUD)
    Route::resource('users', UserController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);

    // Berita (Full-page create/edit, AJAX delete, AJAX index)
    Route::resource('berita', BeritaController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->parameters(['berita' => 'berita']);

    Route::resource('kategori', KategoriController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);

    Route::resource('surat', SuratController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);

    // Fatwa (AJAX CRUD + PDF upload)
    Route::resource('fatwa', FatwaController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);
    Route::patch('fatwa/{fatwa}/toggle-publikasi', [FatwaController::class, 'togglePublikasi'])
        ->name('fatwa.togglePublikasi');

    // Kategori Fatwa (AJAX CRUD)
    Route::resource('kategori-fatwa', KategoriFatwaController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);
    Route::patch('kategori-fatwa/{kategori_fatwa}/toggle-status', [KategoriFatwaController::class, 'toggleStatus'])
        ->name('kategori-fatwa.toggleStatus');

    // Konsultasi (View Only)
    Route::get('konsultasi', [KonsultasiAdminController::class, 'index'])->name('konsultasi.index');
    Route::get('konsultasi/{konsultasi}', [KonsultasiAdminController::class, 'show'])->name('konsultasi.show');
});

/*
|--------------------------------------------------------------------------
| Operator Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:operator'])->prefix('operator')->name('operator.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('berita', BeritaController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->parameters(['berita' => 'berita']);

    Route::resource('surat', SuratController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);

    Route::resource('fatwa', FatwaController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);
    Route::patch('fatwa/{fatwa}/toggle-publikasi', [FatwaController::class, 'togglePublikasi'])
        ->name('fatwa.togglePublikasi');

    // Kategori Fatwa (AJAX CRUD)
    Route::resource('kategori-fatwa', KategoriFatwaController::class)->only([
        'index',
        'store',
        'update',
        'destroy',
    ]);
    Route::patch('kategori-fatwa/{kategori_fatwa}/toggle-status', [KategoriFatwaController::class, 'toggleStatus'])
        ->name('kategori-fatwa.toggleStatus');

    // Konsultasi (View + Reply)
    Route::get('konsultasi', [KonsultasiAdminController::class, 'index'])->name('konsultasi.index');
    Route::get('konsultasi/{konsultasi}', [KonsultasiAdminController::class, 'show'])->name('konsultasi.show');
    Route::post('konsultasi/{konsultasi}/jawab', [KonsultasiAdminController::class, 'jawab'])->name('konsultasi.jawab');
    Route::delete('konsultasi/{konsultasi}', [KonsultasiAdminController::class, 'destroy'])->name('konsultasi.destroy');
});
