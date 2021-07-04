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
    @include('layouts.app')
    @include('includes.header')
   
    <div class="container">
        <div class="row mt-2 mb-2 ">
            <div class="col-12 text-center">
                <h2>Fill Billing Address</h2>
            </div>
        </div>
        <div class="row form-checkout">
            <div class="col-6">
                <form action="checkout">
                    <div class="form-group">
                        <label for="fullName">Full name</label>
                        <input type="text" class="form-control" name="fullName" id="fullName">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone number</label>
                        <input type="number" class="form-control" name="phone" id="phoneNumber">
                    </div>
                    <div class="form-group">
                        <label for="cityName">City name</label>
                        <input type="text" class="form-control" name="city" id="cityName">
                    </div>
                </form>
            </div>
            <div class="col-6">
                <form action="checkout">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" name="state" id="state">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country" id="country">
                    </div>
                    <div class="form-group">
                        <label for="fullAdd">Full address</label>
                        <textarea class="form-control" name="fullAdd" id="fullAdd" cols="10" rows="5"></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-12 text-center">
                <h2>Shopping Basket</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="card shadow" style="font-size: 13px">
                    <div class="card-body ">
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
                        <hr>
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
                                        {{ $item['qtyProd'] }}
                                </div>
                                <div class="col-md-3 align-self-center">
                                    {{ number_format($item['qtyProd'] * $item->products['giaKM'], 0, ',', '.') }} VNĐ
                                </div>
                            </div>
                            <hr>
                            @php $subtotal += $item['qtyProd'] * $item->products['giaKM'] @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card shadow" style="font-size: 14px">
                    <div class="card-body ">
                        <h6 class="text-uppercase text-center">Total amount</h6>
                        <hr>
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
                                Tax(10%)
                            </div>
                            <div class="col-md-6 align-self-center text-right">
                                {{ number_format(($subtotal * 10) / 100, 0, ',', '.') }} VNĐ
                            </div>
                        </div>
                        <hr style="border: 1px solid">
                        <div class="row">
                            <div class="col-md-6 font-weight-bold align-self-center">
                                Grand Total
                            </div>
                            <div class="col-md-6 align-self-center text-right">
                                {{ number_format(($subtotal * 20) / 100 + $subtotal, 0, ',', '.') }} VNĐ
                            </div>
                        </div>
                    </div>
                </div>
               <button class="w-100 shadow btn btn-dark mt-2 p-3 place-order text-uppercase button-checkout font-weight-bold"> <h6>place order</h6>
                    </button>

            </div>
        </div>

        <br>
        @include('includes.footer')

        <!-- Scripts -->
        <script src="{{ asset('js/sweetalert2.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}" defer></script>
        <script src="{{ asset('js/jquery.min.js') }}" defer></script>
        <script src="{{ asset('js/custom.js') }}" defer></script>

</body>

</html>
