<?php
use App\Models\Cart;
$cartMenu = Cart::where('idUser', Auth::id())->get();
?>
<div class="total-cart">
    <ul class="m-0">
        <li>
            <a href="#">
                <span class="total-cart-number"
                    id="totalCartNumber"><div>{{Cart::where('idUser',Auth::id())->count()}} Items</div></span>
                <span><i class="sp-shopping-bag"></i></span>
            </a>
            <!-- Mini-cart-content Start -->

            <div class="total-cart-brief">
                @if (Cart::where('idUser', Auth::id())->count() > 0)
                    <?php $subtotal = 0; ?>
                    @foreach ($cartMenu as $cart)
                        <div class="cart-photo-details">
                            <div class="cart-photo">
                                <a><img src="../images/{{ $cart->products['urlHinh'] }}" alt=""
                                        width="50px" height="50px" /></a>
                            </div>
                            <div class="cart-photo-brief">
                                <a>{{ $cart->products['tenDT'] }} ({{ $cart['qtyProd'] }})</a>
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
                @else
                    <div class="alert alert-danger">Don't have any products in cart</div>
                @endif
            </div>

            <!-- Mini-cart-content End -->
        </li>
    </ul>
</div>