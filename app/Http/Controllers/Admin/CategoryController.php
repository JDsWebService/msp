<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mews\Purifier\Facades\Purifier;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Grab all the categories from the database
        $categories = Category::orderBy('name', 'desc')->paginate(15);

        return view('admin.category.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return The View
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Request
        $this->validate($request, [
            'name' => 'required|max:255|string'
        ]);

        // Create New Category Object
        $category = new Category;

        // Assign Request Data To Object
        $category->name = Purifier::clean($request->name);

        // Save Object To Database
        $category->save();

        // Flash Session Message
        Session::flash('success', 'Category has been successfully added to the database');

        // Return a redirect
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Grab the Category from the database
        $category = Category::where('id', $id)->first();

        // Return View With Category
        return view('admin.category.edit')->withCategory($category);
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
        // Validate Request
        $this->validate($request, [
            'name' => 'required|max:255|string'
        ]);

        // Create New Category Object
        $category = Category::where('id', $id)->first();

        // Assign Request Data To Object
        $category->name = Purifier::clean($request->name);

        // Save Object To Database
        $category->save();

        // Flash Session Message
        Session::flash('success', 'Category has been successfully saved to the database');

        // Return a redirect
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Grab the category from the database
        $category = Category::where('id', $id)->first();

        $category->delete();

        Session::flash('success', 'Category has been deleted.');
        return redirect()->route('admin.category.index');
    }
}
