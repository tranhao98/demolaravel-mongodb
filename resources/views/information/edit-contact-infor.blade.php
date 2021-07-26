<?php
use Illuminate\Support\Facades\Auth;
?>
<title>Edit Profile</title>

@extends('my-profile')
@section('edit-contact-infor')
    <div class="mt-4 mb-4 text-center">
        <h4 class="text-uppercase font-weight-bold ">Contact Information</h4>
        <img src="../images/line-dec.png" alt="">
    </div>
    <div class="container">
        <div class="card mt-4 shadow" style="font-size: 13px">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">Edit Contact Information</h6>
            </div>
            <div class="card-body ">
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" value="{{ Auth::user()->mobile }}" class="form-control">
                </div>
                <input type="hidden" name="idUser" id="idUser" value="{{ Auth::id() }}">
                <button class="btn btn-success update-contact-infor">Update</button>
            </div>
        </div>
    </div>
@endsection
