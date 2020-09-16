@extends('layouts.auth')

@section('title', 'Admin Login')

@section('content')
    <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
            <span class="label-input100">eMail</span>
            <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
            <span class="label-input100">Password</span>
            <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
						        <strong>{{ $message }}</strong>
						    </span>
            @enderror
            <span class="focus-input100"></span>
        </div>

        @if(config('app.env') != 'local')
            <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                <span class="label-input100">2FA Code</span>
                <input id="google_code" type="text" class="input100" name="google_code" required autocomplete="off">
                <span class="focus-input100"></span>
            </div>
        @endif

        <div class="flex-sb-m w-full p-b-30">
            <div class="contact100-form-checkbox">
                <input class="input-checkbox100" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="label-checkbox100" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div>
                @if (Route::has('password.request'))
                    <a class="txt1" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Login
            </button>
        </div>
    </form>
@endsection
