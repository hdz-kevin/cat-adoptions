<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the cat the user adopted.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cat()
    {
        return $this->hasOne(Cat::class, 'adopter_id');
    }

    /**
     * Get all user adoption requests.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adoptionRequests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }

    /**
     * Check if the user has an adoption request for `$cat`.
     *
     * @param Cat $cat
     * @return AdoptionRequest|null
     */
    public function checkAdoptionRequest(Cat $cat)
    {
        return $this->adoptionRequests()->where('cat_id', $cat->id)->first();
    }
}
