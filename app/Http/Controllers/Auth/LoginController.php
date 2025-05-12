<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! auth()->attempt($credentials)) {
            return back()
                ->with([
                    'message' => 'Invalid Credentials'
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }
}
