<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'cats' => Cat::all()->where('is_adopted', '=', false),
        ]);
    }
}
