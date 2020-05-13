<div class="b-panel-title"><?php echo e(__('Tour information')); ?></div>
<div class="b-table-wrap">
    <table class="b-table" cellspacing="0" cellpadding="0">
        <tr>
            <td class="label"><?php echo e(__('Booking Number')); ?></td>
            <td class="val">#<?php echo e($booking->id); ?></td>
        </tr>
        <tr>
            <td class="label"><?php echo e(__('Booking Status')); ?></td>
            <td class="val"><?php echo e($booking->statusName); ?></td>
        </tr>
        <?php if($booking->gatewayObj): ?>
            <tr>
                <td class="label"><?php echo e(__('Payment method')); ?></td>
                <td class="val"><?php echo e($booking->gatewayObj->getOption('name')); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td class="label"><?php echo e(__('Tour name')); ?></td>
            <td class="val">
                <a href="<?php echo e($service->getDetailUrl()); ?>"><?php echo e($service->title); ?></a>
            </td>

        </tr>
        <tr>
            <?php if($service->address): ?>
                <td class="label"><?php echo e(__('Address')); ?></td>
                <td class="val">
                    <?php echo e($service->address); ?>

                </td>
            <?php endif; ?>
        </tr>
        <?php if($booking->start_date && $booking->end_date): ?>
            <tr>
                <td class="label"><?php echo e(__('Start date')); ?></td>
                <td class="val"><?php echo e(display_date($booking->start_date)); ?></td>
            </tr>

            <tr>
                <td class="label"><?php echo e(__('Duration:')); ?></td>
                <td class="val">
                    <?php echo e(human_time_diff($booking->end_date,$booking->start_date)); ?>

                </td>
            </tr>
        <?php endif; ?>

        <?php $person_types = $booking->getJsonMeta('person_types')
        ?>

        <?php if(!empty($person_types)): ?>
            <?php $__currentLoopData = $person_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="label"><?php echo e($type['name']); ?>:</td>
                    <td class="val">
                        <strong><?php echo e($type['number']); ?></strong>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <tr>
                <td class="label"><?php echo e(__("Guests")); ?>:</td>
                <td class="val">
                    <strong><?php echo e($booking->total_guests); ?></strong>
                </td>
            </tr>
        <?php endif; ?>
        <tr>
            <td class="label"><?php echo e(__('Pricing')); ?></td>
            <td class="val no-r-padding">
                <table class="pricing-list" width="100%">
                    <?php $person_types = $booking->getJsonMeta('person_types')
                    ?>

                    <?php if(!empty($person_types)): ?>
                        <?php $__currentLoopData = $person_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="label"><?php echo e($type['name']); ?>: <?php echo e($type['number']); ?> * <?php echo e(format_money($type['price'])); ?></td>
                                <td class="val no-r-padding">
                                    <strong><?php echo e(format_money($type['price'] * $type['number'])); ?></strong>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td class="label"><?php echo e(__("Guests")); ?>: <?php echo e($booking->total_guests); ?> <?php echo e(format_money($booking->getMeta('base_price'))); ?></td>
                            <td class="val no-r-padding">
                                <strong><?php echo e(format_money($booking->getMeta('base_price') * $booking->total_guests)); ?></strong>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php $extra_price = $booking->getJsonMeta('extra_price')?>

                    <?php if(!empty($extra_price)): ?>
                        <tr>
                            <td colspan="2" class="label-title"><strong><?php echo e(__("Extra Prices:")); ?></strong></td>
                        </tr>
                        <tr class="">
                            <td colspan="2" class="no-r-padding no-b-border">
                                <table width="100%">
                                <?php $__currentLoopData = $extra_price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="label"><?php echo e($type['name']); ?>:</td>
                                        <td class="val no-r-padding">
                                            <strong><?php echo e(format_money($type['total'] ?? 0)); ?></strong>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </td>
                        </tr>

                    <?php endif; ?>

                    <?php $discount_by_people = $booking->getJsonMeta('discount_by_people')
                    ?>
                    <?php if(!empty($discount_by_people)): ?>
                        <tr>
                            <td colspan="2" class="label-title"><strong><?php echo e(__("Discounts:")); ?></strong></td>
                        </tr>
                        <tr class="">
                            <td colspan="2" class="no-r-padding no-b-border">
                                <table width="100%">
                                <?php $__currentLoopData = $discount_by_people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="label">
                                            <?php if(!$type['to']): ?>
                                                <?php echo e(__('from :from guests',['from'=>$type['from']])); ?>

                                            <?php else: ?>
                                                <?php echo e(__(':from - :to guests',['from'=>$type['from'],'to'=>$type['to']])); ?>

                                            <?php endif; ?>
                                            :
                                        </td>
                                        <td class="val no-r-padding">
                                            <strong>- <?php echo e(format_money($type['total'] ?? 0)); ?></strong>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td class="label fsz21"><?php echo e(__('Total')); ?></td>
            <td class="val fsz21"><strong style="color: #FA5636"><?php echo e(format_money($booking->total)); ?></strong></td>
        </tr>
    </table>
</div>
<div class="text-center mt20">
    <a href="<?php echo e(url('user/report/booking')); ?>" class="btn btn-primary"><?php echo e(__('Manage Bookings')); ?></a>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/emails/new_booking_detail.blade.php ENDPATH**/ ?>