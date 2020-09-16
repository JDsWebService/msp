<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\FileHandler;
use App\Http\Controllers\Controller;
use App\Models\Portfolio\Category;
use App\Models\Portfolio\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Grab Images From Database
        $images = Image::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.portfolio.index')->withImages($images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Grab All Categories & Store In Array
        $categories = Category::orderBy('name', 'desc')->get();
        $categoriesArray = [];
        foreach($categories as $category) {
            $id = $category->id;
            $name = $category->name;
            $categoriesArray[$id] = $name;
        }

        // Return the Create View
        return view('admin.portfolio.create')
            ->withCategories($categories)
            ->withCategoriesArray($categoriesArray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255|string',
            'description' => 'nullable|max:65535|string',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'taken_on' => 'nullable|date',
            'fileUpload' => 'required|image|max:49999'
        ]);


        // Create the object
        $image = new Image;

        // Handle File Upload
        $file = FileHandler::uploadFile($request, 'portfolio');
        $image->fileNameWithExt = $file->fileNameWithExt;
        $image->fileName = $file->fileName;
        $image->extension = $file->extension;
        $image->fileNameToStore = $file->fileNameToStore;
        $image->fullPath = $file->fullPath;
        $image->publicPath = $file->publicPath;


        // Handle Slug & Title Information
        $title = Purifier::clean($request->title);
        $slug = Str::slug($title);

        // Add Meta Data to object
        $image->title = $title;
        $image->slug = $slug;
        $image->description = Purifier::clean($request->description);
        $image->taken_on = $request->taken_on;
        $image->width = $request->width;
        $image->height = $request->height;
        $image->category_id = $request->category_id;

        // Save Object
        $image->save();

        // Flash Message
        Session::flash('success', 'Portfolio Image has been added to the database!');
        // Redirect
        return redirect()->route('admin.portfolio.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Grab the image from the database
        $image = Image::where('id', $id)->first();
        // Grab All Categories & Store In Array
        $categories = Category::orderBy('name', 'desc')->get();
        $categoriesArray = [];
        foreach($categories as $category) {
            $id = $category->id;
            $name = $category->name;
            $categoriesArray[$id] = $name;
        }

        return view('admin.portfolio.edit')
            ->withCategories($categories)
            ->withCategoriesArray($categoriesArray)
            ->withImage($image);
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
        $this->validate($request, [
            'title' => 'required|max:255|string',
            'description' => 'nullable|max:65535|string',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'taken_on' => 'nullable|date',
            'fileUpload' => 'nullable|image|max:49999'
        ]);


        // Create the object
        $image = Image::where('id', $id)->first();

        // Handle File Upload
        if($request->fileUpload != null) {
            $file = FileHandler::replaceFile($image, $request, 'portfolio');
            $image->fileNameWithExt = $file->fileNameWithExt;
            $image->fileName = $file->fileName;
            $image->extension = $file->extension;
            $image->fileNameToStore = $file->fileNameToStore;
            $image->fullPath = $file->fullPath;
            $image->publicPath = $file->publicPath;
        }

        // Handle Slug & Title Information
        $title = Purifier::clean($request->title);
        $slug = Str::slug($title);

        // Add Meta Data to object
        $image->title = $title;
        $image->slug = $slug;
        $image->description = Purifier::clean($request->description);
        $image->taken_on = $request->taken_on;
        $image->width = $request->width;
        $image->height = $request->height;
        $image->category_id = $request->category_id;

        // Save Object
        $image->save();

        // Flash Message
        Session::flash('success', 'Portfolio Image has been updated in the database!');
        // Redirect
        return redirect()->route('admin.portfolio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient = Image::where('id', $id)->first();
        $fileDelete = FileHandler::deleteFile($ingredient);

        if($fileDelete) {
            $ingredient->delete();
        }

        Session::flash('success', 'Image has been deleted.');
        return redirect()->route('admin.portfolio.index');
    }
}
