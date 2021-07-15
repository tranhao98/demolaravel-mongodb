<?php
use App\Models\Cart;
use App\Models\infoUser;
use Illuminate\Support\Facades\Auth;
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tiêu đề trang</title>
</head>

<body>
    @extends('layouts.app')
    @section('content')
        @include('includes.header')
        <div class="container">
            <div class="row">
                <article class="col-sm-9 pl-0 mt-2">
                    @yield('edit-contact-infor')
                    @yield('edit-basic-infor')
                    @yield('profile')
                    @yield('branch-detail')
                    @yield('orders')
                    @yield('cart')
                    @yield('articlecat')
                    @yield('product-detail')
                    @yield('article')
                    @yield('orders-detail')
                </article>
                <aside class="col-sm-3 pr-0 mt-1">
                    <div class="cart">
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-info w-100" href="../map"><i class="fa fa-map-marker"
                                        style="font-size:20px"></i> View map</a>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                @if (infoUser::where('idUser', Auth::id())->count() > 0)
                                    <a class="btn btn-primary w-100" href="../orders"><i class="fa fa-calendar-check-o"
                                            style="font-size:20px"></i>
                                        Orders ({{ infoUser::where('idUser', Auth::id())->count() }})</a>
                                @else
                                    <a class="btn btn-primary w-100" href="../orders"><i class="fa fa-calendar-check-o"
                                            style="font-size:20px"></i>
                                        Orders</a>
                                @endif
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body row">
                                <div class="col-sm-6">
                                    <a href="../cart"><img src="../images/shoppingcart.gif" width="100px" alt=""></a>
                                </div>
                                <ul class="col-sm-6 mt-3">
                                    <li>
                                        <span class="badge badge-warning p-1 mb-2">
                                            {{ Cart::where('idUser', Auth::id())->count() }} items </span>
                                    </li>
                                    <li>
                                        <a class="btn btn-link p-1" href="/cart">View cart</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <form action="" method="post">
                                    <input type="text" name="" id="" class="form-control" placeholder="Keywords">
                                </form>
                            </div>
                        </div>
                        <ul class="list-group mt-3">
                            <li class="list-group-item bg-secondary"> <strong class="text-light">Category</strong></li>
                            @foreach ($nsx as $row)
                                <li class="list-group-item"><a
                                        href="{{ $row['slugcat'] }}.html">{{ $row['tenNSX'] }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </aside>
            </div>
        </div>
        @include('includes.footer')
    @endsection
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
</body>

</html>
