<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

class PagesController extends Controller
{
    // Index of the entire website
    public function index() {
    	return view('index');
    }

    // Testing Route for New Layouts
    public function testing() {

    	$environment = config('app.env');
    	// dd($environment);
    	if($environment != 'local') {
    		Session::flash('danger', 'You are trying to access a restricted page. Your action has been logged');
    		return redirect()->route('index');
    	}

    	return view('auth.login');
    }

    // Generate a New Google 2FA Code
    public function googleGenerate() {
        $secret = LoginController::getGoogleSecretCode();

        $barcode = GoogleQrUrl::generate('admin', $secret, 'MaineSkyPixels');

        return view('admin.2facode')
            ->withBarcode($barcode);
    }
}
