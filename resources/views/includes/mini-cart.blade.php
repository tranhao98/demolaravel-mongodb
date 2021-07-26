<?php
use App\Models\Cart;
$cartMenu = Cart::where('idUser', Auth::id())->get();
?>
<div class="total-cart">
    <ul class="m-0">
        <li>
            <a href="#">
                <span class="total-cart-number" id="totalCartNumber">
                    <div>{{ Cart::where('idUser', Auth::id())->count() }} Items</div>
                </span>
                <span class="icon-shopping-bag">
                    <i class="sp-shopping-bag"></i>
                </span>
            </a>
            <!-- Mini-cart-content Start -->
            @if (Cart::where('idUser', Auth::id())->count() > 0)
                <div class="total-cart-brief">
                    <?php $subtotal = 0; ?>
                    @foreach ($cartMenu as $cart)
                        <div class="cart-photo-details">
                            <div class="cart-photo">
                                <img src="../images/{{ $cart->products['urlHinh'] }}" alt="" width="50px"
                                        height="50px" />
                            </div>
                            <div class="cart-photo-brief">
                                <a style="font-size: 13px">{{ $cart->products['tenDT'] }} ({{ $cart['qtyProd'] }})</a>
                                <span>
                                    {{ number_format($cart->products['giaKM'] * $cart['qtyProd'], 0, ',', '.') }}
                                    VNĐ</span>
                            </div>
                        </div>
                        <?php $subtotal += $cart['qtyProd'] * $cart->products['giaKM']; ?>
                    @endforeach
                    <div class="cart-subtotal">
                        <p>Total = {{ number_format($subtotal, 0, ',', '.') }} VNĐ</p>
                    </div>
                    <div class="cart-inner-btm">
                        <a href="/cart">view cart</a>
                    </div>
                </div>
            @else
                <div class="total-cart-brief p-0">
                    <div class="alert alert-danger m-0">Don't have any products in cart</div>
                </div>
            @endif


            <!-- Mini-cart-content End -->
        </li>
    </ul>
</div>
