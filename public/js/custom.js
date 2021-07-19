$(document).ready(function() {

    //Add product to cart
    $(document).on('click', '.addToCartBtn', function() {

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
                $('#AppendCartNumber').html(response.number);
                if (response.status == "plsLogin") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login to Continue',

                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/login';
                        }
                    });
                }
            }
        });

    });

    // Delete Cart
    $(document).on('click', '.delete-cart-item', function() {
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
                            'Product has been deleted.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                $("#AppendCartItems").html(response.view);
                                window.location.reload();
                            }
                        });
                    }
                });
            }
        })
    });

    //Button increment and decrement quantity product
    $(document).on('click', '.increment-btn', function() {

        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    $(document).on('click', '.decrement-btn', function() {
        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    //Update Cart
    $(document).on('click', '.changeQty', function() {
        if ($(this).hasClass('decrement-btn')) {
            var quantity = $(this).closest('.product_data').find('.qty-input').val();
            if (quantity <= 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Item quantity must be 1 or greater!',
                })
                return false;
            } else {
                new_qty = parseInt(quantity) - 1;
            }
        }
        if ($(this).hasClass('increment-btn')) {
            var quantity = $(this).closest('.product_data').find('.qty-input').val();
            new_qty = parseInt(quantity) + 1;
        }
        var prod_id = $(this).closest('.product_data').find('.idProd').val();
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
                'quantity': new_qty,
            },
            success: function(response) {
                $("#AppendCartItems").html(response.view);
                if (response.status == "Quantity is required") {
                    Swal.fire({
                        icon: 'error',
                        title: response.status,
                        showConfirmButton: false,
                    })
                }
            }
        });
    });

    // Checkout
    $(document).on('click', '.place-order', function() {
        var FullName = $('#fullName').val();
        var Email = $('#email').val();
        var Phone = $('#phoneNumber').val();
        var City = $('#cityName').val();
        var State = $('#state').val();
        var Country = $('#country').val();
        var FullAdd = $('#FullAdd').val();
        var GrandTotal = $('.grandTotal').val();
        var idProd = $('.idProd').val();
        var qtyProd = $('.qtyProd').val();
        var couponCode = $('.couponCode').val();
        var couponAmount = $('.couponAmount').val();
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
                'idProd': idProd,
                'qtyProd': qtyProd,
                'couponCode': couponCode,
                'couponAmount': couponAmount
            },
            success: function(response) {

                Swal.fire({
                    icon: 'error',
                    title: response.status
                })
                if (response.status == "Paid") {
                    Swal.fire(
                        'Your order has been successfully placed!',
                        'Please check your order.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/home";
                        }
                    });

                }
            }
        });
    });

    // Change Order Status in ADMIN
    $(document).on('click', '.update-status', function() {
        var status = $('#val-status').val();
        var idOrder = $('.idOrder').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "update-order-status",
            data: {
                'status': status,
                'idOrder': idOrder
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    position: 'top-end',
                    title: response.status,
                    showConfirmButton: false,
                    timer: 1000
                })
                $('#AppendOrderStatus').html(response.view);
            }
        });
    });

    //Change Coupon Status in ADMIN
    $(document).on('click', '.update-coupon-status', function() {
        var couponStatus = $(this).children("i").attr("status");
        var idCoupon = $(this).closest('.coupon_data').find('.idCoupon').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "update-coupon-status",
            data: {
                'status': couponStatus,
                'idCoupon': idCoupon
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    position: 'top-end',
                    title: response.status,
                    showConfirmButton: false,
                    timer: 1000
                })
                if (response.view == 0) {
                    $('#coupon-' + idCoupon).html('<i status="1" class="fa fa-toggle-off" style="font-size:18px"></i>');
                } else if (response.view == 1) {
                    $('#coupon-' + idCoupon).html('<i status="0" class="fa fa-toggle-on" style="font-size:18px"></i>');
                }
                // if ()
            }
        });
    });

    // Show or Hide Coupon Code in ADMIN
    $(document).on('click', '#ManualCoupon', function() {
        $('#couponField').show();
    });
    $(document).on('click', '#AutomaticCoupon', function() {
        $('#couponField').hide();
    });

    // Delete Coupon in ADMIN
    $(document).on('click', '.delete-coupon', function() {

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
                var idCoupon = $(this).closest('.coupon_data').find('.idCoupon').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "delete-coupon",
                    data: {
                        'idCoupon': idCoupon,
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Coupon has been deleted.',
                            'success'
                        )
                        $('#AppendCouponItems').html(response.view);
                    }
                });
            }
        })
    });

    // Delete Post in ADMIN
    $(document).on('click', '.delete-post', function() {

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
                var idPost = $(this).closest('.post_data').find('.idPost').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "delete-post",
                    data: {
                        'idPost': idPost,
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your post has been deleted.',
                            'success'
                        )
                        $('#AppendPostItems').html(response.view);
                    }
                });
            }
        })
    });

    // Apply Coupon Code
    $(document).on('submit', '#applyCoupon', function() {

        var code = $('#couponCode').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "apply-coupon",
            data: {
                code: code
            },
            success: function(response) {

                Swal.fire({
                    icon: 'error',
                    text: response.message,
                })
                if (response.status == "1") {
                    Swal.fire({
                        icon: 'success',
                        text: 'Coupon code successfully applied. You are availing discount!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#AppendCartCheckout").html(response.view);
                        }
                    });
                }
            },
            error: function() {
                alert('Error');
            }
        });
    });

    // Change Coupon code
    $(document).on("submit", '#changeCoupon', function(e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "change-coupon",
                    success: function(response) {
                        Swal.fire(
                            'Removed!',
                            'Coupon code has been removed.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                $("#AppendCartCheckout").html(response.view);
                            }
                        });
                    }
                });
            }
        })
    });

    //Change User Status in ADMIN
    $(document).on("click", '.update-user-status', function(e) {

        var userStatus = $(this).children("i").attr("status");
        var idUser = $(this).closest('.user_data').find('.idUser').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "update-user-status",
            data: {
                'status': userStatus,
                'idUser': idUser
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    position: 'top-end',
                    title: response.status,
                    showConfirmButton: false,
                    timer: 1000
                })
                if (response.view == 0) {
                    $('#user-' + idUser).html('<i status="1" class="fa fa-toggle-off" style="font-size:14px"></i>');
                } else if (response.view == 1) {
                    $('#user-' + idUser).html('<i status="0" class="fa fa-toggle-on" style="font-size:14px"></i>');
                }
            }
        });
    });

    // Update Basic Information
    $(document).on("click", '.update-basic-infor', function(e) {
        var name = $('#name').val();
        var gender = $('#gender').val();
        var birthdate = $('#birthdate').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var country = $('#country').val();
        var address = $('#address').val();
        var idUser = $('#idUser').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "update-basic",
            data: {
                name: name,
                gender: gender,
                birthdate: birthdate,
                city: city,
                state: state,
                country: country,
                address: address,
                idUser: idUser,
            },
            success: function(response) {

                Swal.fire({
                    icon: 'error',
                    title: response.status
                })
                if (response.status == "Success") {
                    Swal.fire({
                        icon: 'success',
                        text: 'Your profile has been successfully updated!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/my-profile";
                        }
                    });
                }
            }
        });

    });

    // Update Contact Information
    $(document).on("click", '.update-contact-infor', function(e) {
        var mobile = $('#mobile').val();
        var idUser = $('#idUser').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "update-contact",
            data: {
                mobile: mobile,
                idUser: idUser
            },
            success: function(response) {

                Swal.fire({
                    icon: 'error',
                    title: response.status
                })
                if (response.status == "Success") {
                    Swal.fire({
                        icon: 'success',
                        text: 'Your profile has been successfully updated!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/my-profile";
                        }
                    });
                }
            }
        });

    });
    $("#tabs").tabs();
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
});
//branch Carousel
$('.branch-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 1200,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 3
        }
    }
})

//product Carousel
$('.product-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 1500,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 3
        }
    }
});
$.scrollUp({
    scrollText: '<i class="pe-7s-angle-up"></i>',
    easingType: 'linear',
    scrollSpeed: 900,
    animation: 'fade'
});
$(window).on("load", function() {
    $(".loader-wrapper").fadeOut("slow");
})