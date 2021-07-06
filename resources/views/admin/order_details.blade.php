@extends('templates.layout_admin');
@section('ordersDetails')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Orders <span class="text-uppercase">#{{ substr($ordersDetails['_id'], 20, 4) }}</span>
                        Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders <span
                                class="text-uppercase">#{{ substr($ordersDetails['_id'], 20, 4) }}</span> Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Main content -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Details</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            Order Date
                                        </td>
                                        <td>
                                            {{ date('d/m/Y', strtotime($ordersDetails['created_at'])) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Order Status</td>
                                        <td><?php if ($ordersDetails['status'] == 0) {
                                            echo "<span class='badge badge-warning'>Pending</span>";
                                            } elseif ($ordersDetails['status'] == 1) {
                                            echo "<span class='badge badge-danger'>Cancelled</span>";
                                            } elseif ($ordersDetails['status'] == 2) {
                                            echo "<span class='badge badge-primary'>Confirmed</span>";
                                            } elseif ($ordersDetails['status'] == 3) {
                                            echo "<span class='badge badge-info'>Delivery</span>";
                                            } else {
                                            echo "<span class='badge badge-success'>Completed</span>";
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Order Total</td>
                                        <td>{{ number_format($ordersDetails['grandTotal'], 0, ',', '.') }} VNĐ
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Charges</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Coupon Code</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Coupon Amount</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td>COD</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Delivery Address</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            Full Name
                                        </td>
                                        <td>
                                            {{ $ordersDetails['fullname'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email
                                        </td>
                                        <td>
                                            {{ $ordersDetails['email'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td>{{ $ordersDetails['phone'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>{{ $ordersDetails['city'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>{{ $ordersDetails['state'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>{{ $ordersDetails['country'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Full Address</td>
                                        <td>{{ $ordersDetails['fullAdd'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Customer Details</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            Name
                                        </td>
                                        <td>
                                            {{ $userDetails['name'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email
                                        </td>
                                        <td>
                                            {{ $userDetails['email'] }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Order Status</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td colspan=2>
                                            <input type="hidden" value="{{ $ordersDetails['_id'] }}" class="idOrder">
                                            <select class="form-control select2" name="order_status" id="val-status">
                                                <?php if ($ordersDetails['status'] == 0) {
                                                echo '<option>Select Status</option>
                                                <option selected value="0">Pending</option>
                                                <option value="1">Cancelled</option>
                                                <option value="2">Confirmed</option>
                                                <option value="3">Delivey</option>
                                                <option value="4">Completed</option>';
                                                } elseif ($ordersDetails['status'] == 1) {
                                                echo '<option>Select Status</option>
                                                <option value="0">Pending</option>
                                                <option selected value="1">Cancelled</option>
                                                <option value="2">Confirmed</option>
                                                <option value="3">Delivey</option>
                                                <option value="4">Completed</option>';
                                                } elseif ($ordersDetails['status'] == 2) {
                                                echo '<option>Select Status</option>
                                                <option value="0">Pending</option>
                                                <option value="1">Cancelled</option>
                                                <option selected value="2">Confirmed</option>
                                                <option value="3">Delivey</option>
                                                <option value="4">Completed</option>';
                                                } elseif ($ordersDetails['status'] == 3) {
                                                echo '<option>Select Status</option>
                                                <option value="0">Pending</option>
                                                <option value="1">Cancelled</option>
                                                <option value="2">Confirmed</option>
                                                <option selected value="3">Delivey</option>
                                                <option value="4">Completed</option>';
                                                } elseif ($ordersDetails['status'] == 4) {
                                                echo '<option>Select Status</option>
                                                <option value="0">Pending</option>
                                                <option value="1">Cancelled</option>
                                                <option value="2">Confirmed</option>
                                                <option value="3">Delivey</option>
                                                <option selected value="4">Completed</option>';
                                                } else {
                                                echo '<option selected>Select Status</option>
                                                <option value="0">Pending</option>
                                                <option value="1">Cancelled</option>
                                                <option value="2">Confirmed</option>
                                                <option value="3">Delivey</option>
                                                <option value="4">Completed</option>';
                                                } ?>
                                            </select> <br> <br>
                                            <button type="submit"
                                                class="btn btn-success form-control update-status">Update</button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ordered Products</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItems as $pro)
                                        <tr>
                                            <td><img src="../../images/{{ $pro->products['urlHinh'] }}" alt=""
                                                    width="70px" height="70px"></td>
                                            <td class="align-middle">{{ $pro->products['tenDT'] }}</td>
                                            <td class="align-middle">{{ $pro['qtyProd'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
