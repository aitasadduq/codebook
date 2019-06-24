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
        //
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
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category)
    {
        //
        $attributes = request()->validate([
            'title' => 'required | min:3'
        ]);
        $parent_id = request()->get('category_id');
        // dd($parent_id);
        if ($parent_id == 0)
        {
            $category = Category::create($attributes);
            return redirect('/categories');
        }
        // $attributes['category_id'] = (int) $parent_id;
        // $attributes = array_merge(['category_id' => (int) $parent_id], $attributes);
        Category::find($parent_id)->subCategories()->create($attributes);
        // $category->subCategories()->create(['title'=>request()->get('title')]);

        // dd($attributes);
        // $sub = Category::create($attributes);
        // // dd($attributes);
        // $category->addSubCategory($sub);
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
        //
        if ($category->parent_id == 0)
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
        //
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
        //
        $attributes = request()->validate([
            'title' => 'required | min:3'
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
