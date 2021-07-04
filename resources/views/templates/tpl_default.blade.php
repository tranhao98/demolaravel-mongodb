<?php
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tiêu đề trang</title>
</head>

<body>
    @include('layouts.app')
    @include('includes.header')
    <div class="container">
        <div class="row">
            <article class="col-sm-9 pl-0 mt-2">
                @yield('cart')
                @yield('articlecat')
                @yield('product-detail')
                @yield('article')
            </article>
            <aside class="col-sm-3 pr-0 mt-1">
                <div class="cart">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-sm-6">
                                <a href="/cart"><img src="../images/shoppingcart.gif" width="100px" alt=""></a>
                            </div>
                            <ul class="col-sm-6 mt-3">
                                <li>
                                    <span class="badge badge-secondary p-2 mb-2">
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
                        <li class="list-group-item bg-secondary active"> <strong>Category</strong></li>
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
    <!-- Scripts -->
    <script src="{{ asset('js/sweetalert2.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>

</body>

</html>
