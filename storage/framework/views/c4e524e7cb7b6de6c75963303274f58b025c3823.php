<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="post_item ">
        <div class="header">
            <?php if($image_url = get_file_url($row->image_id, 'full')): ?>
                <header class="post-header">
                    <?php echo get_image_tag($row->image_id,'full'); ?>

                </header>
                <div class="cate">
                    <?php if(!empty($row->getCategory->name)): ?>
                        <ul>
                            <li>
                                <a href="<?php echo e(asset('news/category/'.$row->getCategory->slug)); ?>">
                                    <?php echo e($row->getCategory->name ?? ''); ?>

                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="post-inner">
                <h4 class="post-title">
                    <a class="text-darken" href="<?php echo e($row->getDetailUrl()); ?>"> <?php echo e($row->title); ?></a>
                </h4>
                <div class="post-info">
                    <ul>
                        <li>
                            <?php if($avatar_url = $row->getAuthor->getAvatarUrl()): ?>
                                <img class="avatar" src="<?php echo e($avatar_url); ?>" alt="<?php echo e($row->getAuthor->name); ?>">
                            <?php else: ?>
                                <span class="avatar-text"><?php echo e(ucfirst($row->getAuthor->name[0])); ?></span>
                            <?php endif; ?>
                            <span> <?php echo e(__('BY ')); ?> </span>
                            <?php echo e($row->getAuthor->name ?? ''); ?>

                        </li>
                        <li> <?php echo e(__('DATE ')); ?>  <?php echo e(display_date($row->updated_at)); ?>  </li>
                    </ul>
                </div>
                <div class="post-desciption">
                    <?php echo e(get_exceprt($row->content)); ?>

                </div>
                <a class="btn-readmore" href="<?php echo e($row->getDetailUrl()); ?>"><?php echo e(__('Read More')); ?></a>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH E:\Dungdt\booking-core\modules/News/Views/frontend/layouts/details/news-loop.blade.php ENDPATH**/ ?>