/*import BookingCoreAdaterPlugin from "../../../../resources/admin/js/ckeditor/uploadAdapter";*/

jQuery(function ($) {
    //Input group image select
    $('.upload-btn-wrapper').each(function () {
        var container = $(this);
        $(document).on('change', '.btn-file :file', function (event) {
            var files = event.target.files;
            var input = $(this);
            var formData = new FormData();
            $.each(files, function (key, value) {
                formData.append('file', value);
            });
            $.ajax({
                url: '/admin/module/media/store',
                type: 'POST',
                data: formData,
                enctype: 'multipart/form-data',
                beforeSend: function () {
                    input.trigger("bravo-file-before-update")
                },
                success: function (data) {
                    if (data.status === 1) {
                        input.trigger("bravo-file-update-success", data)
                    } else {
                        input.trigger("bravo-file-update-error", data.message)
                    }
                },
                error: function (xhr) {
                    input.trigger("bravo-file-update-error")
                },
                complete: function () {
                    input.trigger("bravo-file-update-complete")
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        container.find('.btn-file :file').on('bravo-file-update-success', function (event, data) {
            console.log(data);
            container.find("input[type=hidden]").attr('value', data.data.id);
            container.find(".image-demo").attr('src', data.data.sizes.default);
            container.find(".text-view").attr('value', data.data.sizes.default);
        });
        container.find('.btn-file :file').on('bravo-file-before-update', function () {
            container.find(".text-view").attr('value', container.find(".text-view").data("loading"));
        });
        container.find('.btn-file :file').on('bravo-file-update-error', function (event, message) {
            if (message.length > 0) {
                container.find(".text-view").attr('value', message);
            } else {
                container.find(".text-view").attr('value', container.find(".text-view").data("error"));
            }
        });
    });
    $(".form-group-item").each(function () {
        let container = $(this);
        $(this).on('click', '.btn-remove-item', function () {
            $(this).closest(".item").remove();
        });
        $(this).on('press', 'input,select', function () {
            let value = $(this).val();
            $(this).attr("value", value);
        });
    });
    $(".form-group-item .btn-add-item").click(function () {
        let number = $(this).closest(".form-group-item").find(".g-items .item:last-child").data("number");
        if (number === undefined) number = 0;
        else number++;
        let extra_html = $(this).closest(".form-group-item").find(".g-more").html();
        extra_html = extra_html.replace(/__name__=/gi, "name=");
        extra_html = extra_html.replace(/__number__/gi, number);
        $(this).closest(".form-group-item").find(".g-items").append(extra_html);
    });
    $('.dungdt-upload-box').find('.btn-field-upload,.attach-demo').click(function () {
        let p = $(this).closest('.dungdt-upload-box');

        uploaderModal.show({
            multiple: false,
            file_type: 'image',
            onSelect: function (files) {
                p.addClass('active');
                p.find('.attach-demo').html('<img src="' + files[0].thumb_size + '"/>');
                p.find('input').val(files[0].id);
            },
        });

    });
    $('.dungdt-upload-box .delete').click(function (e) {
        e.preventDefault();
        let p = $(this).closest('.dungdt-upload-box');
        p.find("input").attr('value','')
        p.removeClass("active");
    });
    $('.dungdt-upload-multiple').find('.btn-field-upload').click(function () {
        let p = $(this).closest('.dungdt-upload-multiple');
        uploaderModal.show({
            multiple: true,
            file_type: 'image',
            onSelect: function (files) {
                console.log(files);
                if (typeof files != 'undefined' && files.length) {
                    var ids = [];
                    var html = '';
                    p.addClass('active');

                    for (var i = 0; i < files.length; i++) {
                        ids.push(files[i].id);
                        html += '<div class="image-item"><div class="inner"><span class="delete btn btn-sm btn-danger"><i class="fa fa-trash"></i></span><img src="' + files[i].thumb_size + '"/></div></div>'
                    }
                    p.find('.attach-demo').html(html);
                    p.find('input').val(ids.join(','));
                }

            },
        });
    });
    $('.dungdt-upload-multiple').on('click', '.image-item .delete', function () {
        var i = $(this).closest('.image-item').index();
        let p = $(this).closest('.dungdt-upload-multiple');
        var ids = p.find('input').val().split(',');
        ids.splice(i, 1);
        p.find('input').val(ids.join(','));
        $(this).closest('.image-item').remove();
    });
    $(".bravo_user_profile .sidebar-menu .caret").click(function () {
        $(this).closest("li").toggleClass("active_child");
    });


});