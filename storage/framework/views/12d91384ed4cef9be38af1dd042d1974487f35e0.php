<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Availability")); ?></strong></div>
    <div class="panel-body">
        <h3 class="panel-body-title"><?php echo e(__('Open Hours')); ?></h3>
        <div class="form-group">
            <label>
                <input type="checkbox" name="enable_open_hours" <?php if(!empty($row->meta->enable_open_hours)): ?> checked <?php endif; ?> value="1"> <?php echo e(__('Enable Open Hours')); ?>

            </label>
        </div>
        <?php $old = $row->meta->open_hours ?? [];?>
        <div class="table-responsive form-group" data-condition="enable_open_hours:is(1)">
            <table class="table">
                <thead>
                <tr>
                    <th><?php echo e(__('Enable?')); ?></th>
                    <th><?php echo e(__('Day of Week')); ?></th>
                    <th><?php echo e(__('Open')); ?></th>
                    <th><?php echo e(__('Close')); ?></th>
                </tr>
                </thead>
                <?php for($i = 1 ; $i <=7 ; $i++): ?>
                    <tr>
                        <td>
                            <input style="display: inline-block" type="checkbox" <?php if($old[$i]['enable']  ?? false ): ?> checked <?php endif; ?> name="open_hours[<?php echo e($i); ?>][enable]" value="1">
                        </td>
                        <td><strong>
                                <?php switch($i):
                                    case (1): ?>
                                    <?php echo e(__('Monday')); ?>

                                    <?php break; ?>
                                    <?php case (2): ?>
                                    <?php echo e(__('Tuesday')); ?>

                                    <?php break; ?>
                                    <?php case (3): ?>
                                    <?php echo e(__('Wednesday')); ?>

                                    <?php break; ?>
                                    <?php case (4): ?>
                                    <?php echo e(__('Thursday')); ?>

                                    <?php break; ?>
                                    <?php case (5): ?>
                                    <?php echo e(__('Friday')); ?>

                                    <?php break; ?>
                                    <?php case (6): ?>
                                    <?php echo e(__('Saturday')); ?>

                                    <?php break; ?>
                                    <?php case (7): ?>
                                    <?php echo e(__('Sunday')); ?>

                                    <?php break; ?>
                                <?php endswitch; ?>
                            </strong></td>
                        <td>
                            <select class="form-control" name="open_hours[<?php echo e($i); ?>][from]">
                                <?php
                                $time = strtotime('2019-01-01 00:00:00');
                                for($k = 0; $k <= 23; $k++):

                                $val = date('H:i', $time + 60 * 60 * $k);
                                ?>
                                <option <?php if(isset($old[$i]) and $old[$i]['from'] == $val): ?> selected <?php endif; ?> value="<?php echo e($val); ?>"><?php echo e($val); ?></option>

                                <?php endfor;?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="open_hours[<?php echo e($i); ?>][to]">
                                <?php
                                $time = strtotime('2019-01-01 00:00:00');
                                for($k = 0; $k <= 23; $k++):

                                $val = date('H:i', $time + 60 * 60 * $k);
                                ?>
                                <option <?php if(isset($old[$i]) and  $old[$i]['to'] == $val ): ?> selected <?php endif; ?> value="<?php echo e($val); ?>"><?php echo e($val); ?></option>

                                <?php endfor;?>
                            </select>
                        </td>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/admin/tour/availability.blade.php ENDPATH**/ ?>