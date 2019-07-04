<?php

namespace App\Http\Controllers;

use App\Code;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $codes = $this->getCodes($category);
        return view('codes.index', compact('category', 'codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('codes.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category)
    {
        $parent_id = request()->get('code_id');
        $this->storeCode($parent_id, $category->id);
        return redirect(
            $parent_id > 0 ? '/codes/'.strval($parent_id) : '/categories/'.strval($category->id).'/codes')
        ->with('success', 'New Code Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Code $code)
    {
        if ($code->code_id == 0)
        {
            return view('codes.show', compact('code'));
        }
        elseif ($code->code_id > 0)
        {
            return redirect('/codes/'.strval($code->code_id));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        return view('codes.edit', compact('code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Code $code)
    {
        $attributes = $this->validateCode();
        $parent_id = request()->get('code_id');
        $code->update($attributes);
        if ($parent_id == 0)
        {
            $this->attachSubcategories($code);
        }
        return redirect($parent_id > 0 ? '/codes/'.strval($parent_id) : '/codes/'.strval($code->id))->with('success', 'Code Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        $parent_id = $code->code_id;
        if ($parent_id == 0)
        {
            $code->childCodes()->delete();
        }
        $cat_id = $code->category->id;
        $code->delete();
        return redirect($parent_id > 0 ? 'codes/'.strval($parent_id) : '/categories/'.strval($cat_id).'/codes/')->with('success', 'Code Deleted!');
    }

    public function validateCode ()
    {
        return request()->validate([
            'title' => 'required|min:3',
            'details' => 'required|min:3',
            'code' => 'required|min:3'
        ]);
    }

    public function attachSubcategories ($code, $create = false)
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

    public function getCodes ($category)
    {
        $codes = collect([]);
        if (request()->get('is_filter') === "1")
        {
            foreach($category->subCategories as $sub)
            {
                if (request()->has($sub->id))
                {
                    $codes = $codes->toBase()->merge($sub->codes);
                }
            }
            $codes = $codes->unique('id');
        }
        else
        {
            $codes = $category->codes;
        }
        return $codes;
    }

    public function storeCode ($parent_id, $category_id)
    {
        $attributes = $this->validateCode();
        $attributes['category_id'] = $category_id;
        if ($parent_id == 0)
        {
            $code = Code::create($attributes);
            $this->attachSubcategories($code, true);
        }
        elseif ($parent_id > 0)
        {
            $code = Code::find($parent_id);
            $code->addChildCode($attributes);
        }
    }
}
