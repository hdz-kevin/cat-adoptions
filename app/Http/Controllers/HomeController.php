<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the most recent cats that are not adopted.
     */
    public function index(Request $request)
    {
        $take = 12;
        
        if ($request->user()?->is_admin) {
            $cats = Cat::orderBy('created_at', 'desc')->take($take)->get();
        } else {
            $cats = Cat::where('is_adopted', '=', false)
                            ->latest()
                            ->take($take)
                            ->get();
        }

        return view('home', compact('cats'));
    }
}
