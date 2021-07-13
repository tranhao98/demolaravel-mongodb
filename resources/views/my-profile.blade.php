<?php
use Illuminate\Support\Facades\Auth;
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('profile')
        <div class="card shadow" style="font-size: 13px">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">My Profile</h6>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{Auth::user()->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" id="mobile" value="{{Auth::user()->mobile}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="{{Auth::user()->email}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" placeholder="Enter City" value="{{Auth::user()->city}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" placeholder="Enter State" value="{{Auth::user()->state}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" placeholder="Enter Country" value="{{Auth::user()->country}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter Address" value="{{Auth::user()->address}}" class="form-control">
                </div>
                <input type="hidden" name="idUser" id="idUser" value="{{Auth::id()}}">
                <button class="btn btn-success update-profile">Update Profile</button>
            </div>
        </div>
    @endsection
</body>

</html>