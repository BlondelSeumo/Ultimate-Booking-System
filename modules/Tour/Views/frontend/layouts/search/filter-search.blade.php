<div class="bravo_filter">
    <form action="" class="bravo_form_filter">
        @if( !empty(Request::query('location_id')) )
            <input type="hidden" name="location_id" value="{{Request::query('location_id')}}">
        @endif
        @if( !empty(Request::query('start')) and !empty(Request::query('end')) )
            <input type="hidden" value="{{Request::query('start',date("d/m/Y",strtotime("today")))}}" name="start">
            <input type="hidden" value="{{Request::query('end',date("d/m/Y",strtotime("+1 day")))}}" name="end">
            <input type="hidden" name="date" value="{{Request::query('date')}}">
        @endif
        <div class="filter-title">
            {{__("FILTER BY")}}
        </div>
        <div class="g-filter-item">
            <div class="item-title">
                <h4>{{__("Filter Price")}}</h4>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </div>
            <div class="item-content">
                <div class="bravo-filter-price">
                    <?php
                    $price_min = $pri_from = $tour_min_max_price[0];
                    $price_max = $pri_to = $tour_min_max_price[1];
                    if (!empty($price_range = Request::query('price_range'))) {
                        $pri_from = explode(";", $price_range)[0];
                        $pri_to = explode(";", $price_range)[1];
                    }
                    $currency = App\Currency::getCurrency(setting_item('currency_main'))
                    ?>
                    <input type="hidden" class="filter-price irs-hidden-input" name="price_range"
                           data-symbol=" {{$currency['symbol'] ?? ''}}"
                           data-min="{{$price_min}}"
                           data-max="{{$price_max}}"
                           data-from="{{$pri_from}}"
                           data-to="{{$pri_to}}"
                           readonly="" value="{{$price_range}}">
                    <button type="submit" class="btn btn-link btn-apply-price-range">{{__("APPLY")}}</button>
                </div>
            </div>
        </div>
        <div class="g-filter-item">
            <div class="item-title">
                <h4>{{__("Tour Type")}}</h4>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </div>
            <div class="item-content">
                <ul>
                    <?php
                    $current_category_ids = Request::query('cat_id');
                    $traverse = function ($categories, $prefix = '') use (&$traverse, $current_category_ids) {
                    $i = 0;
                    foreach ($categories as $category) {
                    $checked = '';
                    if (!empty($current_category_ids)) {
                        foreach ($current_category_ids as $key => $current) {
                            if ($current == $category->id)
                                $checked = 'checked';
                        }
                    }
                    ?>
                    <li @if($i > 2) class="hide" @endif>
                        <div class="bravo-checkbox">
                            <label>
                                <input name="cat_id[]" {{$checked}} type="checkbox" value="{{$category->id}}"> {{$prefix}} {{$category->name}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </li>
                    <?php
                    $i++;
                    $traverse($category->children, $prefix . '-');
                    }
                    };
                    $traverse($tour_category);
                    ?>
                </ul>
                <button type="button" class="btn btn-link btn-more-item">{{__("More")}} <i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="g-filter-item">
            <div class="item-title">
                <h4>{{__("Duration")}}</h4>
                <i class="fa fa-angle-up" aria-hidden="true"></i>
            </div>
            <div class="item-content">
                <ul>
                    <li>
                        <div class="bravo-checkbox">
                            <label>
                                <input name="duration[]" <?php if (is_array(Request::query('duration')) and in_array("0;3", Request::query('duration')))
                                    echo "checked"; ?> type="checkbox" value="0;3"> {{__("0 – 3 hours")}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="bravo-checkbox">
                            <label>
                                <input name="duration[]" <?php if (is_array(Request::query('duration')) and in_array("3;5", Request::query('duration')))
                                    echo "checked"; ?>  type="checkbox" value="3;5"> {{__("3 – 5 hours")}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="bravo-checkbox">
                            <label>
                                <input name="duration[]" <?php if (is_array(Request::query('duration')) and in_array("5;7", Request::query('duration')))
                                    echo "checked"; ?>  type="checkbox" value="5;7"> {{__("5 – 7 hours")}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </li>
                    <li class="hide">
                        <div class="bravo-checkbox">
                            <label>
                                <input name="duration[]" <?php if (is_array(Request::query('duration')) and in_array("7;9", Request::query('duration')))
                                    echo "checked"; ?>  type="checkbox" value="7;9"> {{__("7 – 9 hours")}}
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </li>
                </ul>
                <button type="button" class="btn btn-link btn-more-item">{{__("More")}} <i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
    </form>
</div>