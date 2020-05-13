<div class="form-section">
    <h4 class="form-section-title">{{__('Select Payment Method')}}</h4>
    <div class="gateways-table accordion" id="accordionExample">
        @foreach($gateways as $k=>$gateway)
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <label class="" data-toggle="collapse" data-target="#gateway_{{$k}}" >
                            <input type="radio" name="payment_gateway" value="{{$k}}">
                            {{$gateway->getDisplayName()}}
                        </label>
                    </h4>
                </div>
                <div id="gateway_{{$k}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="gateway_name">
                            {!! $gateway->getDisplayName() !!}
                        </div>
                        {!! $gateway->getDisplayHtml() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
