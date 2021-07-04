<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css" media="all">
    <style>
        .card-columns {
            column-count: 2 !important;
        }

    </style>
</head>

<body>
    @extends('templates.tpl_default')
    @section('articlecat')
        <h2>{{ $category['tenNSX'] }} Category </h2>
        <div class="card-columns">
            @foreach ($products as $prod)
                <div class="card text-center">
                    <div class="card-header">
                        <a style="font-size: 13px" href="{{$category['slugcat']}}/{{ $prod['slug'] }}.html">{{ $prod['tenDT'] }}</a>
                    </div>
                    <div class="card-body">
                        <img style="height: 150px;" src="images/{{ $prod['urlHinh'] }}" alt="">
                    </div>
                    <div class="card-footer text-muted">
                        <del>{{ number_format($prod['gia'], 0, ',', '.') }} VNĐ</del> <br>
                        <span>{{ number_format($prod['giaKM'], 0, ',', '.') }} VNĐ</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
</body>

</html>
