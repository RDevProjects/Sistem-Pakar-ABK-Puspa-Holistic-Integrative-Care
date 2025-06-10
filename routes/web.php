<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\JenisAbkController;
use App\Http\Controllers\ObservasiController;
use App\Http\Middleware\AuthAndRoleMiddleware;
use App\Models\KondisiUser;
use App\Models\Gejala;

Route::middleware([AuthAndRoleMiddleware::class])->group(function () {});

Route::get('/', function () {
    return view('index');
})->name('home');

Route::prefix('/dashboard')->middleware('auth.role:admin')->group(function () {
    // Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    // Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    // Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Route::prefix('/user')->group(function () {
    //     Route::get('/', [UserController::class, 'index'])->name('user.index');
    //     Route::post('/store', [UserController::class, 'store'])->name('user.store');
    //     Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
    //     Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    //     Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
    //     Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    // });

    // Route::prefix('/gejala')->group(function () {
    //     Route::get('/', [GejalaController::class, 'index'])->name('gejala.index');
    //     Route::post('/store', [GejalaController::class, 'store'])->name('gejala.store');
    //     Route::get('/show/{id}', [GejalaController::class, 'show'])->name('gejala.show');
    //     Route::get('/edit/{id}', [GejalaController::class, 'edit'])->name('gejala.edit');
    //     Route::put('/update/{id}', [GejalaController::class, 'update'])->name('gejala.update');
    //     Route::delete('/destroy/{id}', [GejalaController::class, 'destroy'])->name('gejala.destroy');
    // });

    // Route::prefix('/jenis-abk')->group(function () {
    //     Route::get('/', [JenisAbkController::class, 'index'])->name('jenis-abk.index');
    //     Route::post('/store', [JenisAbkController::class, 'store'])->name('jenis-abk.store');
    //     Route::get('/show/{id}', [JenisAbkController::class, 'show'])->name('jenis-abk.show');
    //     Route::get('/edit/{id}', [JenisAbkController::class, 'edit'])->name('jenis-abk.edit');
    //     Route::put('/update/{id}', [JenisAbkController::class, 'update'])->name('jenis-abk.update');
    //     Route::delete('/destroy/{id}', [JenisAbkController::class, 'destroy'])->name('jenis-abk.destroy');
    // });
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
    Route::get('/observasi/create', [ObservasiController::class, 'create'])->name('observasi.create');
    Route::post('/observasi/store', [ObservasiController::class, 'store'])->name('observasi.store');
    Route::get('/observasi/result/{id}', [ObservasiController::class, 'result'])->name('observasi.result');
});


Route::prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
});
