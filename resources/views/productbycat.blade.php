<title>Category</title>
@extends('templates.tpl_default')
@section('articlecat')
    <div id="banner" class="py-3 mb-4 shadow-sm bg-warning">
        <div class="container">
            <h6 class="m-0 font-weight-bold"><a class="text-dark" href="/home">Home</a> / {{ $category['tenNSX'] }}</h6>
        </div>
    </div>
    <div class="container">
        <div class="mt-4 mb-4 text-center">
            <h4 class="font-weight-bold text-uppercase">{{ $category['tenNSX'] }} Category </h4>
            <img src="images/line-dec.png" alt="">
        </div>
        <div class="card-columns category_list">
            @foreach ($products as $prod)
                <div class="card text-center">
                    <div class="card-header">
                        <a href="{{ $category['slugcat'] }}/{{ $prod['slug'] }}.html">{{ $prod['tenDT'] }}</a>
                    </div>
                    <a href="{{ $category['slugcat'] }}/{{ $prod['slug'] }}.html">
                        <div class="card-body">
                            <img style="height: 150px;" src="images/{{ $prod['urlHinh'] }}" alt="">
                        </div>
                    </a>
                    <div class="card-footer text-muted">
                        <del>{{ number_format($prod['gia'], 0, ',', '.') }} VNĐ</del> <br>
                        <span>{{ number_format($prod['giaKM'], 0, ',', '.') }} VNĐ</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
