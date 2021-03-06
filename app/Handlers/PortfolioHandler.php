<?php

namespace App\Handlers;

use App\Models\Portfolio\Category;
use Illuminate\Support\Facades\Session;

class PortfolioHandler
{

    // Get Categories From Database
    public static function getCategories() {
        // Grab all the categories from the database
        $categories = Category::orderBy('name', 'desc')->get();

        // If Categories Do Not Exist
        if(!self::doCategoriesExist($categories)) {
            // Show Warning Message
            self::noCategoriesFound();
            return false;
        }

        // Get categories array to be used by laravel collective
        return self::getCategoriesArray($categories);
    }

    // Do the categories exist
    public static function doCategoriesExist($categories) {
        if($categories->count() == 0) {
            return false;
        }
        return true;
    }

    // Do the images exist
    public static function doImagesExist($images) {
        if($images->count() == 0) {
            return false;
        }
        return true;
    }

    // Get the Categories Array To Be Used By Laravel Collective
    public static function getCategoriesArray($categories) {
        $categoriesArray = [];
        foreach($categories as $category) {
            $id = $category->id;
            $name = $category->name;
            $categoriesArray[$id] = $name;
        }
        return $categoriesArray;
    }

    // No Categories Found Warning Message
    public static function noCategoriesFound() {
        Session::flash('warning', 'No categories added yet. Create a category first before submitting a new image!');
    }

}
