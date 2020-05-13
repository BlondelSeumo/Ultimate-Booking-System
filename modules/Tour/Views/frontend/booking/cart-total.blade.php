@php
    $total = 0;
    $total_guests = 0;
    $discount = 0;
    $price = $row->sale_price ? $row->sale_price : $row->price;
@endphp
<div class="form-section-group cart-total-group">
    <h4 class="form-section-title">{{__("Price")}}</h4>
    <ul>
        @if($meta->enable_person_types && !empty($person_types))
            @foreach($person_types as $k=>$person_type)
                @if(isset($person_types_configs[$k]) and $person_type['number'])
                    <li class="line-total">
                        <span class="label">{{$person_types_configs[$k]['name']}}</span>
                        <span class="val">{{format_money($person_type['number'] * $person_type['price'])}}</span>
                    </li>
                    @php
                        $total += $person_types_configs[$k]['price'] * $person_type['number'];
                        $total_guests += $person_type['number'];
                    @endphp
                @endif
            @endforeach
        @elseif(!$meta->enable_person_types or empty($person_types))
            <li class="line-total">
                <span class="label">{{__("Guests")}}</span>
                <span class="val">{{format_money($price * $guests)}}</span>
            </li>
            @php
                $total += $price * $guests;
                $total_guests += $guests;
            @endphp
        @endif
        @if($meta->enable_extra_price and !empty($extra_price_configs))
            <li class="line-new-section">{{__("Extra prices:")}}</li>
            @foreach($extra_price as $k=>$type)
                @if(isset($extra_price_configs[$k]) and $type['enable'])
                    @php
                        switch ($extra_price_configs[$k]['type'])
                        {
                            case "one_time":
                                $type_total = $extra_price_configs[$k]['price'];
                            break;
                            case "per_hour":
                                $type_total = $extra_price_configs[$k]['price'] * $row->duration;
                            break;
                            case "per_day":
                                $type_total = $extra_price_configs[$k]['price'] * ceil($row->duration/24);
                            break;
                        }
                        if($extra_price_configs[$k]['per_person']){
                            $type_total *= $total_guests;
                        }
                    @endphp
                    <li class="line-total line-extra-total">
                        <span class="label">{{$extra_price_configs[$k]['name']}}</span>
                        <span class="val">{{format_money($type_total)}}</span>
                    </li>
                    @php
                        $total += $type_total;
                    @endphp
                @endif
            @endforeach
        @endif
        @if($meta->discount_by_people and !empty($meta->discount_by_people))
            <li class="line-new-section">{{__("Discounts:")}}</li>
            @foreach($meta->discount_by_people as $type)
                @if($type['from'] <= $total_guests and (!$type['to'] or $type['to'] >= $total_guests) )
                    @php
                        switch ($type['type'])
                        {
                            case "fixed":
                                $type_total = $type['amount'];
                            break;
                            case "percent":
                                $type_total = $total/100*$type['amount'];
                            break;
                        }
                    @endphp
                    <li class="line-total line-discount-total">
                    <span class="label">
                        @if($type['to'])
                            {{__('from :from guests',['from'=>$type['from']])}}
                        @else
                            {{__(':from - :to guests',['from'=>$type['from'],'to'=>$type['to']])}}
                        @endif
                    </span>
                        <span class="val">{{format_money($type_total)}}</span>
                    </li>
                    @php
                        $total -= $type_total;
                        $discount += $type_total;
                    @endphp
                @endif
            @endforeach
        @endif
        <li class="line-total line-end-total">
            <span class="label">{{__('Total')}}</span>
            <span class="val">{{format_money($total > 0 ? $total : 0)}}</span>
        </li>
    </ul>
</div>