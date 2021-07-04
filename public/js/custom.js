const { extendWith } = require("lodash");

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
                    position: 'top-end',
                    title: response.status,
                    showConfirmButton: false,
                    timer: 1500
                })
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
                window.location.reload();
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
                window.location.reload();
            }
        });
    });
    $('.place-order').click(function(e) {
        e.preventDefault();
        // var fullName = $(this).closest('.form-checkout').find('#fullName').val();
        // var email = $(this).closest('.form-checkout').find('#email').val();
        // var phoneNumber = $(this).closest('.form-checkout').find('#phoneNumber').val();
        // var cityName = $(this).closest('.form-checkout').find('#cityName').val();
        // var state = $(this).closest('.form-checkout').find('#state').val();
        // var country = $(this).closest('.form-checkout').find('#country').val();
        // var fullAdd = $(this).closest('.form-checkout').find('#fullAdd').val();
        alert('111');
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     method: "POST",
        //     url: "place-order",
        //     data: {
        //         'fullname': fullName,
        //         'email': email,
        //         'phone': phoneNumber,
        //         'city': cityName,
        //         'state': state,
        //         'country': country,
        //         'fullAdd': fullAdd,
        //     },
        //     success: function(response) {
        //         alert(response.status);
        //     }
        // });
    });
});