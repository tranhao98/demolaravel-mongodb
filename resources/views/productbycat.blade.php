<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Category</title>
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
        <div class="container">
            <div class="mt-4 mb-4 text-center">
                <h4 class="font-weight-bold text-uppercase">{{ $category['tenNSX'] }} Category </h4>
                <img src="images/line-dec.png" alt="">
            </div>
            <div class="card-columns">
                @foreach ($products as $prod)
                    <div class="card text-center">
                        <div class="card-header">
                            <a style="font-size: 13px"
                                href="{{ $category['slugcat'] }}/{{ $prod['slug'] }}.html">{{ $prod['tenDT'] }}</a>
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
        </div>
    @endsection
</body>

</html>
