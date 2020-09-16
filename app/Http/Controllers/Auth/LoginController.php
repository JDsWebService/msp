<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Google\Authenticator\GoogleAuthenticator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        // Validate the Form Data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if the environment is in production
        if(config('app.env') != 'local') {
            $this->validate($request, [
                'google_code' => 'required|string',
            ]);
            // Handle the 2FA
            $g = new GoogleAuthenticator();
            $secret = self::getGoogleSecretCode();

            if(!$g->checkCode($secret, $request->google_code)) {
                Session::flash('danger', 'Two Factor Authentication Code is Invalid');
                return redirect()->route('login');
            }
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Attempt to login the admin
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // redirect if successful
            return redirect()->intended(route('admin.dashboard'));
        } else {
            return redirect()->back()->withErrors(['msg' => 'Something went wrong while logging in. Contact an Administrator!'])->withInputs($request->only('email', 'remember'));
        }

        // redirect if unsuccessful w/ form data
        return redirect()->back()->withInputs($request->only('email', 'remember'));
    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return redirect()->route('index');
    }

    // Get Scret Code from ENV Files for Google 2FA Auth
    public static function getGoogleSecretCode() {
        $secret = config('google.2fa.secret');

        return $secret;
    }
}
