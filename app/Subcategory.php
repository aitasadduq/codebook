<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded = [];

    public function parent ()
    {
    	return $this->belongsTo(Category::class);
    }

    public function codes ()
    {
    	return $this->belongsToMany(Code::class);
    }
}