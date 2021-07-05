<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Orders;
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cart</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('orders')

        <div class="card shadow" style="font-size: 13px">
            <div class="card-body ">
                <div class="row font-weight-bold">
                    <div class="col-md-3 align-self-center">
                        Order ID
                    </div>
                    <div class="col-md-3 align-self-center">
                        Grand Total
                    </div>
                    <div class="col-md-3 align-self-center">
                        Created on
                    </div>
                    <div class="col-md-3 align-self-center">
                        Order Details
                    </div>
                </div>
                <hr>

                @foreach ($orders as $ord)
                    <div class="row product_data">
                        <div class="col-md-3 align-self-center">
                            <span class="text-uppercase">{{ substr($ord['_id'], 20, 4)}}</span>
                        </div>
                        <div class="col-md-3 align-self-center">
                            {{ number_format($ord['grandTotal'], 0, ',', '.') }} VNĐ
                        </div>
                        <div class="col-md-3 align-self-center">
                            {{date('d/m/Y', strtotime($ord['created_at']))}}
                        </div>
                        <div class="col-md-3 align-self-center">
                            <a class="btn btn-link p-2" href="{{$ord['_id']}}">View Details</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    @endsection
</body>

</html>
