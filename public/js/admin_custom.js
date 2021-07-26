$(document).ready(function() {
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
        var idCoupon = $(this).closest('.coupons_data').find('.idCoupon').val();

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
});
// input file upload image post
function readURL(input) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {
            $('.image-upload-wrap').hide();

            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();

            $('.image-title').html(input.files[0].name);
        };

        reader.readAsDataURL(input.files[0]);

    } else {
        removeUpload();
    }
}

function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function() {
    $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function() {
    $('.image-upload-wrap').removeClass('image-dropping');
});