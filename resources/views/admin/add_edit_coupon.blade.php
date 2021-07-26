@extends('templates.layout_admin')
@section('add-edit-coupon')

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
            <form action="/admin/add-edit-coupon/{{$coupon['_id']}}" method="POST">
                @csrf
                <div class="card shadow" style="font-size: 15px">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="card-tools float-right">
                            <a href="/admin/coupons"><button type="button" class="btn btn-tool">
                                    <i class="fas fa-minus"></i>
                                </button></a>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                            </button>
                        </div>
                    </div>

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-sm-6">
                                @if(empty($coupon['coupon_code']))
                                <div class="form-group">
                                    <label for="coupon_option">Coupon Option</label> <br>
                                    <span><input checked type="radio" id="AutomaticCoupon" name="coupon_option"
                                            value="Automatic">&nbsp;Automatic</span>&nbsp;&nbsp;
                                    <span><input type="radio" id="ManualCoupon" name="coupon_option"
                                            value="Manual">&nbsp;Manual</span>&nbsp;&nbsp;
                                </div>
                                <div class="form-group" style="display:none" id="couponField">
                                    <label for="coupon_code">Coupon Code</label>
                                    <input type="text" class="form-control" name="coupon_code" id="coupon_code"
                                        placeholder="Enter Coupon Code">
                                </div>
                                @else
                                <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                                <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">
                                <div class="form-group">
                                    <label for="coupon_code">Coupon Code: </label>
                                    <span style="font-weight: bold; font-size: 24px">{{$coupon['coupon_code']}}</span>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="coupon_type">Coupon Type</label> <br>
                                    <span><input type="radio" id="multipletimes" name="coupon_type"
                                            value="Multiple Times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type'] == "Multiple Times") checked @elseif(!isset($coupon['coupon_type'])) checked @endif>&nbsp;Multiple
                                        Times</span>&nbsp;&nbsp;
                                    <span><input type="radio" id="singletimes" name="coupon_type"
                                            value="Single Times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type'] == "Single Times") checked @endif>&nbsp;Single
                                        Times</span>&nbsp;&nbsp;
                                </div>
                                <div class="form-group">
                                    <label for="amount_type">Amount Type</label> <br>
                                    <span><input type="radio" id="percentage" checked name="amount_type"
                                            value="Percentage" @if(isset($coupon['amount_type'])&&$coupon['amount_type'] == "Percentage") checked @elseif(!isset($coupon['amount_type'])) checked @endif>&nbsp;Percentage</span>&nbsp;(in
                                    %)&nbsp;
                                    <span><input type="radio" id="fixed" name="amount_type"
                                            value="Fixed" @if(isset($coupon['amount_type'])&&$coupon['amount_type'] == "Fixed") checked @endif>&nbsp;Fixed</span>&nbsp;(in
                                    VND
                                    or
                                    USD)&nbsp;
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" name="amount" id="amount"
                                        placeholder="Enter Amount" @if(isset($coupon['amount'])) value={{$coupon['amount']}} @endif >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="categories">Select Categories</label>
                                    <select name="categories[]" id="categories" multiple=""
                                        class="w-100 form-control select2">
                                        <option value="">Select</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat['_id'] }}" @if(in_array($cat['_id'],$selCats)) selected @endif>{{ $cat['tenNSX'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="users">Select Users</label>
                                    <select name="users[]" id="users" multiple="" class="w-100 form-control select2">
                                        <option value="">Select</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user['email'] }}" @if(in_array($user['email'], $selUsers)) selected @endif>{{ $user['email'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="text" class="form-control" data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd-mm-yyyy" data-mask name="expiry_date"
                                        id="expiry_date" placeholder="Enter Expiry Date" @if(isset($coupon['expiry_date'])) value={{$coupon['expiry_date']}} @endif>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </div>

@endsection
