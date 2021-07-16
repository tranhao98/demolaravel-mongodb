<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <style>
        .card-columns {
            column-count: 3;
        }

    </style>
</head>

<body>
    @extends('templates.tpl_default')

    @section('article')
        <section class="bg-light">
            @if (Session::has('notadmin'))
                <div class="alert alert-danger" role="alert">
                    <p class="m-0">{{ Session::get('notadmin') }}</p>
                </div>
            @endif
            @if (Session::has('notactive'))
                <div class="alert alert-danger" role="alert">
                    <p class="m-0">{{ Session::get('notactive') }}</p>
                </div>
            @endif
            @if (Session::has('status'))
                <div class="alert alert-info" role="alert">
                    <p class="m-0">{{ Session::get('status') }}</p>
                </div>
            @endif
            <div class="container">
                <div class="card border-0 bg-light">
                    <div class="card-header bg-light border-0 text-center">
                        <h4 class="m-0 pt-4 pb-4 text-uppercase font-weight-bold">Featured Products</h4>
                        <img src="images/line-dec.png" alt="">
                    </div>
                    <div class="card-body">
                        <div class="card-columns">
                            @foreach ($dt as $product)
                                <div class="card text-center">
                                    <div class="card-header">
                                        <a style="font-size: 13px"
                                            href="/{{ $product['slug'] }}.html">{{ $product['tenDT'] }}</a>
                                    </div>
                                    <div class="card-body">
                                        <img style="height: 150px;" src="images/{{ $product['urlHinh'] }}" alt="">
                                    </div>
                                    <div class="card-footer text-muted">
                                        <del>{{ number_format($product['gia'], 0, ',', '.') }} VNĐ</del> <br>
                                        <span>{{ number_format($product['giaKM'], 0, ',', '.') }} VNĐ</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <div class="col-lg-12 text-center"> {{ $dt->links('pagination') }}</div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="card border-0">
                    <div class="card-header header-bg border-0 text-center">
                        <h4 class="pt-4 pb-4 m-0 text-uppercase font-weight-bold">Our Branches</h4>
                        <img src="images/line-dec.png" alt="">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="owl-carousel branch-carousel owl-theme">
                                @foreach ($branch as $bra)
                                    <div class="item">
                                        <div class="card">
                                            <a href="/{{ $bra['slug'] }}-branch/"><img
                                                    src="images/{{ $bra['logo'] }}"></a>
                                            <div class="card-body">
                                                <a href="/{{ $bra['slug'] }}-branch/">
                                                    <h5 class="card-title">{{ $bra['name'] }}</h5>
                                                </a>
                                                <p class="card-text"><i class="fa fa-map-marker"></i>
                                                    <small>{{ $bra['address'] }}</small> <br>
                                                    <i class="fa fa-university"></i> <small>{{ $bra['city'] }}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection

</body>

</html>
