@extends('admin.layouts.app')

@section ('content')
    @php $services  = []; @endphp
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Tour Booking Calendar")}}</h1>
        </div>
        @include('admin.message')
        <div class="panel">
{{--            <div class="panel-title"><strong>{{__("Tour Filters")}}</strong></div>--}}
            <div class="panel-body">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        <form method="get" action="" class="filter-form filter-form-left d-flex flex-column flex-sm-row" role="search">
                            <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name')}}" class="form-control">
                            <select name="cat_id" class="form-control">
                                <option value="">{{ __('--All Category --')}} </option>
                                <?php
                                foreach ($tour_categories as $category) {
                                    $selected = '';
                                    if($request->query('cat_id') == $category->id) $selected = 'selected';
                                    printf("<option value='%s' %s>%s</option>", $category->id,$selected, $category->name);
                                }
                                ?>
                            </select>
                            <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="booking-calendar vec-wrap panel" id="booking-calendar" >
            <div class="panel-body">
                <div class="vec-header-toolbar d-flex justify-content-between align-items-center">
                    <div class=""><i><span class="count-string">{{ __("Showing :from - :to of :total Tour(s)",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span></i></div>
                    <div class="current-month">{{date('M-Y',$current_month)}}</div>
                    <div class="btn-group" role="group">
                        <a href="{{$prev_url}}" type="button" class="btn btn-secondary"><i class="icon ion-ios-arrow-back"></i></a>
                        <a href="{{$next_url}}" type="button" class="btn btn-secondary"><i class="icon ion-ios-arrow-forward"></i></a>
                    </div>
                </div>
                <table class="vec-view-container" width="100%" cellpadding="0" cellspacing="0">
                    <thead class="vec-head">
                    <tr>
                        <th width="300px" class="vec-event-header">{{__('Tours')}}</th>
                        <th class="vec-divider"></th>
                        <th class="vc-time-area">
                            <div class="vec-scroll-flip">
                                <div class="vec-scroll-box">
                                    <table class="" width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            @for($i = 1 ; $i <= date('t',$current_month) ; $i++)
                                                @php $day = strtotime(date('Y-m-',$current_month).$i) @endphp
                                                <td class="vec-time-text">
                                                    <span class="vec-day">{{date('d',$day)}}</span>
                                                    <span class="vec-month">{{date('M',$day)}}</span>
                                                    <span class="vec-year">{{date('Y',$day)}}</span>
                                                    <span class="vec-day-of-week">{{date('D',$day)}}</span>
                                                </td>
                                            @endfor

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="vec-body">
                    <tr>
                        <td class="vec-events" width="300px">
                            @foreach($rows as $row)
                                <div class="vec-event-{{$row->id}} vec-event-name">
                                        <a href="{{$row->getEditUrl()}}" target="_blank" title="#{{$row->id}} - {{$row->title}}">#{{$row->id}} - {{$row->title}}</a>
                                </div>
                            @endforeach
                        </td>
                        <td class="vec-divider"></td>
                        <td class="vec-time-area">
                            <div class="vec-scroll-flip">
                                <div class="vec-scroll-box">
                                    <table width="100%" class="vec-events-list" cellspacing="0" cellpadding="0">
                                        @foreach($rows as $row)
                                            <tr class="vec-event-list-tr">
                                                <td>
                                                    <div class="vec-event-containers" data-id="{{$row->id}}">
                                                        @php $bookings = $row->getBookingsInRange(date('Y-m-01',$current_month),date('Y-m-t',$current_month)) @endphp
                                                        @if(!empty($bookings))
                                                            @foreach($bookings as $booking)
                                                                @php $service = $booking->service;
                                                                if(!empty($service)){
                                                                    $service->booking = $booking;
                                                                    $services[] = $service;
                                                                }
                                                                @endphp
                                                                <div title="#{{$booking->id}} - {{$booking->email}}" data-from="{{date('d',strtotime($booking->start_date))}}" data-to="{{date('d',strtotime($booking->end_date))}}" class="vec-event-item d-none status-{{$booking->status}}" data-toggle="modal" data-target="#modal-booking-{{$booking->id}}">
                                                                    #{{$booking->id}} - {{$booking->email}}
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div class="vec-events-bg">
                                        <table class="" cellpadding="0" cellspacing="0" width="100%">
                                            <tr class="vec-event-time-row">
                                                @for($i = 1 ; $i <= date('t',$current_month) ; $i++)
                                                    <td class="vec-event-time-td" >
                                                        <div>&nbsp;</div>
                                                    </td>
                                                @endfor
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            @foreach($services as $service)
                @include ($service->checkout_booking_detail_modal_file ?? '',['booking'=>$service->booking])
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{$rows->appends($request->query())->links()}}
        </div>
    </div>
@endsection

@section('script.head')
    <link rel="stylesheet" href="{{asset('libs/vertical-calendar/css/vertical-calendar.css')}}">
@endsection

@section('script.body')
<script src="{{asset('libs/vertical-calendar/vertical-calendar.js')}}"></script>
<script>
	new VerticalEventCalendar({
        el:'#booking-calendar',
		eventHeaderName:'{{__('Tours')}}'
    });
    var baseColumnWidth = ($('.vec-header-toolbar').width() - $('.vec-event-header').width() - 5 ) / {{date('t',$current_month)}};



    baseColumnWidth = parseInt(baseColumnWidth);
    var baseEventHeight = 25;

    (function ($) {
        $('.vec-view-container .vc-time-area').each(function () {
            $(this).find('table').attr('width','auto');
            $(this).find(".vec-time-text").css("width",baseColumnWidth).css("max-width",baseColumnWidth);
        });
        $('.vec-view-container .vec-events-bg').each(function () {
            $(this).find('table').attr('width','auto');
            $(this).find(".vec-event-time-td").css("width",baseColumnWidth).css("max-width",baseColumnWidth);
        });

        $('.vec-event-containers').each(function () {
            var me = this;
            var maxT = 0;
            var items = $(this).find('.vec-event-item');
            if(!items.length){
                return;
            }
            var id = $(this).data('id');
            items.each(function (i,v) {
            	var t = 0;
            	items.each(function (i2,v2) {

            		if(i2 !== i && i2 < i){
						if($(v).data('from')  <= $(v2).data('to') && $(v).data('to') >= $(v2).data('from') ){
							t++;
                        }
                    }
				});

                $(this).css({
                    left:baseColumnWidth * (parseInt($(this).data('from')) - 1),
                    width:baseColumnWidth * (parseInt($(this).data('to') - parseInt($(this).data('from')) + 1)),
                    top:baseEventHeight * t + (t * 2) + 1
                });
                $(this).removeClass('d-none');

                if(t > maxT) maxT = t;
            });

            $(this).css({
                height:(baseEventHeight + 1) * (maxT+1) + 2
            });

            $('.vec-events .vec-event-'+id).css({
                height:(baseEventHeight + 1) * (maxT+1) + 2
            });

        })

    })(jQuery);

</script>
@endsection