<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCountry extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
}
