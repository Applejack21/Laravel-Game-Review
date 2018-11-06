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
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/homepage');
        }
        $request->session()->flash('alert-danger', "The username and/or password you entered was incorrect. Please try again.");
        return redirect('/login');
    }
    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
