<?php $__env->startSection('content'); ?>

    <div class="b-container">
        <div class="b-panel">
            <h3 class="email-headline"><strong><?php echo e(__('Hello Administrator')); ?></strong></h3>
            <p><?php echo e(__('Here are new contact information:')); ?></p>
            <br>
            <div class="b-panel">
                <div class="b-table-wrap">
                    <table class="b-table" cellspacing="0" cellpadding="0">
                        <tr class="info-first-name">
                            <td class="label"><?php echo e(__('Name')); ?></td>
                            <td class="val"><?php echo e($contact->name); ?></td>
                        </tr>
                        <tr class="info-first-name">
                            <td class="label"><?php echo e(__('Email')); ?></td>
                            <td class="val"><?php echo e($contact->email); ?></td>
                        </tr>
                        <tr class="info-first-name">
                            <td class="label"><?php echo e(__('Message')); ?></td>
                            <td class="val"><?php echo e($contact->message); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Email::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Contact/Views/emails/notification.blade.php ENDPATH**/ ?>