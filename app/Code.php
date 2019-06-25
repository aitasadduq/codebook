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

    public function childCodes ()
    {
    	return $this->hasMany(Code::class);
    }

    public function parent ()
    {
    	return $this->belongsTo(Code::class);
    }

    public function addChildCode ($attributes)
    {
    	return $this->childCodes()->create($attributes);
    }
}
