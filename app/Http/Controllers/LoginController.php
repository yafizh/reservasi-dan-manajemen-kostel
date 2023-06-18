<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

        return redirect('/login')->with('failed', 'Username atau Password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function changePassword() {
        return view('dashboard.pages.change-password.index');
    }

    public function updatePassword(Request $request) {
        $validatedData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required',
        ]);

        if (!$this->cekPasswordLama($validatedData['old_password'])) {
            throw ValidationException::withMessages(['old_password' => 'Password Lama Salah']);
        }

        if (!$this->cekPasswordBaru($validatedData['new_password'], $validatedData['confirm_new_password'])) {
            throw ValidationException::withMessages(['new_password' => 'Password Baru Tidak Sama']);
        }

        User::where('id', Auth::user()->id)->update([
            'password' => bcrypt($validatedData['new_password']),
        ]);

        return back()->with('success', 'Berhasil Ganti Password!');
    }

    public function cekPasswordLama($password_lama)
    {
        return Hash::check($password_lama, auth()->user()->password);
    }

    public function cekPasswordBaru($password1, $password2)
    {
        return $password1 === $password2;
    }
}
