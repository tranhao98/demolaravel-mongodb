<title>Login</title>
@extends('layouts.app')

@section('content')
<div id="banner" class="py-3 mb-4 shadow-sm bg-warning">
    <div class="container">
        <h6 class="m-0 font-weight-bold"> <a class="text-dark" href="/home">Home</a> / Login</h6>
    </div>
</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @php
                    if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                        $email = $_COOKIE['email'];
                        $password = $_COOKIE['password'];
                        $is_remember = "checked = 'checked'";
                    } else {
                        $email = '';
                        $password = '';
                        $is_remember = "";
                    }
                @endphp
                <div class="card mb-4">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" class="mb-5" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6 width_input_login">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6 width_input_login">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password" value="{{ $password }}" required>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input remember" {{$is_remember}} type="checkbox" name="remember"
                                            id="remember">

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-3 mb-0">
                                <div class="col-md-8 offset-md-4 width_btn_login">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a style="display: none" class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </form>
                        <div class="separator">New around here?</div>
                        <div class="button text-center mt-2 width_btn_regis">
                            <a href="{{ route('register') }}" class="btn btn-secondary text-center w-75"> Create your
                                account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
