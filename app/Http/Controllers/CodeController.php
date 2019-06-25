<?php

namespace App\Http\Controllers;

use App\Code;
use App\Category;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = Code::all();
        return view('codes.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('codes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => 'required|min:3',
            'details' => 'required|min:3',
            'code' => 'required|min:3'
        ]);
        $parent_id = request()->get('code_id');
        $subs = array();
        if ($parent_id == 0)
        {
            foreach (Category::all()->pluck('id') as $id)
            {
                if (Category::find($id)->category_id != 0)
                {
                    if (request()->has($id))
                    {
                        $subs[] = $id;
                    }
                }
            }
            $code = Code::create($attributes);
            $categories = Category::find($subs);
            $code->categories()->attach($categories);
            return "Success!";
        }
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
