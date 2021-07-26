<div class="card shadow">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title w-100">Coupons</h3>
        <a href="/admin/add-edit-coupon" style="width: 150px" class="btn btn-success pl-4 pr-4"> Add
            Coupon</a>
    </div>
    <div class="card-body">
        <table id="coupons" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Code Type</th>
                    <th>Amount</th>
                    <th class="text-nowrap">Expiry Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coup)
                    <tr>
                        <td> <span class="text-uppercase">#{{ substr($coup['_id'], 20, 4) }}</span></td>
                        <td> {{ $coup['coupon_code'] }}</td>
                        <td>
                            {{ $coup['coupon_type'] }}
                        </td>
                        <td> {{ number_format($coup['amount'], 0, ',', '.') }}
                            @if ($coup['amount_type'] == 'Percentage')
                                %
                            @else
                                VNĐ
                            @endif
                        </td>
                        <td> {{ $coup['expiry_date'] }}</td>
                        <td class="coupons_data"> <a href="/admin/add-edit-coupon/{{ $coup['_id'] }}"><i class="fa fa-edit"
                                    style="font-size:18px"></i></a>&nbsp;&nbsp;
                            <a class="delete-coupon" href="#"><i class="fa fa-trash"
                                    style="font-size:18px"></i></a>&nbsp;&nbsp;

                            <input type="hidden" value="{{ $coup['_id'] }}" class="idCoupon">
                            @if ($coup['status'] == 1)
                                {{-- <input type="hidden" value="Active" class="updateCouponStatus"> --}}
                                <a class="update-coupon-status" id="coupon-{{ $coup['_id'] }}" href="#"><i status="0"
                                        class="fa fa-toggle-on" style="font-size:18px"></i></a>
                            @else

                                <a class="update-coupon-status" id="coupon-{{ $coup['_id'] }}" href="#"><i status="1"
                                        class="fa fa-toggle-off" style="font-size:18px"></i></a>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
