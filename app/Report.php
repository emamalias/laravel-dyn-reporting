<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Meta;
use App\User;

class Report extends Model
{
    protected $table = 'reports';

    public function meta() {
        return $this->morphMany(Meta::class, 'object');
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
