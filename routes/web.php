<?php

use App\Enums\UserRole;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\FormulariumController;
use App\Http\Controllers\PersediaanProgramController;
use App\Http\Controllers\PersediaanRutinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\PersediaanRutin;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('dashboard', ['title' => 'Dashboard']);
// });


// Route::get('/formularium', function () {
//     return view('pages.formularium.formularium', ['title' => 'Formularium']);
// });

// Route::get('/persediaan-rutin', function () {
//     return view('pages.persediaan-rutin.persediaan-rutin', ['title' => 'Persediaan Rutin']);
// });

// Route::get('/persediaan-program', function () {
//     return view('pages.persediaan-program.persediaan-program', ['title' => 'Persediaan Program']);
// });

// Route::get('/farmasi-klinis', function () {
//     return view('pages.farmasi-klinis.farmasi-klinis', ['title' => 'Farmasi Klinis']);
// });
// Route::get('/reports-program-data', function () {
//     return view('pages.laporan.laporan-program-data', ['title' => 'Laporan Program Data']);
// });
// Route::get('/reports-program', function () {
//     return view('pages.laporan.laporan-program', ['title' => 'Laporan Program']);
// });
// Route::get('/reports-rutin', function () {
//     return view('pages.laporan.laporan-rutin', ['title' => 'Laporan Rutin']);
// });


// NEW ROUTEE
Route::get('/',[DashboardController::class, 'index'], function () {
    return view('pages.dashboard.dashboard', ['title' => 'Dashboard']);
});
// Route::get('dashboard', [PersediaanRutinController::class, 'dashboard'])->name('dashboard');

Route::get('under', function () {
    return view('pages.utils.under', ['title' => 'Dalam Pengembangan']);
});
Route::get('logout', [AuthController::class, 'logout']);
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticated']);
});
Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('overview',[DashboardController::class, 'index'], function () {
            return view('pages.dashboard.dashboard', ['title' => 'Dashboard']);
        })->name('ds');
        Route::resource('formularium', FormulariumController::class);
        Route::resource('persediaan-rutin', PersediaanRutinController::class);
        Route::resource('persediaan-program', PersediaanProgramController::class);
        Route::post('formularium/filter', [FormulariumController::class, 'filter']);
        Route::post('persediaan-rutin/filter', [PersediaanRutinController::class, 'filter']);
        Route::post('persediaan-program/filter', [PersediaanProgramController::class, 'filter']);
        Route::middleware(['auth', 'role:' . UserRole::Pharmacy_Management])->group(function () {
            Route::resource('users', UserController::class);
        });
    });
});