$(document).ready(function() {

    //loading screen
    $(".loader-wrapper").fadeOut("slow");

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
                                $('#AppendCartNumber').html(response.number);
                            }
                        });
                        $("#AppendCartItems").html(response.view);
                        $('#AppendCartNumber').html(response.number);
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
        if ($(this).hasClass('dec-btn')) {
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
        if ($(this).hasClass('inc-btn')) {
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
        var couponCode = $('.couponCode').val();
        var couponAmount = $('.couponAmount').val();
        var spinner = '<div class="spinner-border mr-2" role="status"><span class="sr-only">Loading...</span></div>';

        $('#btn_place_order').attr('disabled', true);
        $('#btn_place_order').html(spinner);
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
                'couponCode': couponCode,
                'couponAmount': couponAmount
            },
            success: function(response) {
                $('#btn_place_order').attr('disabled', false);
                $('#btn_place_order').html('<h6 class="m-0 font-weight-bold">Place order</h6>');
                Swal.fire({
                    icon: 'error',
                    title: response.status
                })
                if (response.status == "Paid") {
                    Swal.fire(
                        'Your order has been placed successfully!',
                        'Your order number is #' + response.numberOrder + ' and grand total is ' + response.grandTotal + ' VN??',
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
    // Apply Coupon Code Table
    $(document).on('submit', '#applyCoupon_table', function() {
        var code = $('#couponCode_table').val();
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

    // Change Coupon code table
    $(document).on("submit", '#changeCoupon_table', function(e) {
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
    //Comments in post detail

    //save comment
    $(document).on("submit", '#saveComment', function(e) {
        var comment = $('#message').val();
        var idPost = $('#idPost').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "../save-comment",
            data: {
                comment: comment,
                idPost: idPost
            },
            success: function(response) {
                if (response.status == 'Required') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Message is required'
                    });
                }
                $('#AppendNumberComment').html(response.numberComment);
                $("#AppendPostComment").html(response.view);
                if (response.status == 'plsLogin') {
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

    //form edit comment
    $(document).on("click", '.btn_edit_cmt', function(e) {
        var idCmt = $(this).closest('.right-content').find('#idCmt').val();
        var idPost = $('#idPost').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "../form-edit-comment",
            data: {
                idCmt: idCmt,
                idPost: idPost
            },
            success: function(response) {
                $('#AppendNumberComment').html(response.numberComment);
                $("#AppendPostComment").html(response.view);
            }
        });
    });

    //edit comment
    $(document).on("submit", '#editComment', function(e) {
        var editCmt = $('#message_edit').val();
        var idCmt = $(this).closest('.right-content').find('#idCmt').val();
        var idPost = $('#idPost').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "../edit-comment",
            data: {
                idCmt: idCmt,
                editCmt: editCmt,
                idPost: idPost
            },
            success: function(response) {
                if (response.status == 'Required') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Message is required'
                    });
                }
                $('#AppendNumberComment').html(response.numberComment);
                $("#AppendPostComment").html(response.view);
            }
        });
    });
    //delete comment
    $(document).on("click", '.btn_delete_cmt', function(e) {
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
                var idCmt = $(this).closest('.right-content').find('#idCmt').val();
                var idPost = $('#idPost').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "../delete-comment",
                    data: {
                        idCmt: idCmt,
                        idPost: idPost
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Product has been deleted.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                $('#AppendNumberComment').html(response.numberComment);
                                $("#AppendPostComment").html(response.view);
                            }
                        });
                        $('#AppendNumberComment').html(response.numberComment);
                        $("#AppendPostComment").html(response.view);
                    }
                });
            }
        })

    });

    //load more comment
    load_more_comment();

    function load_more_comment(idComment = '') {
        var idPost = $('#idPost').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "../load-more-comment",
            data: {
                idPost: idPost,
                idComment: idComment
            },
            success: function(response) {
                $('#load_more_btn').remove();
                $('#AppendPostComment').append(response);
            }
        });
    }
    $(document).on("click", '#load_more_btn', function(e) {
        var idComment = $(this).data('id');
        load_more_comment(idComment);
    });

    //quick contact
    $(document).on("submit", '#contact_form', function(e) {
        var email = $('#email_contact').val();
        var message = $('.message').val();

        var spinner = '<div class="spinner-border mr-2" role="status"><span class="sr-only">Loading...</span></div> Sending...';

        $('#btn_contact_form').attr('disabled', true);
        $('#btn_contact_form').html(spinner);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            url: "../quick-contact",
            data: {
                email: email,
                message: message
            },
            success: function(response) {
                $('#btn_contact_form').attr('disabled', false);
                $('#btn_contact_form').text('submit');
                if (response.status == '3') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successful submission, we will contact you as soon as possible!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#AppendContactForm').html(response.view);
                        }
                    });
                    $('#AppendContactForm').html(response.view);
                }

                if (response.status == '1') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Write a valid e-mail address'
                    })
                }
                if (response.status == '2') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Message is required'
                    })
                }
            }
        });
    });
});


//blog in Home page
$("#tabs").tabs();
/*----------------------------
   jQuery MeanMenu
  ------------------------------ */
jQuery('nav#dropdown').meanmenu();

//branch Carousel
$('.branch-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 1200,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
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
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 1500,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});

//scroll-top
$.scrollUp({
    scrollText: '<i class="pe-7s-angle-up"></i>',
    easingType: 'linear',
    scrollSpeed: 900,
    animation: 'fade'
});