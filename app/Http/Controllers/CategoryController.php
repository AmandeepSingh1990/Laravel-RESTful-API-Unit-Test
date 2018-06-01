<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use MyHelper;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return MyHelper::response('Category list', $categories);
    }

    /**
     * Display a listing of the Categories for DropDown.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $categories = Category::get();

        return MyHelper::response('Category list for drop down', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ],[
            'title.required' => 'Title of the category is required.'
        ]);

        $store = Category::create($request->only('title', 'slug'));

        return MyHelper::response('Category added.', $store);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return MyHelper::response('Category Detail', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ],[
            'title.required' => 'Title of the category is required.'
        ]);

        $category = Category::find($id);

        $category->fill($request->only('title', 'slug'));

        $update = $category->save();

        return MyHelper::response('Category updated.', $update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Category::destroy($id);

        return MyHelper::response('Category deleted');
    }
}
