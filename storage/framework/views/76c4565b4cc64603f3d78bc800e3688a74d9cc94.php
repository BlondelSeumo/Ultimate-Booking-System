<div class="booking-review">
    <h4 class="booking-review-title"><?php echo e(__('Your Information')); ?></h4>
    <div class="booking-review-content">
        <div class="review-section">
            <div class="info-form">
                <ul>
                    <li class="info-first-name">
                        <div class="label"><?php echo e(__('First name')); ?></div>
                        <div class="val"><?php echo e($booking->first_name); ?></div>
                    </li>
                    <li class="info-last-name">
                        <div class="label"><?php echo e(__('Last name')); ?></div>
                        <div class="val"><?php echo e($booking->last_name); ?></div>
                    </li>
                    <li class="info-email">
                        <div class="label"><?php echo e(__('Email')); ?></div>
                        <div class="val"><?php echo e($booking->email); ?></div>
                    </li>
                    <li class="info-address">
                        <div class="label"><?php echo e(__('Address line 1')); ?></div>
                        <div class="val"><?php echo e($booking->address); ?></div>
                    </li>
                    <li class="info-address2">
                        <div class="label"><?php echo e(__('Address line 2')); ?></div>
                        <div class="val"><?php echo e($booking->address2); ?></div>
                    </li>
                    <li class="info-city">
                        <div class="label"><?php echo e(__('City')); ?></div>
                        <div class="val"><?php echo e($booking->city); ?></div>
                    </li>
                    <li class="info-state">
                        <div class="label"><?php echo e(__('State/Province/Region')); ?></div>
                        <div class="val"><?php echo e($booking->state); ?></div>
                    </li>
                    <li class="info-zip-code">
                        <div class="label"><?php echo e(__('ZIP code/Postal code')); ?></div>
                        <div class="val"><?php echo e($booking->zip_code); ?></div>
                    </li>
                    <li class="info-country">
                        <div class="label"><?php echo e(__('Country')); ?></div>
                        <div class="val"><?php echo e(get_country_name($booking->country)); ?></div>
                    </li>
                    <li class="info-notes">
                        <div class="label"><?php echo e(__('Special Requirements')); ?></div>
                        <div class="val"><?php echo e($booking->customer_notes); ?></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/Booking/Views/frontend/booking/booking-customer-info.blade.php ENDPATH**/ ?>