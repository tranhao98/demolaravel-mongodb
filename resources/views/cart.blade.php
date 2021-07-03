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
            <div class="card shadow">
                <div class="card-body ">
                    <div class="row font-weight-bold" style="font-size: 13px">
                        <div class="col-md-2 align-self-center">
                            Image
                        </div>
                        <div class="col-md-2 align-self-center">
                            Name Product
                        </div>
                        <div class="col-md-2 align-self-center">
                            Unit Price
                        </div>
                        <div class="col-md-2 align-self-center">
                            Quantity
                        </div>
                        <div class="col-md-2 align-self-center">
                            Total Price
                        </div>
                        <div class="col-md-2 align-self-center">
                            Delete
                        </div>
                    </div>
                    <hr>

                    @foreach ($cartItems as $item)
                        <div class="row product_data" style="font-size: 13px">
                            <div class="col-md-2 align-self-center">
                                <img src="images/{{ $item->products['urlHinh'] }}" height="70px" width="70px" alt="">
                            </div>
                            <div class="col-md-2 align-self-center">
                                {{ $item->products['tenDT'] }}
                            </div>
                            <div class="col-md-2 align-self-center">
                                {{ number_format($item->products['giaKM'], 0, ',', '.') }} VNĐ
                            </div>
                            <div class="col-md-2 align-self-center mt-4">
                                <input type="hidden" value="{{ $item['idProd'] }}" class="idProd">
                                <div class="input-group text-center mb-3" style="width:120px">
                                    <button class="input-group-text decrement-btn changeQty">-</button>
                                    <input type="text" name="quantity" class="form-control text-center qty-input"
                                        value="{{ $item['qtyProd'] }}">
                                    <button class="input-group-text increment-btn changeQty">+</button>
                                </div>
                            </div>
                            <div class="col-md-2 align-self-center">
                                {{ number_format($item['qtyProd'] * $item->products['giaKM'], 0, ',', '.') }} VNĐ
                            </div>
                            <div class="col-md-2 align-self-center">
                                <button class="btn btn-danger p-1 delete-cart-item" style="font-size: 11px"><i
                                        class="fa fa-trash"></i> Remove</button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        @else
            <div 
                class="alert alert-danger p-2 text-center text-uppercase font-weight-bold">
                <h1 class="mt-2">Don't have any products in Cart</h1>
            </div>
            <div class="text-right">
                <a style="width:100%" class="btn btn-success text-uppercase font-weight-bold p-2" href="home">Continue Shopping</a>
            </div>
        @endif
    @endsection
</body>

</html>
