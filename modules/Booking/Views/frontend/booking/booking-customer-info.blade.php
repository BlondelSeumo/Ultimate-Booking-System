<div class="booking-review">
    <h4 class="booking-review-title">{{__('Your Information')}}</h4>
    <div class="booking-review-content">
        <div class="review-section">
            <div class="info-form">
                <ul>
                    <li class="info-first-name">
                        <div class="label">{{__('First name')}}</div>
                        <div class="val">{{$booking->first_name}}</div>
                    </li>
                    <li class="info-last-name">
                        <div class="label">{{__('Last name')}}</div>
                        <div class="val">{{$booking->last_name}}</div>
                    </li>
                    <li class="info-email">
                        <div class="label">{{__('Email')}}</div>
                        <div class="val">{{$booking->email}}</div>
                    </li>
                    <li class="info-address">
                        <div class="label">{{__('Address line 1')}}</div>
                        <div class="val">{{$booking->address}}</div>
                    </li>
                    <li class="info-address2">
                        <div class="label">{{__('Address line 2')}}</div>
                        <div class="val">{{$booking->address2}}</div>
                    </li>
                    <li class="info-city">
                        <div class="label">{{__('City')}}</div>
                        <div class="val">{{$booking->city}}</div>
                    </li>
                    <li class="info-state">
                        <div class="label">{{__('State/Province/Region')}}</div>
                        <div class="val">{{$booking->state}}</div>
                    </li>
                    <li class="info-zip-code">
                        <div class="label">{{__('ZIP code/Postal code')}}</div>
                        <div class="val">{{$booking->zip_code}}</div>
                    </li>
                    <li class="info-country">
                        <div class="label">{{__('Country')}}</div>
                        <div class="val">{{get_country_name($booking->country)}}</div>
                    </li>
                    <li class="info-notes">
                        <div class="label">{{__('Special Requirements')}}</div>
                        <div class="val">{{$booking->customer_notes}}</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
