<?php

namespace App\Models;

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
