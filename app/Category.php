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

    public function addSubCategory ($category)
    {
        // dd($attributes);
    	// return $this->subCategories()->create($attributes);
        return $this->subCategories()->save($category);
    }

    public function parent ()
    {
    	return $this->belongsTo(Category::class);
    }
}
