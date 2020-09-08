<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // Define The Table To Be Used
    protected $table = "portfolio";

    // Define the relationship between the Image and Category Models
    public function category() {
        return $this->belongsTo('App\Models\Portfolio\Category');
    }
}
