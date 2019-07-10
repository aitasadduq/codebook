<?php

namespace App\Http\Controllers;

use App\Code;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\CodeRequest;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $codes = $category->codes()->where('code_id', 0);
        if (request()->get('is_filter') == "1")
        {
            $codes = $codes->whereHas('subcategories', function($query) {
                $query->whereIn('subcategories.id', request()->get('checkboxes'));
            });
        }
        $codes = $codes->get();
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
    public function store(CodeRequest $request, Category $category)
    {
        $attributes = $request->validated();
        $attributes['category_id'] = $category->id;
        $code = Code::create($attributes);
        if ($request->get('code_id') > 0)
        {
            Code::find($request->get('code_id'))->addChildCode($code);
            return redirect('/codes/'.strval($request->get('code_id')))->with('success', 'New Code Added!');
        }
        elseif ($request->get('code_id') == 0) { return redirect('/categories/'.strval($category->id).'/codes')->with('success', 'New Code Added!'); }
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
    public function update(CodeRequest $request ,Code $code)
    {
        $attributes = $request->validated();
        $code->update($attributes);
        if ($request->get('code_id') > 0) { return redirect('/codes/'.strval($code->code_id))->with('success', 'Code Updated!'); }
        elseif ($request->get('code_id') == 0) { return redirect('/codes/'.strval($code->id))->with('success', 'Code Updated!'); }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        $code->delete();
        if ($code->code_id > 0) { return redirect('/codes/'.strval($code->code_id))->with('success', 'Code Deleted!'); }
        elseif ($code->code_id == 0) { return redirect('/categories/'.strval($code->category->id).'/codes')->with('success', 'Code Deleted!'); }
    }
}
