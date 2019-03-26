<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => 2,
        ]);
    }
}
