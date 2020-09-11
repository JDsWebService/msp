<?php

namespace App\Http\Controllers;

use App\Mail\QuoteRequestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Mews\Purifier\Facades\Purifier;
use GuzzleHttp\Client as Guzzle;

class ContactController extends Controller
{
    // Send eMail Method
    public function sendemail(Request $request) {
        dd(config('google.recaptcha.secret'));
    	$this->validate($request, [
    		'name' => 'required|string|max:255',
    		'email' => 'required|email|max:255',
    		'phone' => 'nullable|string|max:255',
    		'business_name' => 'nullable|string|max:255',
    		'type' => 'nullable|string|max:255',
    		'location' => 'nullable|string|max:255',
    		'date' => 'nullable|string|max:255'
    	]);

    	// Handle Google Recaptcha Token
        $g_token = $request->input('g-recaptcha-response');
        if(isset($g_token)) {
            $guzzle = new Guzzle();
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $recaptcha_data = [
                'secret'    => env('GOOGLE_RECAPTCHA_SECRET'),
                'response'  => $g_token
            ];
            $form_params = ['form_params' => $recaptcha_data];
            $response = $guzzle->post($url, $form_params);
            $result = json_decode($response->getBody()->getContents());
            if(!$result->success) {
                Session::flash('danger', 'Google ReCaptcha Error Code(s): ' . $result->{'error-codes'}[0]);
                return redirect()->route('index');
            }
        } else {
            Session::flash('danger', 'Google ReCaptcha Token Not Set - eMail jdswebservice@gmail.com and let them know about this error.');
            return redirect()->route('index');
        }

    	$data = [
    		'name' => Purifier::clean($request->name),
    		'email' => Purifier::clean($request->email),
    		'phone' => Purifier::clean($request->phone),
    		'business_name' => Purifier::clean($request->business_name),
    		'type' => Purifier::clean($request->type),
    		'location' => Purifier::clean($request->location),
    		'date' => Purifier::clean($request->date),
    	];

    	// Send Mail To Customer
    	Mail::to($data['email'])
    			->send(new QuoteRequestMail($request, 'customer'));

    	// Send Mail To Admin
    	Mail::to('info@maineskypixels.com')
    			->send(new QuoteRequestMail((object) $data, 'admin'));

    	Session::flash('success', 'Your email has been receieved! Someone will get back to you within 24 business hours!');

    	return redirect()->route('index');
    }
}
