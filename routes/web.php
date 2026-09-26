<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home.public');

Route::get('/berita', [BeritaController::class, 'list'])->name('berita.list');
Auth::routes(['register' => false]);

/*
|--------------------------------------------------------------------------
| Post-Login Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin'    => redirect()->route('admin.dashboard'),
        'operator' => redirect()->route('operator.dashboard'),
        default    => redirect()->route('login'),
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
});
