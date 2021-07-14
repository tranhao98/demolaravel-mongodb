<?php
use Illuminate\Support\Facades\Auth;
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Edit Profile</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('edit-contact-infor')
        <div class="card shadow" style="font-size: 13px">
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
    @endsection
</body>

</html>
