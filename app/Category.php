<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    //
    public function subCategories ()
    {
    	return $this->hasMany(Subcategory::class);
    }

    public function addSubcategory ($attributes)
    {
        return $this->subCategories()->create($attributes);
    }

    public function codes ()
    {
        return $this->hasMany(Code::class);
    }
}
