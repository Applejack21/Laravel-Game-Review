<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function loginForm()
    {
        return view('login/login');
    }
    function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/homepage');
        }
        $request->session()->flash('loginError', "Those details aren't correct");
        return redirect('/login');
    }
}
