<div class="card shadow" style="font-size: 15px">
    <div class="card-header">
        <h3 class="card-title">Coupons</h3>
        <a href="/admin/add-edit-coupon" style="width: 150px" class="float-right btn btn-success pl-4 pr-4"> Add
            Coupon</a>
    </div>
    <div class="card-body ">
        <div class="row font-weight-bold">
            <div class="col-md-2 align-self-center">
                ID
            </div>
            <div class="col-md-2 align-self-center">
                Code
            </div>
            <div class="col-md-2 align-self-center">
                Coupon Type
            </div>
            <div class="col-md-2 align-self-center">
                Amount
            </div>
            <div class="col-md-2 align-self-center">
                Expiry Date
            </div>
            <div class="col-md-2 align-self-center">
                Actions
            </div>
        </div>
        <hr>

        @foreach ($coupons as $coup)
            <div class="row coupon_data">
                <div class="col-md-2 align-self-center">
                    <span class="text-uppercase">#{{ substr($coup['_id'], 20, 4) }}</span>
                </div>
                <div class="col-md-2 align-self-center">
                    {{ $coup['coupon_code'] }}
                </div>
                <div class="col-md-2 align-self-center">
                    {{ $coup['coupon_type'] }}
                </div>
                <div class="col-md-2 align-self-center">
                    {{ number_format($coup['amount'], 0, ',', '.') }}
                    @if ($coup['amount_type'] == 'Percentage')
                        %
                    @else
                        VNĐ
                    @endif
                </div>
                <div class="col-md-2 align-self-center">
                    {{ $coup['expiry_date'] }}
                </div>
                <div class="col-md-2 align-self-center">
                    <a href="/admin/add-edit-coupon/{{$coup['_id'] }}"><i class="fa fa-edit" style="font-size:18px"></i></a>&nbsp;&nbsp;
                    <a class="delete-coupon" href="#"><i class="fa fa-trash" style="font-size:18px"></i></a>&nbsp;&nbsp;

                    <input type="hidden" value="{{ $coup['_id'] }}" class="idCoupon">
                    @if ($coup['status'] == 1)
                        {{-- <input type="hidden" value="Active" class="updateCouponStatus"> --}}
                        <a class="update-coupon-status" id="coupon-{{ $coup['_id'] }}"  href="#"><i status="0" class="fa fa-toggle-on"
                                style="font-size:18px"></i></a>
                    @else
                    
                        <a class="update-coupon-status" id="coupon-{{ $coup['_id'] }}"  href="#"><i status="1" class="fa fa-toggle-off"
                                style="font-size:18px"></i></a> 
                    @endif
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</div>