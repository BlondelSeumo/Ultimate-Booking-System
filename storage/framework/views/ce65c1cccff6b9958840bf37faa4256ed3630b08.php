<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__("Currency")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Currency Format')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" ><?php echo e(__("Main Currency")); ?></label>
                    <div class="form-controls">
                        <?php echo \App\Helpers\AdminForm::select('currency_main',\App\Currency::getAll(),$settings['currency_main'] ?? 'usd','dungdt-select2-field'); ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label ><?php echo e(__("Format")); ?></label>
                            <div class="form-controls">
                                <?php echo \App\Helpers\AdminForm::select('currency_format',[
                                    ['id'=>'right','name'=>__('Right (100$)')],
                                    ['id'=>'right_space','name'=>__('Right with space (100 $)')],
                                    ['id'=>'left','name'=>__('Left ($100)')],
                                    ['id'=>'left_space','name'=>__('Left with space ($ 100)')],
                                ],$settings['currency_format'] ?? 'right'); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label ><?php echo e(__("Thousand Separator")); ?></label>
                            <div>
                                <input type="text" name="currency_thousand" class="form-control" value="<?php echo e($settings['currency_thousand'] ?? '.'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label ><?php echo e(__("Decimal Separator")); ?></label>
                            <div>
                                <input type="text" name="currency_decimal" class="form-control" value="<?php echo e($settings['currency_decimal'] ?? ','); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label ><?php echo e(__("No. of Decimals")); ?></label>
                            <div>
                                <input type="number" name="currency_no_decimal" min=0 max = 6 class="form-control" value="<?php echo e($settings['currency_no_decimal'] ?? 2); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <h3 class="form-group-title"><?php echo e(__("Payment Gateways")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('You can enable and disable your payment gateways here')); ?></p>
    </div>
    <div class="col-md-8">
        <?php
        $all = config('booking.payment_gateways');
        ?>
        <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                if(!class_exists($gateway)) continue;
                $obj = new $gateway($k);
                $options = $obj->getOptionsConfigsFormatted();
            ?>
            <div class="panel">
                <div class="panel-title"><strong><?php echo e($obj->name); ?></strong></div>
                <div class="panel-body">
                    <?php App\Helpers\AdminForm::generate($options); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Booking/Views/admin/settings/payment.blade.php ENDPATH**/ ?>