<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\TiketController;
use App\Http\Controllers\admin\TiketSoldController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/', [TiketController::class, 'index'])->name('tiket');
    Route::get('/', [UserController::class, 'index'])->name('dashboardUser');
    Route::prefix('dashboard')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('dashboardAdmin');
    });
    Route::prefix('tiket')->group(function() {
        Route::get('/', [TiketController::class, 'index'])->name('tiket');
        Route::post('/store', [TiketController::class, 'store'])->name('tiketStore');
        Route::delete('/destroy/{id}', [TiketController::class, 'destroy'])->name('deleteTiket');
        Route::get('/terjual', [TiketSoldController::class, 'index'])->name('tiket-terjual');
        Route::get('/checkin', [TiketController::class, 'checkin'])->name('tiket-checkin');
    });
    Route::prefix('user')->group(function() {
        Route::post('/create', [UserController::class, 'storeTiket'])->name('buyTiket');
    });
});