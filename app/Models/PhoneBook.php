<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class PhoneBook extends Authenticatable
{
    protected $table = 'phone_book';

    public $timestamps = false;

    protected $fillable = [
        'phone',
    ];
}
