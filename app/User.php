<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Meta;
use App\Website;
use App\Report;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function meta() {
        return $this->morphMany(Meta::class, 'object');
    }

    public function websites() {
        return $this->hasMany(Website::class);
    }

    public function reports() {
        return $this->hasMany(Report::class);
    }
}
