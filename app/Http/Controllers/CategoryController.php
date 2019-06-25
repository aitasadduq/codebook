<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required | min:1'
        ]);
        $parent_id = request()->get('category_id');
        if ($parent_id == 0)
        {
            $category = Category::create($attributes);
            return redirect('/categories');
        }
        $category = Category::find($parent_id);
        $category->addSubcategory($attributes);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if ($category->category_id == 0)
        {
            return view('categories.show', compact('category'));
        }
        return redirect('categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $attributes = request()->validate([
            'title' => 'required | min:1'
        ]);
        $category->update($attributes);
        if ($category->category_id == 0)
        {
            return redirect('/categories');
        }
        return redirect('/categories/'.(string) $category->category_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        if ($category->category_id == 0)
        {
            return redirect('/categories');
        }
        return redirect('/categories/'.(string) $category->category_id);
    }
}
