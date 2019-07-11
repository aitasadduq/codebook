<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Requests\SubcategoryRequest;

class SubcategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request, Category $category)
    {
        $attributes = $request->validated();
        $category->addSubcategory($attributes);
        return back()->with('success', 'New Subcategory Added!');
    }

    public function edit(Category $category, Subcategory $subcategory)
    {
        return view('subcategories.edit', compact('category', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryRequest $request, Subcategory $subcategory)
    {
        $attributes = $request->validated();
        $subcategory->update($attributes);
        return redirect('/categories/'.strval($subcategory->category_id))->with('success', 'Subcategory Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect('/categories/'.strval($subcategory->category_id))->with('success', 'Subcategory Deleted!');
    }
}
