<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(){
        return view('pages.register-v3');
    }

    public function prosesRegister(){

    }

    public function login(){
        return view('pages.login-v3');
    }

    public function prosesLogin(){
        
    }
}
