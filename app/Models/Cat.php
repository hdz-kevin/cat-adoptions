<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_adopted',
        'name',
        'breed',
        'age',
        'picture',
        'vaccinated',
    ];
}
