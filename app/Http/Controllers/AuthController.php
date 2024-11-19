<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        Auth::logout();
        return view('auth.login');
    }

    public function store(Request $request){
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin');
            }
            return redirect()->route('home');
        }

        return redirect()->route('login')->with('error', 'Data tidak ada di database');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('login')->with('success', 'Berhasil Keluar');
    }
}
