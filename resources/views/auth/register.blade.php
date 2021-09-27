<title>Create Account</title>
@extends('layouts.app')

@section('content')
<div id="banner" class="py-3 mb-4 shadow-sm bg-warning">
    <div class="container">
        <h6 class="m-0 font-weight-bold"> <a class="text-dark" href="/home">Home</a> / Create Account</h6>
    </div>
</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Create Account') }}</div>

                    <div class="card-body">
                        <form method="POST" class="mb-3" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Your name') }}</label>

                                <div class="col-md-6 width_input_regis">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" placeholder="Enter Name" required
                                        autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="mobile"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                                <div class="col-md-6 width_input_regis">
                                    <input id="mobile" type="text"
                                        class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                        value="{{ old('mobile') }}" placeholder="Enter Mobile" required
                                        autocomplete="mobile" autofocus>

                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6 width_input_regis">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Enter Email" value="{{ old('email') }}" required
                                        autocomplete="email">

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

                                <div class="col-md-6 width_input_regis">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter Password" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right text-nowrap">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6 width_input_regis">
                                    <input id="password-confirm" type="password" class="form-control"
                                        placeholder="Enter Confirm Password" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 width_input_regis">
                                    <button type="submit" class="btn btn-primary w-100">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <hr class="w-50 line_regis">
                        <div class="form-group row">
                             <label class="col-md-4 width_login_inregis col-form-label text-md-right"> <a class="text-dark" href="{{ route('login') }}">Already have an
                                account? </a> </label>

                            <div class="col-md-6 ml-n4 align-self-center width_login_inregis">
                                <div class="next">
                                    <a href="{{ route('login') }}" class="text-primary">Login </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
