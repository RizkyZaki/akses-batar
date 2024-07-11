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

        return view('pages.dashboard.dashboard', [
            'title' => 'Dashboard',
            'totalFormularium' => $totalFormularium,
            'data' => Formularium::latest()->get(),
        ]);
    }
}
