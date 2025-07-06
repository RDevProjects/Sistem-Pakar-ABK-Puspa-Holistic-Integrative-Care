<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AturanController;
use App\Http\Controllers\PoinObservasiController;
use App\Http\Controllers\ObservasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthAndRoleMiddleware;
use App\Models\KondisiUser;
use App\Models\Gejala;

Route::middleware([AuthAndRoleMiddleware::class])->group(function () {});

Route::get('/', function () {
    return view('index');
})->name('home');

Route::prefix('/dashboard')->middleware('auth.role:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::prefix('aturan')->group(function () {
        Route::get('/', [AturanController::class, 'index'])->name('aturan.index');
        Route::get('/create', [AturanController::class, 'create'])->name('aturan.create');
        Route::post('/', [AturanController::class, 'store'])->name('aturan.store');
        Route::get('/{id}/edit', [AturanController::class, 'edit'])->name('aturan.edit');
        Route::put('/{id}', [AturanController::class, 'update'])->name('aturan.update');
        Route::delete('/{id}', [AturanController::class, 'destroy'])->name('aturan.destroy');
    });

    Route::prefix('poin-observasi')->group(function () {
        Route::get('/', [PoinObservasiController::class, 'index'])->name('poin_observasi.index');
        Route::get('/create', [PoinObservasiController::class, 'create'])->name('poin_observasi.create');
        Route::post('/', [PoinObservasiController::class, 'store'])->name('poin_observasi.store');
        Route::get('/{id}/edit', [PoinObservasiController::class, 'edit'])->name('poin_observasi.edit');
        Route::put('/{id}', [PoinObservasiController::class, 'update'])->name('poin_observasi.update');
        Route::delete('/{id}', [PoinObservasiController::class, 'destroy'])->name('poin_observasi.destroy');
    });
});

Route::prefix('/dashboard')->middleware('auth.role:admin,user')->group(function () {
    // Route::get('/form', function () {
    //     $data = [
    //         'gejala' => Gejala::all(),
    //         'kondisi_user' => KondisiUser::all()
    //     ];
    //     return view('dashboard.form.index', $data);
    // })->name('form');

    // Route::resource('/spk', DiagnosaController::class);
    // Route::get('/spk/result/{diagnosa_id}', [DiagnosaController::class, 'diagnosaResult'])->name('spk.result');
    // Route::get('/diagnosis', [DiagnosaController::class, 'index'])->name('diagnosis.index');
    Route::get('/observasi', [ObservasiController::class, 'create'])->name('observasi.create');
    Route::post('/observasi/store', [ObservasiController::class, 'store'])->name('observasi.store');
    Route::get('/observasi/data/{id}', [ObservasiController::class, 'result'])->name('observasi.result');
    Route::get('/observasi/download/{id}', [ObservasiController::class, 'download'])->name('observasi.download');
    // User dashboard: riwayat observasi milik user
    Route::get('/observasi/riwayat', [ObservasiController::class, 'userIndex'])->name('observasi.user.index');
});

Route::prefix('/dashboard')->middleware('auth.role:admin')->group(function () {
    // Admin dashboard: semua observasi
    Route::get('/observasi/admin', [ObservasiController::class, 'adminIndex'])->name('observasi.admin.index');
    Route::delete('/observasi/{id}', [ObservasiController::class, 'destroy'])->name('observasi.destroy');
});

Route::prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
});
