<div class="b-panel">
    <div class="b-panel-title"><?php echo e(__('Customer information')); ?></div>
    <div class="b-table-wrap">
        <table class="b-table" cellspacing="0" cellpadding="0">
            <tr class="info-first-name">
                <td class="label"><?php echo e(__('First name')); ?></td>
                <td class="val"><?php echo e($booking->first_name); ?></td>
            </tr>
            <tr class="info-last-name">
                <td class="label"><?php echo e(__('Last name')); ?></td>
                <td class="val"><?php echo e($booking->last_name); ?></td>
            </tr>
            <tr class="info-email">
                <td class="label"><?php echo e(__('Email')); ?></td>
                <td class="val"><?php echo e($booking->email); ?></td>
            </tr>
            <tr class="info-address">
                <td class="label"><?php echo e(__('Address trne 1')); ?></td>
                <td class="val"><?php echo e($booking->address); ?></td>
            </tr>
            <tr class="info-address2">
                <td class="label"><?php echo e(__('Address trne 2')); ?></td>
                <td class="val"><?php echo e($booking->address2); ?></td>
            </tr>
            <tr class="info-city">
                <td class="label"><?php echo e(__('City')); ?></td>
                <td class="val"><?php echo e($booking->city); ?></td>
            </tr>
            <tr class="info-state">
                <td class="label"><?php echo e(__('State/Province/Region')); ?></td>
                <td class="val"><?php echo e($booking->state); ?></td>
            </tr>
            <tr class="info-zip-code">
                <td class="label"><?php echo e(__('ZIP code/Postal code')); ?></td>
                <td class="val"><?php echo e($booking->zip_code); ?></td>
            </tr>
            <tr class="info-country">
                <td class="label"><?php echo e(__('Country')); ?></td>
                <td class="val"><?php echo e(get_country_name($booking->country)); ?></td>
            </tr>
            <tr class="info-notes">
                <td class="label"><?php echo e(__('Special Requirements')); ?></td>
                <td class="val"><?php echo e($booking->customer_notes); ?></td>
            </tr>
        </table>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/Booking/Views/emails/parts/panel-customer.blade.php ENDPATH**/ ?>