<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Define the Table Being Used
    protected $table = 'categories';

    // Define the relationship between Image and Category Models
    public function images() {
        return $this->hasMany('App\Models\Images\Image');
    }
}
