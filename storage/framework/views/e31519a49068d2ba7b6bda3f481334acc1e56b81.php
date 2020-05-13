<div class="container">
    <div class="bravo-list-locations">
        <div class="title">
            <?php echo e($title); ?>

        </div>
        <div class="list-item">
            <div class="row">
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-<?php if($key == 0) echo 8; else echo 4; ?>">
                        <?php echo $__env->make('Location::frontend.blocks.list-locations.loop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Location/Views/frontend/blocks/list-locations/index.blade.php ENDPATH**/ ?>