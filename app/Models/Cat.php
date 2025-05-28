<?php

namespace App\Models;

use App\Enums\AdoptionRequestStatus as AdoptReqStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'breed',
        'age',
        'vaccinated',
        'photo',
        'is_adopted',
        'adopter_id',
    ];

    /**
     * Get all adoption requests for the cat.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    /**
     * Get all adoption requests for the cat grouped by status.
     * 
     * @return \Illuminate\Support\Collection<string, Illuminate\Database\Eloquent\Collection>
     */
    public function groupedAdoptionRequests()
    {
        $grouped = $this->adoptionRequests()->get()->groupBy('status');

        // Ensures that all available statuses are in the returned collection
        return collect(AdoptReqStatus::values())
                  ->mapWithKeys(fn ($status) => [
                      $status => $grouped->get($status, new Collection())
                  ]);
    }

    /**
     * Check if the cat has an adoption request from `$user`.
     *
     * @param User $user
     * @return AdoptionRequest|null
     */
    public function checkAdoptionRequest(User $user)
    {
        return $this->adoptionRequests()->where('user_id', $user->id)->first();
    }
}
