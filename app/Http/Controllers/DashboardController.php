<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\PoinObservasi;
use App\Models\HasilObservasi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $aturan = Aturan::count();
        $poin = PoinObservasi::count();
        $hasil = HasilObservasi::count();
        $dataHasil = HasilObservasi::all();

        $users = User::where('role', 'user')->Count();
        return view('dashboard.index', compact('aturan', 'poin', 'hasil', 'dataHasil', 'users'));
    }

    public function profile()
    {
        return view('dashboard.profile');
    }
}
