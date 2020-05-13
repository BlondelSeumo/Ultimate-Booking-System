<div class="sidebar-widget widget_bloglist">
    <div class="sidebar-title">
        <h4><?php echo e($item->title); ?></h4>
    </div>
    <ul class="thumb-list">
        <?php $list_blog = $model_news->with('getCategory')->orderBy('id','desc')->paginate(5) ?>
        <?php if($list_blog): ?>
            <?php $__currentLoopData = $list_blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php if($image_url = get_file_url($blog->image_id, 'thumb')): ?>
                        <div class="thumb">
                            <a href="<?php echo e($blog->getDetailUrl()); ?>">
                                
                                <?php echo get_image_tag($blog->image_id,'thumb',['class'=>'','alt'=>$blog->title]); ?>


                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="content">
                        <?php if(!empty($blog->getCategory->name)): ?>
                            <div class="cate">
                                <a href="<?php echo e(asset('news/category/'.$blog->getCategory->slug)); ?>">
                                    <?php echo e($blog->getCategory->name ?? ''); ?>

                                </a>
                            </div>
                        <?php endif; ?>
                        <h5 class="thumb-list-item-title">
                            <a href="<?php echo e($blog->getDetailUrl()); ?>"><?php echo e($blog->title); ?></a>
                        </h5>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </ul>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/News/Views/frontend/layouts/sidebars/recent_news.blade.php ENDPATH**/ ?>