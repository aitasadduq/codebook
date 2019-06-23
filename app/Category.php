<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function subCategories ()
    {
    	return $this->hasMany(Category::class, 'parent_id');
    }

    public function addSubCategory ($attributes)
    {
    	return $this->subCategories()->create($attributes);
    }

    public function parent ()
    {
    	return $this->belongsTo(Category::class, 'parent_id');
    }
}
