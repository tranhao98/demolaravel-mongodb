<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Product Detail</title>
    <style>
        button {
            font-size: 14px !important;
        }

        .imagesDetail img {
            width: 80%;
            object-fit: cover;
            margin-left: 50px;
        }

        .return a {
            color: white;
        }

        .return a:hover {
            text-decoration: none;
        }

    </style>
</head>

<body>
    @extends('templates.tpl_default')
    @section('product-detail')
    <div style="margin-top: 87px" class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="m-0 font-weight-bold">Home / {{$products->category['tenNSX']}} / {{$products['tenDT']}}</h6>
        </div>
    </div>
        <div class="container">
            <div class="mt-4 mb-4 text-center">
                <h1 class="font-weight-bold">{{ $products['tenDT'] }}</h1>
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
                                <div class="col-md-3 align-self-center">
                                    <input type="hidden" value="{{ $products['_id'] }}" class="idProd">
                                    <label for="">Quantity</label>
                                    <div class="input-group text-center" style="width:130px">
                                        <button class="input-group-text decrement-btn">-</button>
                                        <input type="text" name="quantity" class="form-control text-center qty-input"
                                            value="1">
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>
                                </div>
                                <div class="col-md-9 align-self-center">
                                    <br>
                                    <button class="btn btn-success addToCartBtn p-2 text-white"><i class="pe-7s-cart"></i> Add to cart</button>
                                    <button class="btn btn-warning return p-2 text-white"> <a href="/home">Continue
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

</body>

</html>
