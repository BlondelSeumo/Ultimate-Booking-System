<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('module/booking/css/checkout.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <div class="row booking-success-notice">
                <div class="col-lg-8 col-md-8">
                    <div class="d-flex align-items-center">
                        <img src="<?php echo e(url('images/ico_success.svg')); ?>" alt="Payment Success">
                        <div class="notice-success">
                            <p class="line1"><span><?php echo e($booking->first_name); ?>,</span>
                                <?php echo e(__('your order was submitted successfully!')); ?>

                            </p>
                        <p class="line2"><?php echo e(__('Booking details has been sent to:')); ?> <span><?php echo e($booking->email); ?></span></p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="booking-info-detail">
                        <li><span><?php echo e(__('Booking Number')); ?>:</span> <?php echo e($booking->id); ?></li>
                        <li><span><?php echo e(__('Booking Date')); ?>:</span> <?php echo e(display_date($booking->created_at)); ?></li>
                        <?php if(!empty($gateway)): ?>
                        <li><span><?php echo e(__('Payment Method')); ?>:</span> <?php echo e($gateway->name); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="row booking-success-detail">
                <div class="col-md-8">
                    <?php echo $__env->make($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="text-center">
                        <a href="<?php echo e(url('user/booking-history')); ?>" class="btn btn-primary"><?php echo e(__('Booking History')); ?></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php echo $__env->make($service->checkout_booking_detail_file ?? '', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Booking/Views/frontend/detail.blade.php ENDPATH**/ ?>