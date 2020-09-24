<?php

namespace App\Models\Images;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Define the table to be used
    protected $table = "image_index";

    // Define the relationship to the categories table
    public function category() {
        return $this->belongsTo('App\Models\Portfolio\Category');
    }

    // Define the relationship to all the image tables
    public function original() {
        return $this->hasOne('App\Models\Images\Original', 'id', 'original_id');
    }
    public function thumbnail() {
        return $this->hasOne('App\Models\Images\Thumbnail', 'id', 'thumbnail_id');
    }
    public function preview() {
        return $this->hasOne('App\Models\Images\Preview', 'id', 'preview_id');
    }
}
