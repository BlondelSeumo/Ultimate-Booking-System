jQuery(function ($) {

    function parseErrorMessage(e){
        var html = '';
        if(e.responseJSON){
            if(e.responseJSON.errors){
                return Object.values(e.responseJSON.errors).join('<br>');
            }
        }
        return html;
    }
    $(".bravo-list-tour").each(function () {
        $(this).find(".owl-carousel").owlCarousel({
            items: 4,
            loop: false,
            margin: 15,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    });

    $(".bravo_fullHeight").each(function () {
        var height = $(document).height();
        if ($(document).find(".bravo-admin-bar").length > 0) {
            height = height - $(".bravo-admin-bar").height();
        }
        $(this).css('min-height', height);
    });


    // Date Picker Range
    $('.form-date-search').each(function () {
        var parent = $(this),
            date_wrapper = $('.date-wrapper', parent),
            check_in_input = $('.check-in-input', parent),
            check_out_input = $('.check-out-input', parent),
            check_in_out = $('.check-in-out', parent),
            check_in_render = $('.check-in-render', parent),
            check_out_render = $('.check-out-render', parent);
        var options = {
            singleDatePicker: false,
            autoApply: true,
            disabledPast: true,
            dateFormat: 'DD/MM/YYYY',
            customClass: '',
            widthSingle: 300,
            onlyShowCurrentMonth: true,
        };
        if (typeof  locale_daterangepicker == 'object') {
            options.locale = locale_daterangepicker;
        }
        check_in_out.daterangepicker(options,
            function (start, end, label) {
                check_in_input.val(start.format(parent.data('format')));
                check_in_render.html(start.format(parent.data('format')));
                check_out_input.val(end.format(parent.data('format')));
                check_out_render.html(end.format(parent.data('format')));
                check_in_out.trigger('daterangepicker_change', [start, end]);
                if (window.matchMedia('(max-width: 767px)').matches) {
                    $('.render', parent).show();
                    $('.check-in-wrapper span', parent).show();
                }
            });
        date_wrapper.click(function (e) {
            check_in_out.trigger('click');
        });
    });

    // Date Picker
    $('.date-picker').each(function () {
        $(this).daterangepicker({
            "singleDatePicker": true,
            locale: {
                format: bookingCore.date_format
            }
        });
    });




    //Review
    $('.review-form .review-items .rates .fa').each(function () {
        var list = $(this).parent(),
            listItems = list.children(),
            itemIndex = $(this).index(),
            parentItem = list.parent();
        $(this).hover(function () {
            for (var i = 0; i < listItems.length; i++) {
                if (i <= itemIndex) {
                    $(listItems[i]).addClass('hovered');
                } else {
                    break;
                }
            }
            $(this).click(function () {
                for (var i = 0; i < listItems.length; i++) {
                    if (i <= itemIndex) {
                        $(listItems[i]).addClass('selected');
                    } else {
                        $(listItems[i]).removeClass('selected');
                    }
                }
                parentItem.children('.review_stats').val(itemIndex + 1);
            });
        }, function () {
            listItems.removeClass('hovered');
        });
    });


    //Login
    $('.bravo-form-login [type=submit]').click(function (e) {
        e.preventDefault();
        let form = $(this).closest('.bravo-form-login');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': form.find('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': bookingCore.url+'/login',
            'data': {
                'email': form.find('input[name=email]').val(),
                'password': form.find('input[name=password]').val(),
                'remember': form.find('input[name=remember]').is(":checked") ? 1 : '',
                'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
            },
            'type': 'POST',
            beforeSend: function () {
                form.find('.error').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (data) {
                form.find('.icon-loading').hide();
                if (data.error === true) {
                    if (data.messages !== undefined) {
                        for(var item in data.messages) {
                            var msg = data.messages[item];
                            form.find('.error-'+item).show().text(msg[0]);
                        }
                    }
                    if (data.messages.message_error !== undefined) {
                        form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                    }
                }
                if (data.redirect !== undefined && data.redirect) {
                    window.location.href = data.redirect
                }
            }
        });
    })
    $('.bravo-form-register [type=submit]').click(function (e) {
        e.preventDefault();
        let form = $(this).closest('.bravo-form-register');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': form.find('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            'url': bookingCore.url+'/register',
            'data': {
                'email': form.find('input[name=email]').val(),
                'password': form.find('input[name=password]').val(),
                'first_name': form.find('input[name=first_name]').val(),
                'last_name': form.find('input[name=last_name]').val(),
                'term': form.find('input[name=term]').is(":checked") ? 1 : '',
                'g-recaptcha-response': form.find('[name=g-recaptcha-response]').val(),
            },
            'type': 'POST',
            beforeSend: function () {
                form.find('.error').hide();
                form.find('.icon-loading').css("display", 'inline-block');
            },
            success: function (data) {
                form.find('.icon-loading').hide();
                if (data.error === true) {
                    if (data.messages !== undefined) {
                        for(var item in data.messages) {
                            var msg = data.messages[item];
                            form.find('.error-'+item).show().text(msg[0]);
                        }
                    }
                    if (data.messages.message_error !== undefined) {
                        form.find('.message-error').show().html('<div class="alert alert-danger">' + data.messages.message_error[0] + '</div>');
                    }
                }
                if (data.redirect !== undefined) {
                    window.location.href = data.redirect
                }
            },
            error:function (e) {
				form.find('.icon-loading').hide();
				if(typeof e.responseJSON !== "undefined" && typeof e.responseJSON.message !='undefined'){
					form.find('.message-error').show().html('<div class="alert alert-danger">' + e.responseJSON.message + '</div>');
                }
			}
        });
    })
    $('#register').on('show.bs.modal', function (event) {
        $('#login').modal('hide')
    })
    $('#login').on('show.bs.modal', function (event) {
        $('#register').modal('hide')
    });


    var onSubmitSubscribe = false;
    //Subscribe box
    $('.bravo-subscribe-form').submit(function (e) {
        e.preventDefault();

        if (onSubmitSubscribe) return;

        $(this).addClass('loading');
        var me = $(this);
        me.find('.form-mess').html('');

        $.ajax({
            url: me.attr('action'),
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (json) {
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if (json.message) {
                    me.find('.form-mess').html('<span class="' + (json.status ? 'text-success' : 'text-danger') + '">' + json.message + '</span>');
                }

                if (json.status) {
                    me.find('input').val('');
                }

            },
            error: function (e) {
                console.log(e);
                onSubmitSubscribe = false;
                me.removeClass('loading');

                if(parseErrorMessage(e)){
                    me.find('.form-mess').html('<span class="text-danger">' + parseErrorMessage(e) + '</span>');
                }else
                if (e.responseText) {
                    me.find('.form-mess').html('<span class="text-danger">' + e.responseText + '</span>');
                }

            }
        });

        return false;
    });


    //Menu
    $(".bravo-more-menu").click(function () {
        $(this).trigger('bravo-trigger-menu-mobile');
    });
    $(".bravo-menu-mobile .b-close").click(function () {
        $(".bravo-more-menu").trigger('bravo-trigger-menu-mobile');
    });
    $(document).on("click",".bravo-effect-bg",function () {
        $(".bravo-more-menu").trigger('bravo-trigger-menu-mobile');
    })
    $(document).on("bravo-trigger-menu-mobile",".bravo-more-menu",function () {
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            $(".bravo-menu-mobile").addClass("active");
            $('body').css('overflow','hidden').append("<div class='bravo-effect-bg'></div>");
        }else{
            $(".bravo-menu-mobile").removeClass("active");
            $("body").css('overflow','initial').find(".bravo-effect-bg").remove();
        }
    });
    $(".bravo-menu-mobile .g-menu ul li .fa").click(function (e) {
        e.preventDefault();
        $(this).closest('li').toggleClass('active');
    });
    $(".bravo-menu-mobile").each(function () {
        var h_profile = $(this).find(".user-profile").height();
        var h1_main = $(window).height();
        $(this).find(".g-menu").css("max-height", h1_main - h_profile - 15);
    });

    $(".bravo-more-menu-user").click(function () {
        $(".bravo_user_profile > .container-fluid > .row > .col-md-3").addClass("active");
        $("body").css('overflow','hidden').append("<div class='bravo-effect-user-bg'></div>");
    });
    $(document).on("click",".bravo-effect-user-bg,.bravo-close-menu-user",function () {
        $(".bravo_user_profile > .container-fluid > .row > .col-md-3").removeClass("active");
        $('body').css('overflow','initial').find(".bravo-effect-user-bg").remove();
    })
});
