<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Product Detail</title>
    <style>
        button{
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

        <h1>{{$productDetail{"tenDT"} }}</h1>
        <br>
        <div class="row">
            <div class="col-5 imagesDetail">
                <img src="images/{{$productDetail{"urlHinh"} }}" alt="">
            </div>
            <div class="col-7">
                <ul class="list-group">
                    <li class="list-group-item">Giá lên kệ: <del>{{ number_format($productDetail{"gia"}, 0, ",", ".") }}</del> VNĐ</li>
                    <li class="list-group-item">Giá bán: {{ number_format($productDetail{"giaKM"}, 0, ",", ".") }} VNĐ</li>
                    <li class="list-group-item">Tình trạng: <span class="text-success">Còn hàng</span></li>
                    <li class="list-group-item"><button class="btn btn-primary">MUA NGAY</button>
                        <button class="btn btn-success">THÊM VÀO GIỎ HÀNG</button>
                        <button class="btn btn-warning return"><a href="home">TIẾP TỤC MUA HÀNG</a></button>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="bg-danger">
        <h2>MÔ TẢ SẢN PHẨM:</h2>
        <div class="text-justify">{{$productDetail{"moTa"} }}</div>
    @endsection

</body>

</html>