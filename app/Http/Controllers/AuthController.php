<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('pages.register-v3');
    }

    public function prosesRegister()
    {
    }

    public function login()
    {
        return view('pages.login-v3');
    }

    public function loginProses(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('/dashboard'); // Ganti dengan rute yang sesuai
        }

        return back()->with('errorLogin', 'Email or password invalid !');
    }
}
