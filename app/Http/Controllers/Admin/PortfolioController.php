<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\FileHandler;
use App\Http\Controllers\Controller;
use App\Models\Portfolio\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        // Return the Create View
        return view('admin.portfolio.create');
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
            'fileUpload' => 'required|image|max:1999'
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


        // Add Meta Data to object
        $image->title = Purifier::clean($request->title);
        $image->description = Purifier::clean($request->description);
        $image->taken_on = $request->taken_on;
        $image->width = $request->width;
        $image->height = $request->height;

        // Save Object
        $image->save();

        // Flash Message
        Session::flash('success', 'Portfolio Image has been added to the database!');
        // Redirect
        return redirect()->route('admin.portfolio.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
