<?php

namespace App\Models\Images;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    // Define the table to be used
    protected $table = "image_thumbnails";

    // Define the relationship to the Image Model
    public function image() {
        return $this->belongsTo('App\Models\Images\Image');
    }
}
