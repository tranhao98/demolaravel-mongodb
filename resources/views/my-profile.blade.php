<title>Profile</title>
@extends('templates.tpl_default')
@section('profile')
    <div id="banner" class=" py-3 mb-4 shadow-sm bg-warning">
        <div class="container">
            <h6 class="m-0 font-weight-bold"><a class="text-dark" href="/home">Home</a> / My Profile</h6>
        </div>
    </div>
    <div class="container mb-4" style="min-height: 100%">
        <div class="row">
            <div class="col-3 width_profile_menu">
                <div class="nav flex-column nav-pills float_left_profile">
                    @if (Session::get('infor') == 'profile')
                        <?php $active = 'active'; ?>
                    @else
                        <?php $active = ''; ?>
                    @endif
                    <a class="nav-link {{ $active }}" href="/my-profile/profile">Profile</a>

                </div>
                <div class="nav flex-column nav-pills float_left_profile">
                    @if (Session::get('infor') == 'orderhis')
                        <?php $active = 'active'; ?>
                    @else
                        <?php $active = ''; ?>
                    @endif

                    <a class="nav-link {{ $active }}" href="/my-profile/orders">Order History</a>

                </div>
                <div class="nav flex-column nav-pills float_left_profile">

                    <a class="nav-link" href="#">Settings</a>

                </div>
                <div class="nav flex-column nav-pills float_left_profile">

                    <a class="nav-link" href="#">Messages</a>

                </div>
            </div>
            <div class="col-9 align-self-top width_profile">
                <div class="tab-content">
                    @yield('edit-contact-infor')
                    @yield('edit-basic-infor')
                    @yield('profiles')
                    @yield('orders')
                    @yield('orders-detail')
                </div>
            </div>
        </div>
    </div>
@endsection
