<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Order Detail</title>
</head>

<body>
    @extends('templates.tpl_default')
    @section('orders-detail')
        <h1 class="mt-4 mb-4">Order <span class="text-uppercase">#{{ substr($ordersDetails['_id'], 20, 4) }}</span>
            Details
        </h1>
        <div class="row">
            <div class="col-sm-6">
                <div class="card shadow">
                    <div class="card-body " style="font-size: 13.5px">
                        <div class="row font-weight-bold">
                            <div class="col-md-12 align-self-center">
                                <h5  class="font-weight-bold m-0">Order Details</h5>
                            </div>
                        </div>
                        <hr style="border: 1px solid">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Order Date</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ date('d/m/Y', strtotime($ordersDetails['created_at'])) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Order Status</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                <?php
                                if($ordersDetails['status'] == 0){
                                    echo "<span class='badge badge-warning'>Pending</span>";
                                }elseif($ordersDetails['status'] == 1){
                                    echo "<span class='badge badge-danger'>Cancelled</span>";
                                }elseif($ordersDetails['status'] == 2){
                                    echo "<span class='badge badge-primary'>Confirmed</span>";
                                }elseif($ordersDetails['status'] == 3){
                                    echo "<span class='badge badge-info'>Delivery</span>";
                                }else{
                                    echo "<span class='badge badge-success'>Completed</span>";
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Order Total</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ number_format($ordersDetails['grandTotal'], 0, ',', '.') }} VNĐ
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Shipping Charges</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                30.000 VNĐ
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Coupon Code</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{$ordersDetails['couponCode']}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Coupon Amount</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                               - {{ number_format($ordersDetails['couponAmount'], 0, ',', '.') }} VNĐ
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Payment Method</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                COD
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

            </div>
            <div class="col-6">
                <div class="card shadow">
                    <div class="card-body " style="font-size: 13.5px">
                        <div class="row font-weight-bold">
                            <div class="col-md-12 align-self-center">
                                <h5 class="font-weight-bold m-0">Delivery Address</h5>
                            </div>
                        </div>
                        <hr style="border: 1px solid">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Full Name</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ $ordersDetails['fullname'] }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Email</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ $ordersDetails['email'] }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Mobile</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ $ordersDetails['phone'] }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">City</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ $ordersDetails['city'] }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">State</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ $ordersDetails['state'] }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Country</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ $ordersDetails['country'] }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h6 class="m-0">Full Address</h6>
                            </div>
                            <div class="col-md-6 align-self-center">
                                {{ $ordersDetails['fullAdd'] }}
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-3" style="font-size: 15px">
            <div class="card-header">
                <div class="row font-weight-bold">
                    <div class="col-md-4 align-self-center">
                        Image
                    </div>
                    <div class="col-md-4 align-self-center">
                        Name Product
                    </div>
                    <div class="col-md-4 align-self-center">
                        Quantity
                    </div>
                </div>
            </div>
            <div class="card-body ">
                @php $subtotal = 0; @endphp
                @foreach ($orderItems as $item)
                    <div class="row product_data">
                        <div class="col-md-4 align-self-center">
                            <img src="../images/{{ $item->products['urlHinh'] }}" height="70px" width="70px" alt="">
                        </div>
                        <div class="col-md-4 align-self-center">
                            {{ $item->products['tenDT'] }}
                        </div>
                        <div class="col-md-4 align-self-center">
                            {{ $item['qtyProd'] }}
                        </div>
                    </div>
                    <hr>
                    @php $subtotal += $item['qtyProd'] * $item->products['giaKM'] @endphp
                @endforeach
            </div>
        </div>

    @endsection
</body>

</html>
