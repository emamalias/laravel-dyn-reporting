<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'meta';

    public $timestamps = false;

    protected $fillable = ['object_type', 'object_id', 'name', 'label', 'type', 'value'];

    public function object() {
        return $this->morphTo();
    }
}
