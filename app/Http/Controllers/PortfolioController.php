<?php

namespace App\Http\Controllers;

use App\Models\Portfolio\Category;
use App\Models\Portfolio\Image;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'desc')->get();
        $images = Image::orderBy('updated_at', 'desc')->paginate(18);

        // Return the Index of the Portfolio Section
        return view('portfolio.index')->withCategories($categories)->withImages($images);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Grab the image by the slug
        $image = Image::where('slug', $slug)->first();

        return view('portfolio.show')->withImage($image);
    }

}
