<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $guarded = [];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function childCodes()
    {
    	return $this->hasMany(Code::class);
    }

    public function parentCode()
    {
    	return $this->belongsTo(Code::class);
    }

    public function addChildCode($attributes)
    {
    	return $this->childCodes()->create($attributes);
    }

    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }

    public function attachSubcategories($code, $create = false)
    {
        $subs = array();
        foreach ($code->category->subCategories as $sub)
        {
            if (request()->has($sub->id))
            {
                $subs[] = $sub->id;
            }
        }
        $subcategories = Subcategory::find($subs);
        if ($create)
        {
            $code->subcategories()->attach($subcategories);
        }
        else
        {
            $code->subcategories()->sync($subcategories);
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($code) {
            $code->childCodes()->delete();
        });

        static::updated(function($code) {
            if ($code->code_id == 0) {
                $code->attachSubcategories($code);
            }
        });

        static::created(function($code) {
            if ($code->code_id == 0) {
                $code->attachSubcategories($code, true);
            }
        });
    }
}
