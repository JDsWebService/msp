@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
    <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
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

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                Request New Password
            </button>
        </div>
    </form>
@endsection
