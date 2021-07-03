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
        <h1>{{ $products['tenDT'] }}</h1>
        <br>
        <div class="row product_data">
            <div class="col-5 imagesDetail">
                <img src="../images/{{ $products['urlHinh'] }}" alt="">
            </div>
            <div class="col-7">
                <ul class="list-group">
                    <li class="list-group-item">Original Price:
                        <del>{{ number_format($products['gia'], 0, ',', '.') }}</del> VNĐ
                    </li>
                    <li class="list-group-item">Selling Price: {{ number_format($products['giaKM'], 0, ',', '.') }}
                        VNĐ</li>
                    <li class="list-group-item"><span class="badge bg-success text-white">In stock</span></li>
                    <li class="list-group-item">
                        <input type="hidden" value="{{$products['_id']}}" class="idProd">
                        <label for="">Quantity</label>
                        <div class="input-group text-center mb-3" style="width:130px">
                            <button class="input-group-text decrement-btn">-</button>
                            <input type="text" name="quantity" class="form-control text-center qty-input" value="1">
                            <button class="input-group-text increment-btn">+</button>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <button class="btn btn-success addToCartBtn p-2">Add to cart</button>
                        <button class="btn btn-warning return p-2"><a href="home">Back to Home page</a></button>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="bg-danger">
        <h2>Describe Product</h2>
        <div class="text-justify">{{ $products['moTa'] }}</div>
    @endsection

</body>

</html>
