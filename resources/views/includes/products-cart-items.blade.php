<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
?>
@if (Cart::where('idUser', Auth::id())->count() > 0)
    <div class="container mb-4">
        <div class="mt-4 mb-4 text-center">
            <h4 class="text-uppercase font-weight-bold">Shopping cart</h4>
            <img src="images/line-dec.png" alt="">
        </div>
        <div class="prod_cart_table">
            <table>
                <thead>
                    <tr>
                        <th>Product Information</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = 0; @endphp
                    @foreach ($cartItems as $item)
                        <tr>
                            <td> <span class="text-secondary font-weight-bold">Name:</span>  {{ $item->products['tenDT'] }} <br> <br>
                               <span class="text-secondary font-weight-bold">Unit Price:</span>  {{ number_format($item->products['giaKM'], 0, ',', '.') }} VNĐ <br>
                            </td>
                            <td class="product_data d-flex justify-content-center">
                                <input type="hidden" value="{{ $item['idProd'] }}" class="idProd">
                                <div class="input-group input_qty_cart mb-3" style="width:100%">
                                    <button class="input-group-text dec-btn changeQty">-</button>
                                    <input type="number" name="quantity" class="form-control text-center qty-input"
                                        value="{{ $item['qtyProd'] }}" min="1" max="100">
                                    <button class="input-group-text inc-btn changeQty">+</button>
                                </div>
                            </td>
                            <td> {{ number_format($item['qtyProd'] * $item->products['giaKM'], 0, ',', '.') }} VNĐ
                            </td>
                            <td class="product_data text-center">
                                <input type="hidden" value="{{ $item['idProd'] }}" class="idProd">
                                <a style="cursor: pointer" class="delete-cart-item text-danger"><i class="pe-7s-trash"
                                        style="font-size:30px"></i></a></td>
                        </tr>
                        @php $subtotal += $item['qtyProd'] * $item->products['giaKM'] @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card shadow cart_prod_items">
            <div class="card-header">
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
            </div>
            <div class="card-body ">
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
                            <div class="input-group input_qty_cart mb-3" style="width:100%">
                                <button class="input-group-text dec-btn changeQty">-</button>
                                <input type="number" name="quantity" class="form-control text-center qty-input"
                                    value="{{ $item['qtyProd'] }}" min="1" max="100">
                                <button class="input-group-text inc-btn changeQty">+</button>
                            </div>
                        </div>
                        <div class="col-md-2 align-self-center">
                            {{ number_format($item['qtyProd'] * $item->products['giaKM'], 0, ',', '.') }} VNĐ
                        </div>
                        <div class="col-md-2 align-self-center">
                            <a style="cursor: pointer" class="delete-cart-item text-danger"><i class="pe-7s-trash"
                                    style="font-size:30px"></i></a>
                        </div>
                    </div>
                    <hr>
                    @php $subtotal += $item['qtyProd'] * $item->products['giaKM'] @endphp
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 mt-2 cart_total_amount">
                <div class="card shadow " style="font-size: 14px">
                    <div class="card-header">
                        <h6 class="text-uppercase text-center font-weight-bold m-0">Total amount</h6>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-6 align-self-center font-weight-bold">
                                Sub Total
                            </div>
                            <div class="col-6 align-self-center text-right">
                                {{ number_format($subtotal, 0, ',', '.') }} VNĐ
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6 font-weight-bold align-self-center">
                                Tax(5%)
                            </div>
                            <div class="col-6 align-self-center text-right">
                                {{ number_format(($subtotal * 5) / 100, 0, ',', '.') }} VNĐ
                            </div>
                        </div>
                        <hr style="border: 1px solid">
                        <div class="row">
                            <div class="col-6 font-weight-bold align-self-center">
                                Grand Total
                            </div>
                            <div class="col-6 align-self-center text-right">
                                {{ number_format(($subtotal * 5) / 100 + $subtotal, 0, ',', '.') }} VNĐ
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pl-0 mt-2 btn_checkout_cart">
                <a href="/home"><button class="w-100 shadow border btn btn-light pt-4 pb-4 text-uppercase">
                        <h6 class="font-weight-bold m-0">Continue Shopping</h6>
                    </button></a>
                <a href="/checkout"><button
                        class="w-100 shadow btn btn-dark mt-2 pt-4 pb-4 text-uppercase button-checkout">
                        <h6 class="font-weight-bold m-0">Checkout</h6>
                    </button></a>
            </div>
        </div>
    </div>
@else
    <div class="text-center">
        <span class="text-danger font-weight-bold">Don't have any product in cart</span> <br>
        <img src="images/empty_cart.png" width="80%" height="500px" alt=""> <br>
        <a href="/home"><button class="w-100 border btn btn-light p-4 text-uppercase font-weight-bold"
                style="font-size: 17px;">Continue Shopping</button></a>
    </div>

@endif
