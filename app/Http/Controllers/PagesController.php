<?php

namespace App\Http\Controllers;

use App\Handlers\Tinypng;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

class PagesController extends Controller
{
    // Index of the entire website
    public function index() {
    	return view('index');
    }

    // Testing Route for New Layouts
    public function testing() {

    }

    // Generate a New Google 2FA Code
    public function googleGenerate() {
        $secret = LoginController::getGoogleSecretCode();

        $barcode = GoogleQrUrl::generate('admin', $secret, 'MaineSkyPixels');

        return view('admin.2facode')
            ->withBarcode($barcode);
    }
}
