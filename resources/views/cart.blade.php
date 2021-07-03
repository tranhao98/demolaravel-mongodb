<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cart</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('cart')
        <div class="card shadow">
            <div class="card-body">
                <div class="row font-weight-bold" style="font-size: 15px">
                    <div class="col-md-2">
                    Image
                    </div>
                    <div class="col-md-2">
                    Name Product
                    </div>
                    <div class="col-md-2">
                    Price
                    </div>
                    <div class="col-md-2">
                    Quantity
                    </div>
                    <div class="col-md-2">
                    Total Price
                    </div>
                    <div class="col-md-2">
                    Delete
                    </div>
                </div> <hr>
                @php $i=0; @endphp
                @foreach ($cartItems as $key => $item)
                    <div class="row product_data" style="font-size: 15px">
                        <div class="col-md-2">
                            <img src="images/{{$item->products['urlHinh']}}" height="70px" width="70px" alt="">
                        </div>
                        <div class="col-md-2">
                        {{ $item->products['tenDT'] }}
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" value="{{$item->products['giaKM']}}" class="price">
                        {{ number_format($item->products['giaKM'], 0, ',', '.') }} VNĐ
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" value="{{$item['idProd']}}" class="idProd">
                            <div class="input-group text-center mb-3" style="width:120px">
                                <button class="input-group-text decrement-btn" data="{{$key}}">-</button>
                                <input type="text" name="quantity" class="form-control text-center" id="qty-input_{{$key}}" value="{{$item['qtyProd']}}">
                                <button class="input-group-text increment-btn" data="{{$key}}">+</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{ number_format($item['qtyProd']*$item->products['giaKM'],0,',','.')}} VNĐ
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger delete-cart-item" style="font-size: 12px"><i class="fa fa-trash"></i> Remove</button>
                        </div>
                    </div>
                    <hr>
                    @php $i++; @endphp
                @endforeach

            </div>
        </div>

    @endsection

</body>

</html>
