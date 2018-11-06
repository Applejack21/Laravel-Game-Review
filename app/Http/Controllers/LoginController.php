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
    function registerForm()
    {
        return view('login/register');
    }
    function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'username' => 'required|unique:users|min:3|max:10',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ],
        [
            'first_name.required' => 'First Name: Make sure you\'ve filled out your first name.',
            'first_name.max' => 'First Name: The maximum length your first name can be is 191 characters.',
            
            'last_name.required' => 'Last Name: Make sure you\'ve filled out your last name.',
            'last_name.max' => 'Last Name: The maximum length your last name can be is 191 characters.',
            
            'username.required' => 'Username: Make sure you\'ve filled out your username.',
            'username.max' => 'Username: The maximum length your username can be is 10 characters. Please shorten this to fit this requirement.',
            'username.unique' => 'Username: An account linked to that username has already been created.',
            
            'email.required' => 'Email: Make sure you\'ve filled out your email address.',
            'email.max' => 'Email: The maximum length your email address can be is 191 characters.',
            'email.unique' => 'Email: An account linked to that email has alredy been created.',
            
            'password.required' => 'Password: Make sure you\'ve entered a password.',
            'password.min' => 'Password: Your password must be between 8-15 characters',
            'password.max' => 'Password: Your password cannot exceed 15 characters in length.',
            'password.regex' => 'Password: Your password needs to contain at least one uppercase/lowercase letters and one number.',
            'password.confirmed' => 'Password: Make sure the passwords match each other.',
        ]
        );
        
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 2;
        $user->save();
        $request->session()->flash('alert-success', "Thank you for registering. Please login through the link above.");
        return redirect('register');
    }
}
