<title>Product Detail</title>
@extends('templates.tpl_default')
@section('product-detail')
    <div class="banner py-3 mb-4 shadow-sm bg-warning">
        <div class="container">
            <h6 class="m-0 font-weight-bold"><a class="text-dark" href="/home">Home</a> / <a class="text-dark" href="/{{$products->category['slugcat']}}.html">{{ $products->category['tenNSX'] }}</a> / {{ $products['tenDT'] }}</h6>
        </div>
    </div>
    <div class="container">
        <div class="mt-4 mb-4 text-center">
            <h4 class="font-weight-bold">{{ $products['tenDT'] }}</h4>
            <img src="../images/line-dec.png" alt="">
        </div>
        <div class="row product_data pt-5 pb-5 shadow rounded">
            <div class="col-md-4 align-self-center">
                <img src="../images/{{ $products['urlHinh'] }}" class="w-100" alt="">
            </div>
            <div class="col-md-8 align-self-center">
                <ul class="list-group">
                    <li class="list-group-item">Original Price:
                        <del>{{ number_format($products['gia'], 0, ',', '.') }}</del> VNĐ
                    </li>
                    <li class="list-group-item">Selling Price: {{ number_format($products['giaKM'], 0, ',', '.') }}
                        VNĐ</li>
                    <li class="list-group-item"><span class="badge bg-success text-white p-2">In stock</span></li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 align-self-center">
                                <input type="hidden" value="{{ $products['_id'] }}" class="idProd">
                                <label for="">Quantity</label>
                                <div class="input-group text-center" style="width:100%">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" class="form-control text-center qty-input" value="1">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-8 align-self-center mt-2 btn_addcart">
                                <br>
                                <button class="btn btn-success addToCartBtn p-2 text-white"><i class="pe-7s-cart"></i> Add
                                    to cart</button>
                                <button class="btn btn-warning return p-2"> <a class="text-white" href="/home">Continue
                                        shopping</a> </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="bg-danger">
        <h2>Describe Product</h2>
        <div class="text-justify mb-3">{{ $products['moTa'] }}</div>
    </div>
@endsection
