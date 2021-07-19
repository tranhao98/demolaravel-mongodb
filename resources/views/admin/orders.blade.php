@extends('templates.layout_admin');
@section('orders')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catalogues</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="card shadow" style="font-size: 13px">
                <div class="card-header">
                    <h3 class="card-title">Orders</h3>
                </div>
                <div class="card-body ">
                    <div class="row font-weight-bold">
                        <div class="col-md-1 align-self-center">
                            Order ID
                        </div>
                        <div class="col-md-1 align-self-center">
                            Order Date
                        </div>
                        <div class="col-md-2 align-self-center">
                            Customer Name
                        </div>
                        <div class="col-md-2 align-self-center">
                            Customer Email
                        </div>
                        <div class="col-md-2 align-self-center">
                            Ordered Products
                        </div>
                        <div class="col-md-2 align-self-center">
                            Order Amount
                        </div>
                        <div class="col-md-1 align-self-center">
                            Order Status
                        </div>
                        <div class="col-md-1 align-self-center">
                            Actions
                        </div>
                    </div>
                    <hr>

                    @foreach ($orders as $ord)
                        <div class="row product_data">
                            <div class="col-md-1 align-self-center">
                                <span class="text-uppercase">#{{ substr($ord['_id'], 20, 4) }}</span>
                            </div>
                            <div class="col-md-1 align-self-center">
                                {{ date('d/m/Y', strtotime($ord['created_at'])) }}
                            </div>
                            <div class="col-md-2 align-self-center">
                                {{ $ord['fullname'] }}
                            </div>
                            <div class="col-md-2 align-self-center">
                                {{ $ord['email'] }}
                            </div>
                            <div class="col-md-2 align-self-center">
                                {{ $ord->products['tenDT'] }}
                            </div>

                            <div class="col-md-2 align-self-center">
                                {{ number_format($ord['grandTotal'], 0, ',', '.') }} VNĐ
                            </div>
                            <div class="col-md-1 align-self-center">
                                <?php if ($ord['status'] == 0) {
                                echo "<span class='badge badge-warning'>Pending</span>";
                                } elseif ($ord['status'] == 1) {
                                echo "<span class='badge badge-danger'>Cancelled</span>";
                                } elseif ($ord['status'] == 2) {
                                echo "<span class='badge badge-primary'>Confirmed</span>";
                                } elseif ($ord['status'] == 3) {
                                echo "<span class='badge badge-info'>Delivery</span>";
                                } else {
                                echo "<span class='badge badge-success'>Completed</span>";
                                } ?>
                            </div>
                            <div class="col-md-1 align-self-center">
                                <a class="btn btn-link p-2" href="/admin/order-detail-{{$ord['_id']}}"><i class="fa fa-eye"
                                        style="font-size:20px"></i></a>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
