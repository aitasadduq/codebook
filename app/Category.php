<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    //
    public function subCategories ()
    {
    	return $this->hasMany(Category::class);
    }

    public function addSubCategory ($attributes)
    {
        return $this->subCategories()->create($attributes);
    }

    public function parent ()
    {
    	return $this->belongsTo(Category::class);
    }
}
