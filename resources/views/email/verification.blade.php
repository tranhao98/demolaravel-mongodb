<title>Account Verification</title>

@extends('templates.tpl_default')
@section('verify')
    <div style="margin-top: 87px" class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="m-0 font-weight-bold">Home / Account Verification</h6>
        </div>
    </div>

    <div class="image_verified text-center">
        <h2 class="mb-3 text-success font-weight-bold d-flex align-items-center justify-content-center"> Your account is verified.</h2>
        <img src="../images/account_verified.png" height="500px" width="50%" alt="">
    </div>

    <a href="/home"><button class="w-100 mt-2 border btn btn-light p-4 text-uppercase font-weight-bold"
            style="font-size: 17px;">loggin</button></a>
@endsection
