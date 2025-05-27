<?php

namespace App\Http\Controllers;

use App\Enums\AdoptionRequestStatus;
use App\Models\AdoptionRequest;
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
        if ($cat->checkAdoptionRequest($request->user())) {
            return back()
                    ->with('error', 'You have already requested to adopt this cat.');
        }

        $cat->adoptionRequests()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    /**
     * Cancel an adoption request removing it from the database.
     *
     * @param Request $request
     * @param Cat $cat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Cat $cat)
    {
        $adoptionRequest = $cat->checkAdoptionRequest($request->user());

        abort_if(! $adoptionRequest, 404);

        $adoptionRequest->delete();

        return back();
    }

    /**
     * Reject an adoption request, setting its status to REJECTED.
     *
     * @param AdoptionRequest $adoptionRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->status = AdoptionRequestStatus::REJECTED->value;
        $adoptionRequest->save();

        return back()->with('success', 'Adoption request rejected successfully.');
    }

    /**
     * Approve an adoption request, setting its status to APPROVED.
     * 
     * TODO: Implement logic to set the cat as adopted and assign the adopter.
     *
     * @param AdoptionRequest $adoptionRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->status = AdoptionRequestStatus::APPROVED->value;
        $adoptionRequest->save();

        return back()->with('success', 'Adoption request approved successfully.');
    }
}
