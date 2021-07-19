<?php
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>

<body>
    @extends('layouts.app')
    @section('content')
    <div style="margin-top: 87px" class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="m-0 font-weight-bold">Home / Cart / Checkout</h6>
        </div>
    </div>
        <div class="container">
            <form>
                <div class="mt-4 mb-4 text-center">
                    <h2 class="font-weight-bold text-uppercase">Fill Billing Address</h2>
                    <img src="images/line-dec.png" alt="">
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="fullName">Full name</label>
                            <input type="text" class="form-control" name="Fullname" id="fullName"
                                value="{{ Auth::user()->name }}" @if (isset(Auth::user()->name)) disabled @endif placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="Email" value="{{ Auth::user()->email }}" @if (isset(Auth::user()->email)) disabled @endif
                                id="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone number</label>
                            <input type="number" class="form-control" name="Phone" value="{{ Auth::user()->mobile }}" @if (isset(Auth::user()->mobile)) disabled @endif
                                id="phoneNumber" placeholder="Enter Mobile">
                        </div>
                        <div class="form-group">
                            <label for="cityName">City name</label>
                            <input type="text" class="form-control" name="City" id="cityName" placeholder="Enter City">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="State" id="state" placeholder="Enter State">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" name="Country" id="country" placeholder="Enter Country">
                        </div>
                        <div class="form-group">
                            <label for="fullAdd">Full address</label>
                            <textarea name="fullAdd" class="form-control" id="FullAdd" cols="10" rows="5"
                                placeholder="Enter Address"></textarea>
                        </div>
                    </div>
                </div>
            </form>

            <div class="text-center mt-4 mb-4">
                <h2 class="font-weight-bold m-0 text-uppercase">Shopping Basket</h2>
                <img src="images/line-dec.png" alt="">
            </div>
            <div id="AppendCartCheckout">
                @include('includes.cart-checkout')
            </div>

        </div>
        <br>
        @include('includes.footer')
    @endsection
</body>

</html>
