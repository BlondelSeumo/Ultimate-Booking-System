<div class="sidebar-widget widget_tag_cloud">
    <div class="sidebar-title"><h4><?php echo e($item->title); ?></h4></div>
    <div class="tagcloud">
        <?php
            $list_tags = $model_tag->get();
        ?>
        <ul>
            <?php if($list_tags): ?>
                <?php $__currentLoopData = $list_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(url("/news/tag/".$tag->slug)); ?>" class="tag-cloud-link"><?php echo e($tag->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/News/Views/frontend/layouts/sidebars/tag.blade.php ENDPATH**/ ?>