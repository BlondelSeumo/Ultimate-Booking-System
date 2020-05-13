<?php if(count($tour_related) > 0): ?>
    <div class="bravo-list-tour-related">
        <h2><?php echo e(__("You might also like")); ?></h2>
        <div class="row">
            <?php $__currentLoopData = $tour_related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <?php echo $__env->make('Tour::frontend.layouts.search.loop-gird', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/layouts/details/tour-related.blade.php ENDPATH**/ ?>