<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->status == 1)
                return redirect()->intended('/admin');

            if (Auth::user()->status == 2)
                return redirect()->intended('/reservations');
        }

        return back()->with('failed', 'Username atau Password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
