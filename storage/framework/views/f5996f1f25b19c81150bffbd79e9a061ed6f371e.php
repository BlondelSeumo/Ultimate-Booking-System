<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('module/booking/css/checkout.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <div id="bravo-checkout-page" >
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="form-title"><?php echo e(__('Booking Submission')); ?></h3>
                         <div class="booking-form">
                             <?php echo $__env->make($service->checkout_form_file ?? 'Booking::frontend/booking/checkout-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                         </div>
                    </div>
                    <div class="col-md-4">
                        <div class="booking-detail">
                            <?php echo $__env->make($service->checkout_booking_detail_file ?? '', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="<?php echo e(asset('module/booking/js/checkout.js')); ?>"></script>
    <script type="text/javascript">
        jQuery(function () {
            $.ajax({
                'url': bookingCore.url + '/booking/<?php echo e($booking->code); ?>/check-status',
                'cache': false,
                'type': 'GET',
                success: function (data) {
                    if (data.redirect !== undefined && data.redirect) {
                        window.location.href = data.redirect
                    }
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Booking/Views/frontend/checkout.blade.php ENDPATH**/ ?>