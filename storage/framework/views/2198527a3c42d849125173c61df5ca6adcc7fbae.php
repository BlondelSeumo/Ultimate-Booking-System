<?php if($list_item): ?>
    <div class="bravo-featured-item">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $image_url = get_file_url($item['icon_image'], 'full') ?>
                    <div class="col-md-4">
                        <div class="featured-item">
                            <div class="image">
                                <img src="<?php echo e($image_url); ?>" class="img-responsive">
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    <?php echo e($item['title']); ?>

                                </h4>
                                <div class="desc"><?php echo e($item['sub_title']); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/blocks/list-featured-item/index.blade.php ENDPATH**/ ?>