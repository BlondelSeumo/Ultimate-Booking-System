<div class="modal fade" id="modal-booking-<?php echo e($booking->id); ?>">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(__("Booking ID")); ?>: #<?php echo e($booking->id); ?></h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#booking-detail-<?php echo e($booking->id); ?>"><?php echo e(__("Booking Detail")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#booking-customer-<?php echo e($booking->id); ?>"><?php echo e(__("Your Information")); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="booking-detail-<?php echo e($booking->id); ?>" class="tab-pane active"><br>
                        <div class="booking-review">
                            <div class="booking-review-content">
                                <div class="review-section">
                                    <div class="info-form">
                                        <ul>
                                            <li>
                                                <div class="label"><?php echo e(__('Booking Date')); ?></div>
                                                <div class="val"><?php echo e(display_date($booking->created_at)); ?></div>
                                            </li>
                                            <?php if(!empty($booking->gateway)): ?>
                                                <?php $gateway = get_payment_gateway_obj($booking->gateway);?>
                                                <li>
                                                    <div class="label"><?php echo e(__('Payment Method')); ?></div>
                                                    <div class="val"><?php echo e($gateway->name); ?></div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="more-booking-review">
                            <?php echo $__env->make($service->checkout_booking_detail_file ?? '', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div id="booking-customer-<?php echo e($booking->id); ?>" class="tab-pane fade"><br>
                        <?php echo $__env->make($service->booking_customer_info_file ?? 'Booking::frontend/booking/booking-customer-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="btn btn-secondary" data-dismiss="modal"><?php echo e(__("Close")); ?></span>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/booking/detail-modal.blade.php ENDPATH**/ ?>