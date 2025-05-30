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
        abort_if($cat->checkAdoptionRequest($request->user()), 403);

        if ($request->user()->cat) {
            return back()
                    ->with('alert', [
                        'type' => 'danger',
                        'message' =>  "You can't adopt more than one cat",
                    ]);
        }

        $adoptReqLimit = 6;

        if ($request->user()->adoptionRequests->count() >= $adoptReqLimit) {
            return back()
                    ->with('alert', [
                        'type' => 'danger',
                        'message' => 'You have reached the limit of adoption requests',
                    ]);
        }

        $cat->adoptionRequests()->create([
            'user_id' => $request->user()->id,
        ]);

        return back()
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Adoption request sent',
                ]);
    }

    /**
     * Cancel an adoption request removing it from the database.
     *
     * @param Request $request
     * @param Cat $cat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request, Cat $cat)
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
     * @param AdoptionRequest $adoptionRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->update(['status' => AdoptionRequestStatus::APPROVED->value]);
        $adoptionRequest->cat->update([
            'adopter_id' => $adoptionRequest->user->id,
            'is_adopted' => true,
        ]);

        return back()->with('success', 'Adoption request approved successfully.');
    }
}
