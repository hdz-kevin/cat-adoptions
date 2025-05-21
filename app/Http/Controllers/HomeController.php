<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the most recent cats that are not adopted.
     */
    public function index()
    {
        $cats = Cat::where('is_adopted', '=', false)
                        ->latest()
                        ->take(12)
                        ->get();

        return view('home', compact('cats'));
    }
}
