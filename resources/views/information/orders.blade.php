<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\infoUser;
?>
    @extends('my-profile')
    @section('orders')
    @if(infoUser::where('idUser', Auth::id())->count() > 0)
    <div class="mt-4 mb-4 text-center">
        <h4 class="text-uppercase font-weight-bold ">Order History</h4>
        <img src="../images/line-dec.png" alt="">
    </div>
        <div class="card shadow" style="font-size: 13px">
            <div class="card-header">
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
            </div>
            <div class="card-body ">
                @foreach ($orders as $ord)
                    <div class="row product_data">
                        <div class="col-md-3 align-self-center">
                            <span class="text-uppercase">#{{ substr($ord['_id'], 20, 4)}}</span>
                        </div>
                        <div class="col-md-3 align-self-center">
                            {{ number_format($ord['grandTotal'], 0, ',', '.') }} VNĐ
                        </div>
                        <div class="col-md-3 align-self-center">
                            {{date('d/m/Y', strtotime($ord['created_at']))}}
                        </div>
                        <div class="col-md-3 align-self-center">
                            <a class="btn btn-link p-2" href="/my-profile/order-{{$ord['_id']}}/">View Details</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
        @else
        <div class="alert alert-danger p-2 text-center text-uppercase font-weight-bold">
            <h1 class="mt-2">Don't have any orders</h1>
        </div>
        <div class="text-center">
            <a href="/home"><button class="w-100 border btn btn-light p-4 text-uppercase font-weight-bold"
                    style="font-size: 17px;">Continue Shopping</button></a>
        </div>
        @endif
    @endsection

