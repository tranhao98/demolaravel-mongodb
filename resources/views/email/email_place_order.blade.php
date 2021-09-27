<h2>Order Detail</h2> <br>
<h4>Full Name: </h4>{{ $fullname }} <br>
<h4>Email: </h4>{{ $email }} <br>
<h4>Phone Number: </h4>{{ $phone }} <br>
<h4>City: </h4>{{ $city }} <br>
<h4>State: </h4>{{ $state }} <br>
<h4>Country: </h4>{{ $country }} <br>
<h4>Full Address: </h4>{{ $fulladd }} <br>
<h4>Grand Total: </h4>{{ $grandtotal }} VNĐ <br>
<table style="width: 100%; border: 1px solid #e8e8e8; border-collapse: collapse;">
    <thead>
        <tr>
            <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">Image</td>
            <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">Name Product</td>
            <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">Unit Price</td>
            <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">Quantity</td>
            <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">Sub Total</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $prod)
            <tr>
                <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;"><img class="image_prod_checkout" src="{{ url('/images/') }}/{{ $prod->products['urlHinh'] }}"
                        height="70px" width="70px" alt=""></td>
                <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">{{ $prod['product_name'] }}</td>
                <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">{{ number_format($prod['product_price'], 0, ',', '.') }} VNĐ</td>
                <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">{{ $prod['product_qty'] }}</td>
                <td style="border: 1px solid #e8e8e8;text-align: left;padding: 8px;">{{ number_format($prod['product_qty'] * $prod['product_price'], 0, ',', '.') }}
                    VNĐ</td>
            </tr>
        @endforeach
    </tbody>
</table>
