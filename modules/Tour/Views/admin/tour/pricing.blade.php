<div class="panel">
    <div class="panel-title"><strong>{{__("Pricing")}}</strong></div>
    <div class="panel-body">
        <h3 class="panel-body-title">{{__("Tour Price")}}</h3>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">{{__("Price")}}</label>
                    <input type="number" min="0" name="price" class="form-control" value="{{$row->price}}" placeholder="{{__("Tour Price")}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label">{{__("Sale Price")}}</label>
                    <input type="text" name="sale_price" class="form-control" value="{{$row->sale_price}}" placeholder="{{__("Tour Sale Price")}}">
                </div>
            </div>
        </div>
        <hr>
        <h3 class="panel-body-title">{{__('Person Types')}}</h3>
        <div class="form-group">
            <label><input type="checkbox" name="enable_person_types" @if(!empty($row->meta->enable_person_types)) checked @endif value="1"> {{__('Enable Person Types')}}
            </label>
        </div>
        <div class="form-group-item" data-condition="enable_person_types:is(1)">
            <label class="control-label">{{__('Person Types')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Person Type")}}</div>
                    <div class="col-md-2">{{__('Min')}}</div>
                    <div class="col-md-2">{{__('Max')}}</div>
                    <div class="col-md-2">{{__('Price')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->meta->person_types))
                    @foreach($row->meta->person_types as $key=>$person_type)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="person_types[{{$key}}][name]" class="form-control" value="{{$person_type['name']}}" placeholder="{{__('Eg: Adults')}}">
                                    <input type="text" name="person_types[{{$key}}][desc]" class="form-control" value="{{$person_type['desc'] ?? ''}}" placeholder="{{__('Description')}}">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="person_types[{{$key}}][min]" class="form-control" value="{{$person_type['min']}}" placeholder="{{__("Minimum per booking")}}">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="person_types[{{$key}}][max]" class="form-control" value="{{$person_type['max']}}" placeholder="{{__("Maximum per booking")}}">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="person_types[{{$key}}][price]" class="form-control" value="{{$person_type['price']}}" placeholder="{{__("per 1 item")}}">
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="person_types[__number__][name]" class="form-control" value="" placeholder="{{__('Eg: Adults')}}">
                            <input type="text" __name__="person_types[__number__][desc]" class="form-control" value="" placeholder="{{__('Description')}}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="person_types[__number__][min]" class="form-control" value="" placeholder="{{__("Minimum per booking")}}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="person_types[__number__][max]" class="form-control" value="" placeholder="{{__("Maximum per booking")}}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="person_types[__number__][price]" class="form-control" value="" placeholder="{{__("per 1 item")}}">
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <h3 class="panel-body-title">{{__('Extra Price')}}</h3>
        <div class="form-group">
            <label><input type="checkbox" name="enable_extra_price" @if(!empty($row->meta->enable_extra_price)) checked @endif value="1"> {{__('Enable extra price')}}
            </label>
        </div>

        <div class="form-group-item" data-condition="enable_extra_price:is(1)">
            <label class="control-label">{{__('Extra Price')}}</label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5">{{__("Name")}}</div>
                    <div class="col-md-3">{{__('Price')}}</div>
                    <div class="col-md-3">{{__('Type')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->meta->extra_price))
                    @foreach($row->meta->extra_price as $key=>$item)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="extra_price[{{$key}}][name]" class="form-control" value="{{$item['name'] ?? ''}}" placeholder="{{__('Extra price name')}}">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" name="extra_price[{{$key}}][price]" class="form-control" value="{{$item['price']}}">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[{{$key}}][type]" class="form-control">
                                        <option value="">{{__('-- Select --')}}</option>
                                        <option @if($item['type'] ==  'one_time') selected @endif value="one_time">{{__("One-time")}}</option>
                                        <option @if($item['type'] ==  'per_hour') selected @endif value="per_hour">{{__("Per hour")}}</option>
                                        <option @if($item['type'] ==  'per_day') selected @endif value="per_day">{{__("Per day")}}</option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[{{$key}}][per_person]" class="form-control" value="on" @if($item['per_person'] ?? '') checked @endif >
                                        {{__("Price per person")}}
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="extra_price[__number__][name]" class="form-control" value="" placeholder="{{__('Extra price name')}}">
                        </div>
                        <div class="col-md-3">
                            <input type="number" min="0" __name__="extra_price[__number__][price]" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <select __name__="extra_price[__number__][type]" class="form-control">
                                <option value="">{{__('-- Select --')}}</option>
                                <option value="one_time">{{__("One-time")}}</option>
                                <option value="per_hour">{{__("Per hour")}}</option>
                                <option value="per_day">{{__("Per day")}}</option>
                            </select>

                            <label>
                                <input type="checkbox" min="0" __name__="extra_price[__number__][per_person]" class="form-control" value="on">
                                {{__("Price per person")}}
                            </label>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <h3 class="panel-body-title">{{__('Discount by number of people')}}</h3>

        <div class="form-group-item">
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-4">{{__("No of people")}}</div>
                    <div class="col-md-3">{{__('Discount')}}</div>
                    <div class="col-md-3">{{__('Type')}}</div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                @if(!empty($row->meta->discount_by_people))
                    @foreach($row->meta->discount_by_people as $key=>$item)
                        <div class="item" data-number="{{$key}}">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="number" min="0" name="discount_by_people[{{$key}}][from]" class="form-control" value="{{$item['from']}}" placeholder="{{__('From')}}">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="discount_by_people[{{$key}}][to]" class="form-control" value="{{$item['from']}}" placeholder="{{__('To')}}">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" name="discount_by_people[{{$key}}][amount]" class="form-control" value="{{$item['amount']}}">
                                </div>
                                <div class="col-md-3">
                                    <select name="discount_by_people[{{$key}}][type]" class="form-control">
                                        <option value="">{{__('-- Select --')}}</option>
                                        <option @if($item['type'] ==  'fixed') selected @endif value="fixed">{{__("Fixed")}}</option>
                                        <option @if($item['type'] ==  'percent') selected @endif value="percent">{{__("Percent (%)")}}</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="discount_by_people[__number__][from]" class="form-control" value="" placeholder="{{__('From')}}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="discount_by_people[__number__][to]" class="form-control" value="" placeholder="{{__('To')}}">
                        </div>
                        <div class="col-md-3">
                            <input type="number" min="0" __name__="discount_by_people[__number__][amount]" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <select __name__="discount_by_people[__number__][type]" class="form-control">
                                <option value="">{{__('-- Select --')}}</option>
                                <option value="fixed">{{__("Fixed")}}</option>
                                <option value="percent">{{__("Percent")}}</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>