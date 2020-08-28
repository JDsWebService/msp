<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Index of the entire website
    public function index() {
    	return view('index');
    }
}
