<?php

use App\Enums\UserRole;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\FormulariumController;
use App\Http\Controllers\PersediaanProgramController;
use App\Http\Controllers\PersediaanRutinController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersediaanController;
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
Route::get('/', [DashboardController::class, 'index'], function () {
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
    Route::get('overview', [DashboardController::class, 'index'], function () {
      return view('pages.dashboard.dashboard', ['title' => 'Dashboard']);
    })->name('ds');
    Route::resource('formularium', FormulariumController::class);
    Route::post('formularium/filter', [FormulariumController::class, 'filter']);
    Route::prefix('persediaan')->group(function () {
      route::get('get', [PersediaanController::class, 'getData']);
      Route::get('gudang', [PersediaanController::class, 'index']);
      Route::get('gudang/{id}/edit', [PersediaanController::class, 'edit']);
      Route::post('gudang', [PersediaanController::class, 'store']);
      Route::post('gudang/{id}', [PersediaanController::class, 'update']);
      Route::delete('gudang/{id}', [PersediaanController::class, 'destroy']);
      Route::post('gudang/stok', [PersediaanController::class, 'gudangStok']);
      Route::get('pelayanan', [PersediaanController::class, 'pelayanan']);
      Route::post('pelayanan/stok', [PersediaanController::class, 'pelayananStok']);
    });
    Route::middleware(['auth', 'role:' . UserRole::Pharmacy_Management])->group(function () {
      Route::resource('users', UserController::class);
    });
  });
});
