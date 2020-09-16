<?php

namespace App\Http\Controllers;

use App\Handlers\PortfolioHandler;
use App\Models\Portfolio\Category;
use App\Models\Portfolio\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        if(!PortfolioHandler::doCategoriesExist($categories)) {
            Session::flash('Oops, we don\'t have anything to show you yet! Check back later!');
            return redirect()->route('index');
        }

        if(!PortfolioHandler::doImagesExist($images)) {
            Session::flash('Oops, we don\'t have any images to show you yet! Check back later!');
            return redirect()->route('index');
        }

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
