<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cart</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('cart')
        @if (Cart::where('idUser', Auth::id())->count() > 0)
            <div id="AppendCartItems">
                @include('includes.products-cart-items')
            </div>
        @else
            <div class="alert alert-danger p-2 text-center text-uppercase font-weight-bold">
                <h1 class="mt-2">Don't have any products in Cart</h1>
            </div>
            <div class="text-center">
                <a href="/home"><button class="w-100 border btn btn-light p-4 text-uppercase font-weight-bold"
                        style="font-size: 17px;">Continue Shopping</button></a>
            </div>
        @endif
    @endsection
</body>

</html>
