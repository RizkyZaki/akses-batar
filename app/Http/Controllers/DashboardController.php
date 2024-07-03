<?php

namespace App\Http\Controllers;

use App\Models\PersediaanProgram;
use App\Models\PersediaanRutin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalPersediaanRutin = PersediaanRutin::count();
        $totalPersediaanProgram = PersediaanProgram::count();

        return view('pages.dashboard.dashboard', [
        'title' => 'Dashboard',
        'totalPersediaanRutin' => $totalPersediaanRutin, 
        'totalPersediaanProgram' => $totalPersediaanProgram,
        'data' => PersediaanRutin::latest()->get(),
        'data' => PersediaanProgram::latest()->get(),
        ]);
    }
}