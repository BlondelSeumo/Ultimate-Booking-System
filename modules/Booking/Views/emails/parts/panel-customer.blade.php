<div class="b-panel">
    <div class="b-panel-title">{{__('Customer information')}}</div>
    <div class="b-table-wrap">
        <table class="b-table" cellspacing="0" cellpadding="0">
            <tr class="info-first-name">
                <td class="label">{{__('First name')}}</td>
                <td class="val">{{$booking->first_name}}</td>
            </tr>
            <tr class="info-last-name">
                <td class="label">{{__('Last name')}}</td>
                <td class="val">{{$booking->last_name}}</td>
            </tr>
            <tr class="info-email">
                <td class="label">{{__('Email')}}</td>
                <td class="val">{{$booking->email}}</td>
            </tr>
            <tr class="info-address">
                <td class="label">{{__('Address trne 1')}}</td>
                <td class="val">{{$booking->address}}</td>
            </tr>
            <tr class="info-address2">
                <td class="label">{{__('Address trne 2')}}</td>
                <td class="val">{{$booking->address2}}</td>
            </tr>
            <tr class="info-city">
                <td class="label">{{__('City')}}</td>
                <td class="val">{{$booking->city}}</td>
            </tr>
            <tr class="info-state">
                <td class="label">{{__('State/Province/Region')}}</td>
                <td class="val">{{$booking->state}}</td>
            </tr>
            <tr class="info-zip-code">
                <td class="label">{{__('ZIP code/Postal code')}}</td>
                <td class="val">{{$booking->zip_code}}</td>
            </tr>
            <tr class="info-country">
                <td class="label">{{__('Country')}}</td>
                <td class="val">{{get_country_name($booking->country)}}</td>
            </tr>
            <tr class="info-notes">
                <td class="label">{{__('Special Requirements')}}</td>
                <td class="val">{{$booking->customer_notes}}</td>
            </tr>
        </table>
    </div>
</div>
