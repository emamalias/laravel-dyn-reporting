<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Meta;
use App\User;

class Website extends Model
{
    protected $table = 'websites';

    public function meta($field = null) {
    	if($field) {
    		return $this->morphMany(Meta::class, 'object')->where('name', 'domain');
    	}
        return $this->morphMany(Meta::class, 'object');
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function reportable() {
    	return $this->whereHas('meta', function($query) {
    		$query->where('meta.name', 'domain');
    		$query->where('meta.value', 'RLIKE', '.*(.com|.net)');
    	})->whereRaw('year(`created_at`) = ?', [date('Y')])->with('meta');
    }
}
