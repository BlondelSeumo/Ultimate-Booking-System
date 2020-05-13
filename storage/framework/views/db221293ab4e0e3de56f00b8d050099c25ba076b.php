<?php if($list_item): ?>
    <div class="bravo-testimonial">
        <div class="container">
            <h3><?php echo e($title); ?></h3>
            <div class="row">
                <?php $__currentLoopData = $list_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $avatar_url = get_file_url($item['avatar'], 'full') ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="item has-matchHeight">
                            <div class="author">
                                <img src="<?php echo e($avatar_url); ?>" alt="<?php echo e($item['name']); ?>">
                                <div class="author-meta">
                                    <h4><?php echo e($item['name']); ?></h4>
                                    <?php if($item['number_star']): ?>
                                        <div class="star">
                                            <?php for($i = 0 ; $i < $item['number_star'] ; $i++): ?>
                                                <i class="fa fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p>
                                <?php echo e($item['desc']); ?>

                            </p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/blocks/testimonial/index.blade.php ENDPATH**/ ?>