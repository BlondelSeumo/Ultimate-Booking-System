jQuery(function ($) {


	$(".bravo-filter-price").each(function () {
		var input_price = $(this).find(".filter-price");
		var min = input_price.data("min");
		var max = input_price.data("max");
		var from = input_price.data("from");
		var to = input_price.data("to");
		var symbol = input_price.data("symbol");
		input_price.ionRangeSlider({
			type: "double",
			grid: true,
			min: min,
			max: max,
			from: from,
			to: to,
			prefix: symbol
		});
	});

	var mapEngine = new BravoMapEngine('bravo_results_map',{
		fitBounds:true,
		center:[51.505, -0.09],
		zoom:6,
		disableScripts:true,
		ready: function (engineMap) {
			if(bravo_map_data.markers){
				engineMap.addMarkers2(bravo_map_data.markers);
			}
		}
	});

	$('.bravo_form_search_map .input-filter').change(function () {
		reloadForm();
	});
	$('.bravo_form_search_map .btn-filter,.btn-apply-advances').click(function () {
		reloadForm();
	});
	$('.btn-apply-advances').click(function(){
		$('#advance_filters').addClass('d-none');
	})

	function reloadForm(){
		$('.map_loading').show();
		$.ajax({
			data:$('.bravo_form_search_map input,select,textarea,#advance_filters input,select,textarea').serialize()+'&_ajax=1',
			url:window.location.href.split('?')[0],
			dataType:'json',
			type:'get',
			success:function (json) {
				$('.map_loading').hide();
				if(json.status)
				{
					mapEngine.clearMarkers();
					mapEngine.addMarkers2(json.markers);

					$('.bravo-list-item').replaceWith(json.html);

					$('.listing_items').animate({
                        scrollTop:0
                    },'fast');

					if(window.lazyLoadInstance){
						window.lazyLoadInstance.update();
					}

				}

			},
			error:function (e) {
				$('.map_loading').hide();
				if(e.responseText){
					$('.bravo-list-item').html('<p class="alert-text danger">'+e.responseText+'</p>')
				}
			}
		})
	}

	function reloadFormByUrl(url){
        $('.map_loading').show();
        $.ajax({
            url:url,
            dataType:'json',
            type:'get',
            success:function (json) {
                $('.map_loading').hide();
                if(json.status)
                {
                    mapEngine.clearMarkers();
                    mapEngine.addMarkers2(json.markers);

                    $('.bravo-list-item').replaceWith(json.html);

                    $('.listing_items').animate({
                        scrollTop:0
                    },'fast');

                    if(window.lazyLoadInstance){
                        window.lazyLoadInstance.update();
                    }
                }

            },
            error:function (e) {
                $('.map_loading').hide();
                if(e.responseText){
                    $('.bravo-list-item').html('<p class="alert-text danger">'+e.responseText+'</p>')
                }
            }
        })
	}

	$('.toggle-advance-filter').click(function () {
		var id = $(this).data('target');
		$(id).toggleClass('d-none');
	});

    $(document).on('click', '.filter-item .dropdown-menu', function (e) {

        if(!$(e.target).hasClass('btn-apply-advances')){
            e.stopPropagation();
		}
    })
		.on('click','.bravo-pagination a',function (e) {
			e.preventDefault();
            reloadFormByUrl($(this).attr('href'));
        })
	;

});
