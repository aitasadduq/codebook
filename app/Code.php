<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $guarded = [];

    public function categories ()
    {
    	return $this->belongsToMany(Category::class);
    }
}
