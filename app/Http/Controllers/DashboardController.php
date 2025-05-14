<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Models\JenisAbk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $gejala = Gejala::Count();
        $diagnosa = Diagnosa::Count();
        $jenis_abk = JenisAbk::Count();
        $users = User::where('role', 'user')->Count();

        $dataDiagnosis = Diagnosa::all();
        return view('dashboard.index', compact('gejala', 'diagnosa', 'jenis_abk', 'users', 'dataDiagnosis'));
    }

    public function profile()
    {
        return view('dashboard.profile');
    }
}
