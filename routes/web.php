<?php

use App\Http\Controllers\JenisController;
use App\Http\Controllers\PersediaanProgramController;
use App\Http\Controllers\PersediaanRutinController;
use Illuminate\Support\Facades\Route;

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
Route::get('under', function () {
    return view('pages.utils.under', ['title' => 'Dalam Pengembangan']);
});
Route::prefix('dashboard')->group(function () {
    Route::get('overview', function () {
        return view('pages.dashboard.dashboard', ['title' => 'Dashboard']);
    });
    Route::resource('persediaan-rutin', PersediaanRutinController::class);
    Route::resource('persediaan-program', PersediaanProgramController::class);
});
