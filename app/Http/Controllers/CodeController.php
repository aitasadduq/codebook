<?php

namespace App\Http\Controllers;

use App\Code;
use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\CodeRequest;
use Illuminate\Support\Facades\Input;

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
        }
        return redirect($this->storeLink($request->get('code_id'), $category->id))->with('success', 'New Code Added!');
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
        return redirect($this->updateLink($request->get('code_id'), $code))->with('success', 'Code Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        $cat_id = $code->category->id;
        $code->delete();
        return redirect($this->deleteLink($code, $cat_id))->with('success', 'Code Deleted!');
    }

    public function deleteLink ($code, $cat_id)
    {
        if ($code->code_id > 0) { return '/codes/'.strval($code->code_id); }
        elseif ($code->code_id == 0) { return '/categories/'.strval($cat_id).'/codes'; }
    }

    public function storeLink ($parent_id, $cat_id)
    {
        if ($parent_id > 0) { return '/codes/'.strval($parent_id); }
        elseif ($parent_id == 0) { return '/categories/'.strval($cat_id).'/codes'; }
    }

    public function updateLink ($parent_id, $code)
    {
        if ($parent_id > 0) { return '/codes/'.strval($parent_id); }
        elseif ($parent_id == 0) { return '/codes/'.strval($code->id); }
    }
}
