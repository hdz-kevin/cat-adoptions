<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'username' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-zA-Z0-9_-]+$/',
                'unique:users,username',
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.regex' => 'Invalid format (letters, numbers, - and _ only)',
        ]);

        User::create([
            ...$data,
            'password' => bcrypt($data['password']),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('home');
    }
}
