<div class="booking-review">
    <h4 class="booking-review-title"><?php echo e(__("Your Booking")); ?></h4>
    <div class="booking-review-content">
        <div class="review-section">
            <div class="service-info">
                <div>
                    <h3 class="service-name"><a href="<?php echo e($service->getDetailUrl()); ?>"><?php echo e($service->title); ?></a></h3>
                    <?php if($service->address): ?>
                        <p class="address"><i class="fa fa-map-marker"></i>
                            <?php echo e($service->address); ?>

                        </p>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
        <div class="review-section">
            <ul class="review-list">
                <?php if($booking->start_date): ?>
                    <li>
                        <div class="label"><?php echo e(__('Start date:')); ?></div>
                        <div class="val">
                            <?php echo e(display_date($booking->start_date)); ?>

                        </div>
                    </li>
                    <li>
                        <div class="label"><?php echo e(__('Duration:')); ?></div>
                        <div class="val">
                            <?php echo e(human_time_diff($booking->end_date,$booking->start_date)); ?>

                        </div>
                    </li>
                <?php endif; ?>
                <?php $person_types = $booking->getJsonMeta('person_types')?>
                <?php if(!empty($person_types)): ?>
                    <?php $__currentLoopData = $person_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="label"><?php echo e($type['name']); ?>:</div>
                            <div class="val">
                                <?php echo e($type['number']); ?>

                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <li>
                        <div class="label"><?php echo e(__("Guests")); ?>:</div>
                        <div class="val">
                            <?php echo e($booking->total_guests); ?>

                        </div>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
        
        <div class="review-section total-review">
            <ul class="review-list">
                <?php $person_types = $booking->getJsonMeta('person_types') ?>
                <?php if(!empty($person_types)): ?>
                    <?php $__currentLoopData = $person_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="label"><?php echo e($type['name']); ?>: <?php echo e($type['number']); ?> * <?php echo e(format_money($type['price'])); ?></div>
                            <div class="val">
                                <?php echo e(format_money($type['price'] * $type['number'])); ?>

                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <li>
                        <div class="label"><?php echo e(__("Guests")); ?>: <?php echo e($booking->total_guests); ?> * <?php echo e(format_money($booking->getMeta('base_price'))); ?></div>
                        <div class="val">
                            <?php echo e(format_money($booking->getMeta('base_price') * $booking->total_guests)); ?>

                        </div>
                    </li>
                <?php endif; ?>
                <?php $extra_price = $booking->getJsonMeta('extra_price') ?>
                <?php if(!empty($extra_price)): ?>
                    <li>
                        <div class="label-title"><strong><?php echo e(__("Extra Prices:")); ?></strong></div>
                    </li>
                    <li class="no-flex">
                        <ul>
                            <?php $__currentLoopData = $extra_price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="label"><?php echo e($type['name']); ?>:</div>
                                    <div class="val">
                                        <?php echo e(format_money($type['total'] ?? 0)); ?>

                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php $discount_by_people = $booking->getJsonMeta('discount_by_people')?>
                <?php if(!empty($discount_by_people)): ?>
                    <li>
                        <div class="label-title"><strong><?php echo e(__("Discounts:")); ?></strong></div>
                    </li>
                    <li class="no-flex">
                        <ul>
                            <?php $__currentLoopData = $discount_by_people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="label">
                                        <?php if(!$type['to']): ?>
                                            <?php echo e(__('from :from guests',['from'=>$type['from']])); ?>

                                        <?php else: ?>
                                            <?php echo e(__(':from - :to guests',['from'=>$type['from'],'to'=>$type['to']])); ?>

                                        <?php endif; ?>
                                        :
                                    </div>
                                    <div class="val">
                                        - <?php echo e(format_money($type['total'] ?? 0)); ?>

                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="final-total">
                    <div class="label"><?php echo e(__("Total:")); ?></div>
                    <div class="val"><?php echo e(format_money($booking->total)); ?></div>
                </li>
            </ul>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/booking/detail.blade.php ENDPATH**/ ?>