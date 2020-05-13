<?php
    $selected = (array) Request::query('terms');
?>
<div id="advance_filters" class="d-none">
    <div class="ad-filter-b">
        <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // if($item->terms->count() < 0) continue;
            ?>
            <div class="filter-item">
                <div class="filter-title"><strong><?php echo e($item->name); ?></strong></div>
                <ul class="filter-items row">
                    <?php $__currentLoopData = $item->terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="filter-term-item col-xs-6 col-md-4">
                            <label><input <?php if(in_array($term->id,$selected)): ?> checked <?php endif; ?> type="checkbox" name="terms[]" value="<?php echo e($term->id); ?>"> <?php echo e($term->name); ?>

                            </label>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="ad-filter-f text-right">
        <a href="#" onclick="return false" class="btn btn-primary btn-apply-advances"><?php echo e(__("Apply Filters")); ?></a>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/layouts/search-map/advance-filter.blade.php ENDPATH**/ ?>