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
        $attributes = $this->validateCode();
        $attributes['category_id'] = $category->id;
        $parent_id = request()->get('code_id');
        if ($parent_id == 0)
        {
            $subs = array();
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
            return redirect('/categories/'.strval($category->id).'/codes')->with('success', 'New Code Added!');
        }
        $code = Code::find($parent_id);
        $code->addChildCode($attributes);
        return back()->with('success', 'New Child Code Added!');
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
        return redirect('/categories/'.strval($category->id).'/codes/'.strval($code->code_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Code $code)
    {
        return view('codes.edit', compact('category', 'code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Code $code)
    {
        $attributes = $this->validateCode();
        $attributes['category_id'] = $category->id;
        $parent_id = request()->get('code_id');
        $path = '/categories/'.strval($category->id).'/codes/';
        $message = 'Code Updated!';
        if ($parent_id == 0)
        {
            $subs = array();
            foreach ($category->subCategories as $sub)
            {
                $id = $sub->id;
                if (request()->has($id))
                {
                    $subs[] = $id;
                }
            }
            $code->update($attributes);
            $subcategories = Subcategory::find($subs);
            $code->subcategories()->sync($subcategories);
            $path = $path.strval($code->id);
        }
        else
        {
            $code->update($attributes);
            $path = $path.strval($parent_id);
            $message = 'Child '.$message;
        }
        return redirect($path)->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Code $code)
    {
        $path = '/categories/'.strval($category->id).'/codes/';
        $message = 'Code Deleted!';
        $parent_id = $code->code_id;
        if ($parent_id == 0)
        {
            $code->childCodes()->delete();
        }
        else {
            $path = $path.strval($parent_id);
            $message = 'Child '.$message;
        }
        $code->delete();
        return redirect($path)->with('success', $message);
    }

    public function validateCode ()
    {
        return request()->validate([
            'title' => 'required|min:3',
            'details' => 'required|min:3',
            'code' => 'required|min:3'
        ]);
    }
}
