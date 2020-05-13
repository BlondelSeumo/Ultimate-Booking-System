<div class="b-panel-title">{{__('Tour information')}}</div>
<div class="b-table-wrap">
    <table class="b-table" cellspacing="0" cellpadding="0">
        <tr>
            <td class="label">{{__('Booking Number')}}</td>
            <td class="val">#{{$booking->id}}</td>
        </tr>
        <tr>
            <td class="label">{{__('Booking Status')}}</td>
            <td class="val">{{$booking->statusName}}</td>
        </tr>
        @if($booking->gatewayObj)
            <tr>
                <td class="label">{{__('Payment method')}}</td>
                <td class="val">{{$booking->gatewayObj->getOption('name')}}</td>
            </tr>
        @endif
        <tr>
            <td class="label">{{__('Tour name')}}</td>
            <td class="val">
                <a href="{{$service->getDetailUrl()}}">{{$service->title}}</a>
            </td>

        </tr>
        <tr>
            @if($service->address)
                <td class="label">{{__('Address')}}</td>
                <td class="val">
                    {{$service->address}}
                </td>
            @endif
        </tr>
        @if($booking->start_date && $booking->end_date)
            <tr>
                <td class="label">{{__('Start date')}}</td>
                <td class="val">{{display_date($booking->start_date)}}</td>
            </tr>

            <tr>
                <td class="label">{{__('Duration:')}}</td>
                <td class="val">
                    {{human_time_diff($booking->end_date,$booking->start_date)}}
                </td>
            </tr>
        @endif

        @php $person_types = $booking->getJsonMeta('person_types')
        @endphp

        @if(!empty($person_types))
            @foreach($person_types as $type)
                <tr>
                    <td class="label">{{$type['name']}}:</td>
                    <td class="val">
                        <strong>{{$type['number']}}</strong>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="label">{{__("Guests")}}:</td>
                <td class="val">
                    <strong>{{$booking->total_guests}}</strong>
                </td>
            </tr>
        @endif
        <tr>
            <td class="label">{{__('Pricing')}}</td>
            <td class="val no-r-padding">
                <table class="pricing-list" width="100%">
                    @php $person_types = $booking->getJsonMeta('person_types')
                    @endphp

                    @if(!empty($person_types))
                        @foreach($person_types as $type)
                            <tr>
                                <td class="label">{{$type['name']}}: {{$type['number']}} * {{format_money($type['price'])}}</td>
                                <td class="val no-r-padding">
                                    <strong>{{format_money($type['price'] * $type['number'])}}</strong>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="label">{{__("Guests")}}: {{$booking->total_guests}} {{format_money($booking->getMeta('base_price'))}}</td>
                            <td class="val no-r-padding">
                                <strong>{{format_money($booking->getMeta('base_price') * $booking->total_guests)}}</strong>
                            </td>
                        </tr>
                    @endif

                    @php $extra_price = $booking->getJsonMeta('extra_price')@endphp

                    @if(!empty($extra_price))
                        <tr>
                            <td colspan="2" class="label-title"><strong>{{__("Extra Prices:")}}</strong></td>
                        </tr>
                        <tr class="">
                            <td colspan="2" class="no-r-padding no-b-border">
                                <table width="100%">
                                @foreach($extra_price as $type)
                                    <tr>
                                        <td class="label">{{$type['name']}}:</td>
                                        <td class="val no-r-padding">
                                            <strong>{{format_money($type['total'] ?? 0)}}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                            </td>
                        </tr>

                    @endif

                    @php $discount_by_people = $booking->getJsonMeta('discount_by_people')
                    @endphp
                    @if(!empty($discount_by_people))
                        <tr>
                            <td colspan="2" class="label-title"><strong>{{__("Discounts:")}}</strong></td>
                        </tr>
                        <tr class="">
                            <td colspan="2" class="no-r-padding no-b-border">
                                <table width="100%">
                                @foreach($discount_by_people as $type)
                                    <tr>
                                        <td class="label">
                                            @if(!$type['to'])
                                                {{__('from :from guests',['from'=>$type['from']])}}
                                            @else
                                                {{__(':from - :to guests',['from'=>$type['from'],'to'=>$type['to']])}}
                                            @endif
                                            :
                                        </td>
                                        <td class="val no-r-padding">
                                            <strong>- {{format_money($type['total'] ?? 0)}}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                            </td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
        <tr>
            <td class="label fsz21">{{__('Total')}}</td>
            <td class="val fsz21"><strong style="color: #FA5636">{{format_money($booking->total)}}</strong></td>
        </tr>
    </table>
</div>
<div class="text-center mt20">
    <a href="{{url('user/booking-history')}}" target="_blank" class="btn btn-primary">{{__('Manage Bookings')}}</a>
</div>
