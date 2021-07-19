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