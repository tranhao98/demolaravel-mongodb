@extends('templates.layout_admin');
@section('coupons')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catalogues</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Coupons</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
                    {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card shadow" style="font-size: 12px">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                    <a href="/admin/add-edit-coupon" style="width: 150px" class="float-right btn btn-success pl-4 pr-4"> Add
                        Coupon</a>
                </div>
                <div class="card-body ">
                    <div class="row font-weight-bold">
                        <div class="col-md-1 align-self-center">
                            ID
                        </div>
                        <div class="col-md-1 align-self-center">
                            Name
                        </div>
                        <div class="col-md-1 align-self-center">
                            Gender
                        </div>
                        <div class="col-md-1 align-self-center">
                            Birth Date
                        </div>
                        <div class="col-md-1 align-self-center">
                            Mobile
                        </div>
                        <div class="col-md-2 align-self-center">
                            Email
                        </div>
                        <div class="col-md-1 align-self-center">
                            City
                        </div>
                        <div class="col-md-1 align-self-center">
                            State
                        </div>
                        <div class="col-md-1 align-self-center">
                            Country
                        </div>
                        <div class="col-md-1 align-self-center">
                            Address
                        </div>
                        <div class="col-md-1 align-self-center">
                            Actions
                        </div>
                    </div>
                    <hr>
                    @foreach ($users as $user)
                        <div class="row user_data">
                            <div class="col-md-1 align-self-center">
                                <span class="text-uppercase">#{{ substr($user['_id'], 20, 4) }}</span>
                            </div>
                            <div class="col-md-1 align-self-center">
                                {{ $user['name'] }}
                            </div>
                            <div class="col-md-1 align-self-center">
                                @if (isset($user['gender']))
                                    <?= $user['gender'] == 1 ? 'Male' : 'Female' ?>
                                @endif
                            </div>
                            <div class="col-md-1 align-self-center">
                                {{ $user['birthdate'] }}
                            </div>
                            <div class="col-md-1 align-self-center">
                                {{ $user['mobile'] }}
                            </div>
                            <div class="col-md-2 align-self-center">
                                {{ $user['email'] }}
                            </div>
                            <div class="col-md-1 align-self-center">
                                {{ $user['city'] }}
                            </div>
                            <div class="col-md-1 align-self-center">
                                {{ $user['state'] }}
                            </div>
                            <div class="col-md-1 align-self-center">
                                {{ $user['country'] }}
                            </div>
                            <div class="col-md-1 align-self-center">
                                {{ $user['address'] }}
                            </div>
                            <div class="col-md-1 align-self-center">
                                <input type="hidden" value="{{ $user['_id'] }}" class="idUser">
                                @if ($user['status'] == 1)
                                    <a class="update-user-status" id="user-{{$user['_id']}}" href="#"><i status="0"
                                            class="fa fa-toggle-on" style="font-size:14px"></i></a>
                                @else

                                    <a class="update-user-status" id="user-{{$user['_id']}}" href="#"><i status="1"
                                            class="fa fa-toggle-off" style="font-size:14px"></i></a>
                                @endif
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
