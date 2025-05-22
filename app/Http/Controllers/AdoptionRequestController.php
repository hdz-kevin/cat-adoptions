<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class AdoptionRequestController extends Controller
{
    /**
     * Store a new adoption request.
     * 
     * @param  Request  $request
     * @param  Cat  $cat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Cat $cat)
    {
        if ($cat->hasAdoptionRequest($request->user())) {
            return back()
                    ->with('error', 'You have already requested to adopt this cat.');
        }

        $cat->adoptionRequests()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }
}
