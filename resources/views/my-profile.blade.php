<?php
use Illuminate\Support\Facades\Auth;
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('profile')
        <div class="container">
            <div class="row">
                <div class="col-3 mt-5">
                    <div class="nav flex-column nav-pills">
                        @if (Session::get('infor') == 'profile')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <a class="nav-link {{ $active }}" href="/my-profile/profile">Profile</a>


                    </div>
                    <div class="nav flex-column nav-pills">
                        @if (Session::get('infor') == 'orderhis')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif

                        <a class="nav-link {{ $active }}" href="/my-profile/orders">Order History</a>

                    </div>
                    <div class="nav flex-column nav-pills">

                        <a class="nav-link" href="#">Settings</a>

                    </div>
                    <div class="nav flex-column nav-pills">

                        <a class="nav-link" href="#">Messages</a>

                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content">
                        @yield('profiles')
                        @yield('orders')
                        @yield('orders-detail')
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>

</html>
