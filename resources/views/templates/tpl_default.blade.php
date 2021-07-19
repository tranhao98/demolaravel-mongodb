<?php
use App\Models\Cart;
use App\Models\infoUser;
use App\Models\Product;
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
        @yield('blog-detail')
        @yield('blog')
        @yield('profile')
        @yield('branch-detail')
        @yield('cart')
        @yield('articlecat')
        @yield('product-detail')
        @yield('article')
        @include('includes.footer')
    @endsection
</body>

</html>
