$(document).ready(function() {
    $('.addToCartBtn').click(function(e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find('.idProd').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function(response) {
                Swal.fire(response.status);
            }
        });

    });

    $('.increment-btn').click(function(e) {
        e.preventDefault();
        var key = $(this).attr('data');
        var cartqty = $('#qty-input_' + key).val();
        $('#qty-input_' + key).val(parseInt(cartqty) + 1);
        updatecart(key, parseInt(cartqty) + 1);
    });
    $('.decrement-btn').click(function(e) {
        e.preventDefault();

        var key = $(this).attr('data');
        var cartqty = $('#qty-input_' + key).val();
        $('#qty-input_' + key).val(parseInt(cartqty) - 1);
        updatecart(key, parseInt(cartqty) - 1);
    });

    function updatecart(key, qty) {
        $.ajax({
            url: "updatecart/" + key + "/" + qty,
            success: function(response) {
                location.reload();
            }
        });
    }
    $('.delete-cart-item').click(function(e) {
        e.preventDefault();
        var prod_id = $(this).closest('.product_data').find('.idProd').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                'prod_id': prod_id,
            },
            success: function(response) {
                window.location.reload();
                Swal.fire('', response.status, 'success')
            }
        });
    });
});