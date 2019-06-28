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
        $attributes = request()->validate([
            'title' => 'required|min:3',
            'details' => 'required|min:3',
            'code' => 'required|min:3'
        ]);
        $attributes['category_id'] = $category->id;
        $parent_id = request()->get('code_id');
        $subs = array();
        if ($parent_id == 0)
        {
            foreach ($category->subCategories as $sub)
            {
                $id = $sub->id;
                if (request()->has($id))
                {
                    $subs[] = $id;
                }
            }
            $code = Code::create($attributes);
            $subcategories = Subcategory::find($subs);
            $code->subcategories()->attach($subcategories);
            return redirect('/categories/'.strval($category->id).'/codes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, Code $code)
    {
        if ($code->code_id == 0)
        {
            return view('codes.show', compact('category', 'code'));
        }
        return redirect('codes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Code $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        //
    }
}
