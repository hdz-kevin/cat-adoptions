<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cats = Cat::where('is_adopted', '=', false)->paginate(12);

        return view('home', compact('cats'));
    }
}
