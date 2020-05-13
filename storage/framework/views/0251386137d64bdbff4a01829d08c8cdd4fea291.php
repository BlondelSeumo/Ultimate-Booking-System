<?php if(!empty($breadcrumbs)): ?>
    <div class="blog-breadcrumb hidden-xs">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(url("/")); ?>"> <?php echo e(__('Home')); ?></a></li>
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php echo e($breadcrumb['class'] ?? ''); ?>">
                        <?php if(!empty($breadcrumb['url'])): ?>
                            <a href="<?php echo e(url($breadcrumb['url'])); ?>"><?php echo e($breadcrumb['name']); ?></a>
                        <?php else: ?>
                            <?php echo e($breadcrumb['name']); ?>

                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?><?php /**PATH E:\Dungdt\booking-core\modules/News/Views/frontend/layouts/details/news-breadcrumb.blade.php ENDPATH**/ ?>