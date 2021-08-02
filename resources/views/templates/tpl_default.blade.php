<?php
use App\Models\Cart;
use App\Models\infoUser;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
?>

    @extends('layouts.app')
    @section('content')
        @yield('blog-detail')
        @yield('blog')
        @yield('profile')
        @yield('branch-detail')
        @yield('cart')
        @yield('verify')
        @yield('articlecat')
        @yield('product-detail')
        @yield('article')
        @yield('checkout')
        @include('includes.footer')
    @endsection

