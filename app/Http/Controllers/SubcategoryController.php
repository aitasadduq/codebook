<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category)
    {
        $attributes = $this->validateSubcategory();
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
    public function update(Subcategory $subcategory)
    {
        $attributes = $this->validateSubcategory();
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

    public function validateSubcategory()
    {
        return request()->validate([
            'title' => 'required | min:3'
        ]);
    }
}
