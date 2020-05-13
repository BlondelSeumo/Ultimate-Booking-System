<?php if(!empty($breadcrumbs)): ?>
<nav class="main-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(url('admin')); ?>"><i class='fa fa-home'></i> Dashboard</a></li>

            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="breadcrumb-item <?php echo e($breadcrumb['class'] ?? ''); ?>">
                    <?php if(!empty($breadcrumb['url'])): ?>
                        <a href="<?php echo e(url($breadcrumb['url'])); ?>"><?php echo e($breadcrumb['name']); ?></a>
                    <?php else: ?>
                        <?php echo e($breadcrumb['name']); ?>

                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ol>
</nav>
<?php endif; ?><?php /**PATH E:\Dungdt\booking-core\resources\views/admin/layouts/parts/bc.blade.php ENDPATH**/ ?>