<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <style>
        .card-columns {
            column-count: 2;
        }
    </style>
</head>

<body>
    @extends('templates.tpl_default')
    
    @section('article')
    <div class="card-columns">
        @foreach ($dt as $product)
        <div class="card text-center">
            <div class="card-header">
                <a style="font-size: 13px" href="{{$product{"slug"} }}.html">{{$product{"tenDT"} }}</a>
            </div>
            <div class="card-body">
                <img style="height: 150px;" src="images/{{$product{"urlHinh"} }}" alt="">
            </div>
            <div class="card-footer text-muted">
                <del>{{ number_format($product{"gia"}, 0, ",", ".") }} VNĐ</del> <br>
                <span>{{ number_format($product{"giaKM"}, 0, ",", ".") }} VNĐ</span>
            </div>
        </div>
        @endforeach
    </div>

    @endsection


</body>

</html>