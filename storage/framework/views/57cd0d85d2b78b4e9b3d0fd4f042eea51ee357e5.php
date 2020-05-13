<div class="bravo-form-search-tour" style="background-image: url('<?php echo e($bg_image_url); ?>') !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-heading text-center"><?php echo e($title); ?></h1>
                <div class="sub-heading text-center"><?php echo e($sub_title); ?></div>
                <div class="g-form-control">
                    <?php echo $__env->make('Tour::frontend.blocks.form-search-tour.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/blocks/form-search-tour/index.blade.php ENDPATH**/ ?>