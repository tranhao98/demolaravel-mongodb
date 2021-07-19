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