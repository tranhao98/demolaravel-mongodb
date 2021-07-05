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
            <div class="card shadow" style="font-size: 13px">
                <div class="card-body ">
                    <div class="row font-weight-bold">
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
                            Sub Total
                        </div>
                        <div class="col-md-2 align-self-center">
                            Remove
                        </div>
                    </div>
                    <hr>
                    @php $subtotal = 0; @endphp
                    @foreach ($cartItems as $item)
                        <div class="row product_data">
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
                                    <input type="number" name="quantity" class="form-control text-center qty-input"
                                        value="{{ $item['qtyProd'] }}" min="1" max="100">
                                    <button class="input-group-text increment-btn changeQty">+</button>
                                </div>
                            </div>
                            <div class="col-md-2 align-self-center">
                                {{ number_format($item['qtyProd'] * $item->products['giaKM'], 0, ',', '.') }} VNĐ
                            </div>
                            <div class="col-md-2 align-self-center">
                                <a class="delete-cart-item text-danger"><i class="fa fa-trash-o" style="font-size:30px"></i></a>
                            </div>
                        </div>
                        <hr>
                        @php $subtotal += $item['qtyProd'] * $item->products['giaKM'] @endphp
                    @endforeach
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-8 mt-2 pr-0">
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
                </div>
                <div class="col-md-4 mt-2">
                    <a href="/home"><button class="w-100 shadow border btn btn-light p-4 text-uppercase font-weight-bold">
                            <h6>Continue Shopping</h6>
                        </button></a>
                    <a href="/checkout"><button
                            class="w-100 shadow btn btn-dark mt-2 pt-5 pb-5 text-uppercase button-checkout font-weight-bold">
                            <h6>Checkout</h6>
                        </button></a>
                </div>
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
