<title>Cart</title>

@extends('templates.tpl_default')
@section('cart')
    <div class="banner py-3 mb-4 shadow-sm bg-warning">
        <div class="container">
            <h6 class="m-0 font-weight-bold"><a class="text-dark" href="/home">Home</a> / Cart</h6>
        </div>
    </div>

    <div id="AppendCartItems">
        @include('includes.products-cart-items')
    </div>

@endsection
