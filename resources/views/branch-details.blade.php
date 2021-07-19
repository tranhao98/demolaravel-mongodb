<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Branch Detail</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('branch-detail')
    <div style="margin-top: 87px" class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="m-0 font-weight-bold">Home / Branch / {{$branch['name']}}</h6>
        </div>
    </div>
        <div class="container">
            <div class="text-center mb-4 mt-4">
                <h4 class="text-uppercase font-weight-bold text-info">Contact {{ $branch['name'] }}</h4>
                <img src="../images/line-dec.png" alt="">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="../images/{{ $branch['logo'] }}" style="width: 100%; height: 500px; object-fit:cover"
                        alt="">
                </div>
                <div class="col-md-8">
                    <div class="product_data">
                        <div class="card border-0 w-100">
                            <div class="card-header header-bg">
                                <h4 class="m-0">{{ $branch['name'] }} Branch</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><span class="font-weight-bold text-info">Address:
                                    </span>{{ $branch['address'] }}
                                </p>
                                <p class="card-text"><span class="font-weight-bold text-info">Phone:
                                    </span>{{ $branch['phone'] }}
                                </p>
                            </div>
                            <div class="card-footer border-0 header-bg">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                            aria-controls="home" aria-selected="true">Products</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                            aria-controls="profile" aria-selected="false">Find Us</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="owl-carousel product-carousel owl-theme">
                                                    @foreach ($products as $prod)
                                                        <div class="item">
                                                            <div class="card">
                                                                    <a class="p-3" href="/{{ $prod['slug'] }}.html"><img
                                                                            style="height: 250px; width:100%;"
                                                                            src="../images/{{ $prod['urlHinh'] }}"></a>
                                                                <div class="card-body">
                                                                    <h6 class="card-title">{{ $prod['tenDT'] }}</h6>
                                                                    <p class="card-text">
                                                                        <del class="float-end">{{ number_format($prod['gia'], 0, ',', '.') }}
                                                                            VNĐ</del> <br>
                                                                        <span
                                                                            class="float-start">{{ number_format($prod['giaKM'], 0, ',', '.') }}
                                                                            VNĐ</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <a href="/storelocator" class="btn btn-info w-100 font-weight-bold mt-3">View
                                            map</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

</body>

</html>
