<?php

namespace App\Http\Controllers;

use App\Models\Formularium;
use App\Models\PersediaanProgram;
use App\Models\PersediaanRutin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalFormularium = Formularium::count();
        $totalPersediaanRutin = PersediaanRutin::count();
        $totalPersediaanProgram = PersediaanProgram::count();

        return view('pages.dashboard.dashboard', [
        'title' => 'Dashboard',
        'totalFormularium' => $totalFormularium, 
        'totalPersediaanRutin' => $totalPersediaanRutin, 
        'totalPersediaanProgram' => $totalPersediaanProgram,
        'data' => Formularium::latest()->get(),
        'data' => PersediaanRutin::latest()->get(),
        'data' => PersediaanProgram::latest()->get(),
        ]);
    }
}