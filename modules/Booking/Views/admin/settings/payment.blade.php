<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Currency")}}</h3>
        <p class="form-group-desc">{{__('Currency Format')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Main Currency")}}</label>
                    <div class="form-controls">
                        {!! \App\Helpers\AdminForm::select('currency_main',\App\Currency::getAll(),$settings['currency_main'] ?? 'usd','dungdt-select2-field') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{__("Format")}}</label>
                            <div class="form-controls">
                                {!! \App\Helpers\AdminForm::select('currency_format',[
                                    ['id'=>'right','name'=>__('Right (100$)')],
                                    ['id'=>'right_space','name'=>__('Right with space (100 $)')],
                                    ['id'=>'left','name'=>__('Left ($100)')],
                                    ['id'=>'left_space','name'=>__('Left with space ($ 100)')],
                                ],$settings['currency_format'] ?? 'right') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{__("Thousand Separator")}}</label>
                            <div>
                                <input type="text" name="currency_thousand" class="form-control" value="{{$settings['currency_thousand'] ?? '.'}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{__("Decimal Separator")}}</label>
                            <div>
                                <input type="text" name="currency_decimal" class="form-control" value="{{$settings['currency_decimal'] ?? ','}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{__("No. of Decimals")}}</label>
                            <div>
                                <input type="number" name="currency_no_decimal" min=0 max = 6 class="form-control" value="{{$settings['currency_no_decimal'] ?? 2}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <h3 class="form-group-title">{{__("Payment Gateways")}}</h3>
        <p class="form-group-desc">{{__('You can enable and disable your payment gateways here')}}</p>
    </div>
    <div class="col-md-8">
        @php
        $all = config('booking.payment_gateways');
        @endphp
        @foreach($all as $k=>$gateway)
            @php
                if(!class_exists($gateway)) continue;
                $obj = new $gateway($k);
                $options = $obj->getOptionsConfigsFormatted();
            @endphp
            <div class="panel">
                <div class="panel-title"><strong>{{$obj->name}}</strong></div>
                <div class="panel-body">
                    @php App\Helpers\AdminForm::generate($options); @endphp
                </div>
            </div>
        @endforeach
    </div>
</div>