<?php

namespace App\Models;

use App\Events\UserCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use Notifiable;

    public $timestamps = false;

    protected $with = ['phones', 'countries'];

    protected $fillable = [
        'full_name',
        'email',
    ];

    protected $dispatchesEvents = [
        'saved' => UserCreated::class,
    ];

    public function phones()
    {
        return $this->hasMany('App\Models\PhoneBook');
    }

    public function countries()
    {
        return $this->hasMany('App\Models\UserCountry');
    }
}
