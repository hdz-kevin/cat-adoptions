<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display user profile
     * Auth users can see only their own profile
     * Admin can see any profile
     *
     * @param Request $request
     * @param User $user
     */
    public function show(Request $request, User $user)
    {
        abort_if(
            ! auth()->user()->is_admin && $user->id != auth()->user()->id,
            403
        );

        return view('profile', compact('user'));
    }
}
