<?php
use Illuminate\Support\Facades\Auth;
?>

<title>Edit Profile</title>

@extends('my-profile')
@section('edit-basic-infor')
    <div class="mt-4 mb-4 text-center">
        <h4 class="text-uppercase font-weight-bold ">Basic Information</h4>
        <img src="../images/line-dec.png" alt="">
    </div>
    <div class="container">
        <div class="card mt-4 shadow" style="font-size: 13px">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">Edit Basic Information</h6>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="">Select</option>
                        @if (Auth::user()->gender == '1')
                            <option value="1" selected>Male</option>
                            <option value="0">Female</option>
                        @elseif(Auth::user()->gender == '0')
                            <option value="1">Male</option>
                            <option value="0" selected>Female</option>
                        @else
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <?php $formatBirthdate = date('d-m-Y', strtotime(Auth::user()->birthdate)); ?>
                    @if (isset(Auth::user()->birthdate) && Auth::user()->birthdate != '')
                        <input type="text" value="{{ $formatBirthdate }}" name="birthdate" placeholder="dd-mm-yyyy"
                            id="birthdate" class="form-control">
                        <small>(Example: 31-12-2020)</small>
                    @else
                        <input type="text" class="form-control" name="birthdate" placeholder="dd-mm-yyyy" id="birthdate"
                            required>
                        <small>(Example: 31-12-2020)</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" placeholder="Enter City" value="{{ Auth::user()->city }}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" name="state" id="state" placeholder="Enter State" value="{{ Auth::user()->state }}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" placeholder="Enter Country"
                        value="{{ Auth::user()->country }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter Address"
                        value="{{ Auth::user()->address }}" class="form-control">
                </div>
                <input type="hidden" name="idUser" id="idUser" value="{{ Auth::id() }}">
                <button class="btn btn-success update-basic-infor">Update</button>
            </div>
        </div>
    </div>
@endsection
