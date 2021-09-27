@extends('templates.layout_admin')
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

            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Orders</h3>
                </div>
                <div class="card-body">
                    <table id="orders" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Information</th>
                                <th>Customer Information</th>
                                <th>Order Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $ord)
                                <tr>
                                    <td class="align-middle"> 
                                        <span class="text-uppercase">#{{ substr($ord['_id'], 20, 4) }}</span>
                                    </td>
                                    <td class="align-middle"> 
                                        <span class="text-secondary font-weight-bold"> Order Date:</span> {{ date('d/m/Y', strtotime($ord['created_at'])) }}
                                        <br>
                                        <span class="text-secondary font-weight-bold"> Order Amount:</span> {{ number_format($ord['grandTotal'], 0, ',', '.') }} VNĐ
                                    </td>
                                    <td class="align-middle">
                                       <span class="text-secondary font-weight-bold">Customer Name:</span> {{ $ord['fullname'] }} <br> 
                                       <span class="text-secondary font-weight-bold">Customer Email:</span> {{ $ord['email'] }}
                                    </td>
                                    <td class="align-middle"> <?php if ($ord['status'] == 0) {
                                        echo "<span class='badge badge-warning'>Pending</span>";
                                        } elseif ($ord['status'] == 1) {
                                        echo "<span class='badge badge-secondary font-weight-bold'>Cancelled</span>";
                                        } elseif ($ord['status'] == 2) {
                                        echo "<span class='badge badge-primary'>Confirmed</span>";
                                        } elseif ($ord['status'] == 3) {
                                        echo "<span class='badge badge-info'>Delivery</span>";
                                        } else {
                                        echo "<span class='badge badge-success'>Completed</span>";
                                        } ?>

                                    </td>
                                    <td class="align-middle"> <a class="btn btn-link p-2" href="/admin/order-detail-{{$ord['_id']}}"><i class="fa fa-eye"
                                        style="font-size:20px"></i></a>

                                    </td>
            
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
