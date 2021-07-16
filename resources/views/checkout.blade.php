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
        @include('includes.header')
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

            <div class="row">
                <div class="col-sm-8">
                    <div class="card shadow" style="font-size: 13px">
                        <div class="card-header">
                            <div class="row font-weight-bold">
                                <div class="col-md-2 align-self-center">
                                    Image
                                </div>
                                <div class="col-md-2 align-self-center">
                                    Name Product
                                </div>
                                <div class="col-md-3 align-self-center">
                                    Unit Price
                                </div>
                                <div class="col-md-2 align-self-center">
                                    Quantity
                                </div>
                                <div class="col-md-3 align-self-center">
                                    Sub Total
                                </div>
                            </div>
                        </div>
                        <div class="card-body ">
                            @php $subtotal = 0; @endphp
                            @foreach ($cartItems as $item)
                                <div class="row product_data">
                                    <div class="col-md-2 align-self-center">
                                        <img src="images/{{ $item->products['urlHinh'] }}" height="70px" width="70px"
                                            alt="">
                                    </div>
                                    <div class="col-md-2 align-self-center">
                                        {{ $item->products['tenDT'] }}
                                    </div>
                                    <div class="col-md-3 align-self-center">
                                        {{ number_format($item->products['giaKM'], 0, ',', '.') }} VNĐ
                                    </div>
                                    <div class="col-md-2 align-self-center">

                                        <input type="hidden" value="{{ $item['idProd'] }}" class="idProd">
                                        <input type="hidden" value="{{ $item['qtyProd'] }}" class="qtyProd">
                                        {{ $item['qtyProd'] }}
                                    </div>
                                    <div class="col-md-3 align-self-center">
                                        {{ number_format($item['qtyProd'] * $item->products['giaKM'], 0, ',', '.') }}
                                        VNĐ
                                    </div>
                                </div>
                                <hr>
                                @php $subtotal += $item['qtyProd'] * $item->products['giaKM'] @endphp
                            @endforeach
                        </div>
                        <div class="card-footer">
                            @if (Session::has('couponCode'))
                                <form id="changeCoupon" method="POST" action="javascript:void(0);">
                                    @csrf
                                    <div class="row">
                                        <div class="col-3 align-self-center">
                                            <h6 class="text-uppercase m-0 font-weight-bold">Coupon code: </h6>
                                        </div>
                                        <div class="col-2 align-self-center ml-n5 mr-n3">
                                            <input type="hidden" name="couponCode" class="couponCode"
                                                value="{{ Session::get('couponCode') }}">
                                            <h6 class="m-0">{{ Session::get('couponCode') }}</h6>
                                        </div>
                                        <div class="col-3 align-self-center">
                                            <button type="submit" class="btn btn-danger">
                                                <h6 class="m-0 text-uppercase">Remove</h6>
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            @else
                                <form id="applyCoupon" method="POST" action="javascript:void(0);">
                                    @csrf
                                    <div class="row">
                                        <div class="col-3 align-self-center">
                                            <h6 class="text-uppercase m-0 font-weight-bold">Coupon code: </h6>
                                        </div>
                                        <div class="col-4 align-self-center ml-n5 mr-n3">
                                            <input class="form-control" type="text" name="couponCode" id="couponCode"
                                                placeholder="Enter Coupon Code">
                                        </div>
                                        <div class="col-2 align-self-center">
                                            <button type="submit" class="btn btn-primary">
                                                <h6 class="m-0 text-uppercase">Apply</h6>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card shadow" style="font-size: 14px">
                        <div class="card-header">
                            <h6 class="text-uppercase text-center m-0 font-weight-bold">Total amount</h6>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6 align-self-center font-weight-bold">
                                    Sub Total
                                </div>
                                <div class="col-md-6 align-self-center text-right">
                                    {{ number_format($subtotal, 0, ',', '.') }} VNĐ
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 font-weight-bold align-self-center">
                                    Tax(5%)
                                </div>
                                <div class="col-md-6 align-self-center text-right">
                                    {{ number_format(($subtotal * 5) / 100, 0, ',', '.') }} VNĐ
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 font-weight-bold align-self-center">
                                    Coupon Discount
                                </div>
                                <div class="col-md-6 align-self-center text-right">
                                    @if (Session::has('couponAmount'))
                                        <input type="hidden" name="couponAmount" class="couponAmount"
                                            value="{{ Session::get('couponAmount') }}">
                                        - {{ number_format(Session::get('couponAmount'), 0, ',', '.') }} VNĐ
                                    @else
                                        0 VNĐ
                                    @endif
                                </div>
                            </div>
                            <hr style="border: 1px solid">
                            <div class="row">
                                <div class="col-md-6 font-weight-bold align-self-center">
                                    Grand Total
                                </div>
                                <div class="col-md-6 align-self-center text-right">
                                    @if (Session::has('grandTotal'))
                                        <input type="hidden" value="{{ Session::get('grandTotal') }}" class="grandTotal">

                                        {{ number_format(Session::get('grandTotal'), 0, ',', '.') }} VNĐ
                                    @else
                                        <input type="hidden" value="{{ ($subtotal * 5) / 100 + $subtotal }}"
                                            class="grandTotal">
                                        {{ number_format(($subtotal * 5) / 100 + $subtotal, 0, ',', '.') }} VNĐ
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-100 shadow btn btn-dark mt-2 p-3 place-order text-uppercase button-checkout font-weight-bold">
                        <h6 class="m-0">Place order</h6>
                    </button>

                </div>
            </div>
            </form>
        </div>
        <br>
        @include('includes.footer')
    @endsection
</body>

</html>
