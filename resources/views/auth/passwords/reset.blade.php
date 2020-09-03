@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <form class="login100-form validate-form" method="POST" action="{{ route('password.update') }}">
        @csrf

        {{-- User Token --}}
        <input type="hidden" name="token" value="{{ $token }}">
        {{-- Email --}}
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

        {{-- Password --}}
        <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
            <span class="label-input100">Password</span>
            <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="focus-input100"></span>
        </div>

        {{-- Password Confirmation --}}
        <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
            <span class="label-input100">Password</span>
            <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="focus-input100"></span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
@endsection
