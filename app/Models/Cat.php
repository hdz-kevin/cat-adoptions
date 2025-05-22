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

    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    /**
     * Check if the cat has an adoption request from `$user`.
     *
     * @param User $user
     * @return boolean
     */
    public function hasAdoptionRequest(User $user)
    {
        return $this->adoptionRequests()->where('user_id', $user->id)->exists();
    }
}
