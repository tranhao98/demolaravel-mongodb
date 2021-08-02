<div class="row">
    <div class="col-md-8 width_cart_checkout">
        <div class="prod_cart_table">
            <table class="mb-2">
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
                            <td>
                                <span class="text-secondary font-weight-bold">Image:</span> <img
                                    src="images/{{ $item->products['urlHinh'] }}" height="70px" width="70px" alt="">
                                <br> <br>
                                <span class="text-secondary font-weight-bold">Name:</span>
                                {{ $item->products['tenDT'] }} <br> <br>
                                <span class="text-secondary font-weight-bold">Unit Price:</span>
                                {{ number_format($item->products['giaKM'], 0, ',', '.') }} VNĐ <br>
                            </td>
                            <td class="text-center">
                                {{ $item['qtyProd'] }}
                            </td>
                            <td class="text-center">
                                {{ number_format($item['qtyProd'] * $item->products['giaKM'], 0, ',', '.') }} VNĐ
                            </td>
                            <td class="product_data text-center">
                                <input type="hidden" value="{{ $item['idProd'] }}" class="idProd">
                                <a style="cursor: pointer" class="delete-cart-item text-danger"><i class="pe-7s-trash"
                                        style="font-size:30px"></i></a>
                            </td>
                        </tr>
                        @php $subtotal += $item['qtyProd'] * $item->products['giaKM'] @endphp
                    @endforeach
                </tbody>
            </table>
            @if (Session::has('couponCode'))
                <form id="changeCoupon_table" class="m-0" method="POST" action="javascript:void(0);">
                    @csrf
                    <div class="row">
                        <div class="col-4 align-self-center width_coupon_code">
                            <h6 class="text-uppercase m-0 f_cp_code font-weight-bold">Coupon code: </h6>
                        </div>
                        <div class="col-4 align-self-center width_form_hascoupon ml-n5 mr-n3">
                            <input type="hidden" name="couponCode" id="couponCode_table" class="couponCode"
                                value="{{ Session::get('couponCode') }}">
                            <h6 class="m-0 font-weight-bold">{{ Session::get('couponCode') }}</h6>
                        </div>
                        <div class="col-2 align-self-center width_form_apply">
                            <button type="submit" class="btn btn-danger cp_code_apply">
                                <h6 class="m-0 text-uppercase">Remove</h6>
                            </button>
                        </div>

                    </div>
                </form>
            @else
                <form id="applyCoupon_table" class="m-0" method="POST" action="javascript:void(0);">
                    @csrf
                    <div class="row">
                        <div class="col-4 align-self-center width_coupon_code">
                            <h6 class="text-uppercase m-0 f_cp_code font-weight-bold">Coupon code: </h6>
                        </div>
                        <div class="col-4 align-self-center width_form_coupon ml-n5 mr-n3">
                            <input class="form-control" type="text" name="couponCode" id="couponCode_table"
                                placeholder="Enter Coupon Code">
                        </div>
                        <div class="col-2 align-self-center width_form_apply">
                            <button type="submit" class="btn btn-primary cp_code_apply">
                                <h6 class="m-0 text-uppercase">Apply</h6>
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <div class="card shadow prod_cart_card f_checkout">
            <div class="card-header">
                <div class="row font-weight-bold">
                    <div class="col-2 align-self-center">
                        Image
                    </div>
                    <div class="col-2 align-self-center">
                        Name Product
                    </div>
                    <div class="col-3 align-self-center">
                        Unit Price
                    </div>
                    <div class="col-2 align-self-center">
                        Quantity
                    </div>
                    <div class="col-3 align-self-center">
                        Sub Total
                    </div>
                </div>
            </div>
            <div class="card-body ">
                @php $subtotal = 0; @endphp
                @foreach ($cartItems as $item)
                    <div class="row product_data">
                        <div class="col-2 align-self-center">
                            <img class="image_prod_checkout" src="images/{{ $item->products['urlHinh'] }}"
                                height="70px" width="70px" alt="">
                        </div>
                        <div class="col-2 align-self-center">
                            {{ $item->products['tenDT'] }}
                        </div>
                        <div class="col-3 align-self-center">
                            {{ number_format($item->products['giaKM'], 0, ',', '.') }} VNĐ
                        </div>
                        <div class="col-2 align-self-center">
                            {{ $item['qtyProd'] }}
                        </div>
                        <div class="col-3 align-self-center">
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
                    <form id="changeCoupon" class="m-0" method="POST" action="javascript:void(0);">
                        @csrf
                        <div class="row">
                            <div class="col-4 align-self-center width_coupon_code">
                                <h6 class="text-uppercase m-0 f_cp_code font-weight-bold">Coupon code: </h6>
                            </div>
                            <div class="col-4 align-self-center width_form_coupon ml-n5 mr-n3">
                                <input type="hidden" name="couponCode" id="couponCode" class="couponCode"
                                    value="{{ Session::get('couponCode') }}">
                                <h6 class="m-0 font-weight-bold">{{ Session::get('couponCode') }}</h6>
                            </div>
                            <div class="col-2 align-self-center width_form_apply">
                                <button type="submit" class="btn btn-danger cp_code_apply">
                                    <h6 class="m-0 text-uppercase">Remove</h6>
                                </button>
                            </div>

                        </div>
                    </form>
                @else
                    <form id="applyCoupon" class="m-0" method="POST" action="javascript:void(0);">
                        @csrf
                        <div class="row">
                            <div class="col-4 align-self-center width_coupon_code">
                                <h6 class="text-uppercase m-0 f_cp_code font-weight-bold">Coupon code: </h6>
                            </div>
                            <div class="col-4 align-self-center width_form_coupon ml-n5 mr-n3">
                                <input class="form-control" type="text" name="couponCode" id="couponCode"
                                    placeholder="Enter Coupon Code">
                            </div>
                            <div class="col-2 align-self-center width_form_apply">
                                <button type="submit" class="btn btn-primary cp_code_apply">
                                    <h6 class="m-0 text-uppercase">Apply</h6>
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4 width_cart_checkout mb-0">
        <div class="card shadow f_checkout">
            <div class="card-header">
                <h6 class="text-uppercase text-center m-0 font-weight-bold">Total amount</h6>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 align-self-center font-weight-bold">
                        Sub Total
                    </div>
                    <div class="col-7 align-self-center text-right ">
                        {{ number_format($subtotal, 0, ',', '.') }} VNĐ
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-5 font-weight-bold align-self-center">
                        Tax(5%)
                    </div>
                    <div class="col-7 align-self-center text-right">
                        {{ number_format(($subtotal * 5) / 100, 0, ',', '.') }} VNĐ
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-5 font-weight-bold align-self-center">
                        Coupon Discount
                    </div>
                    <div class="col-7 align-self-center text-right f_price_checkout">
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
                    <div class="col-5 font-weight-bold align-self-center">
                        Grand Total
                    </div>
                    <div class="col-7 align-self-center text-right f_price_checkout">
                        @if (Session::has('grandTotal'))
                            <input type="hidden" value="{{ Session::get('grandTotal') }}" class="grandTotal">

                            {{ number_format(Session::get('grandTotal'), 0, ',', '.') }} VNĐ
                        @else
                            <input type="hidden" value="{{ ($subtotal * 5) / 100 + $subtotal }}" class="grandTotal">
                            {{ number_format(($subtotal * 5) / 100 + $subtotal, 0, ',', '.') }} VNĐ
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="w-100 shadow btn btn-dark mt-2 p-3 place-order text-uppercase button-checkout">
            <h6 class="m-0 font-weight-bold">Place order</h6>
        </button>
    </div>
</div>
