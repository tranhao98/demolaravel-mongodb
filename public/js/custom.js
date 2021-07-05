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
            url: "../add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    position: 'top-end',
                    title: response.status,
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(function() { location.reload(); }, 800);
                if (response.status == "plsLogin") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login to Continue'
                    })
                }
            }
        });

    });

    $('.increment-btn').click(function(e) {
        e.preventDefault();
        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    $('.decrement-btn').click(function(e) {
        e.preventDefault();

        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    $('.qty-input').on('change', function() {
        var prod_id = $(this).closest('.product_data').find('.idProd').val();
        var quantity = $(this).closest('.product_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "update-cart-item",
            data: {
                'prod_id': prod_id,
                'quantity': quantity,
            },
            success: function(response) {
                setTimeout(function() { location.reload(); }, 1500);
                if (response.status == "Quantity is required") {
                    Swal.fire({
                        icon: 'error',
                        title: response.status
                    })
                    setTimeout(function() { location.reload(); }, 1500);
                }
                if (response.status == "plsLogin") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login to Continue'
                    })
                    setTimeout(function() { location.reload(); }, 1500);
                }
            }
        });
    })
    $('.delete-cart-item').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
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
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        setTimeout(function() { location.reload(); }, 1700);
                    }
                });
            }
        })
    });
    $('.changeQty').click(function(e) {
        e.preventDefault();
        var prod_id = $(this).closest('.product_data').find('.idProd').val();
        var quantity = $(this).closest('.product_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "update-cart-item",
            data: {
                'prod_id': prod_id,
                'quantity': quantity,
            },
            success: function(response) {
                setTimeout(function() { location.reload(); }, 100);
            }
        });
    });
    $('.place-order').click(function(e) {
        e.preventDefault();
        var FullName = $('#fullName').val();
        var Email = $('#email').val();
        var Phone = $('#phoneNumber').val();
        var City = $('#cityName').val();
        var State = $('#state').val();
        var Country = $('#country').val();
        var FullAdd = $('#FullAdd').val();
        var GrandTotal = $('.grandTotal').val();
        var idProd = $('.idProd').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "place-order",
            data: {
                'fullName': FullName,
                'email': Email,
                'phone': Phone,
                'city': City,
                'state': State,
                'country': Country,
                'fullAdd': FullAdd,
                'grandTotal': GrandTotal,
                'idProd': idProd
            },
            success: function(response) {

                Swal.fire({
                    icon: 'error',
                    title: response.status
                })
                if (response.status == "Paid") {
                    Swal.fire(
                        'Thanks for your shopping!',
                        'Your shopping basket has been paid!',
                        'success'
                    )
                    setTimeout(function() { window.location.href = "/home"; }, 3000);
                }
            }
        });
    });
});