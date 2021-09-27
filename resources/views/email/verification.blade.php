<title>Account Verification</title>

@extends('templates.tpl_default')
@section('verify')
    <div class="banner py-3 mb-4 shadow-sm bg-warning">
        <div class="container">
            <h6 class="m-0 font-weight-bold"> <a class="text-dark" href="/home">Home</a> / Account Verification</h6>
        </div>
    </div>

    <div class="image_verified text-center">
        <h2 class="mb-3 text-success font-weight-bold d-flex align-items-center justify-content-center"> Your account is verified.</h2>
        <img class="image_verified_account" src="../images/account_verified.png" height="500px" width="50%" alt="">
    </div>

    <a href="{{ route('login') }}"><button class="w-100 mt-2 border btn btn-light p-4 text-uppercase font-weight-bold"
            style="font-size: 17px;">login</button></a>
@endsection
