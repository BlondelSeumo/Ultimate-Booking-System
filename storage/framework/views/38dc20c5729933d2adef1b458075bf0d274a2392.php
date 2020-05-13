<?php $__env->startSection('content'); ?>
    <form action="" method="post" class="dungdt-form">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? __('Edit post: ').$row->title : __('Add new Post')); ?></h1>
                    <?php if($row->slug): ?>
                        <p class="item-url-demo"><?php echo e(__("Permalink")); ?>: <?php echo e(url( config('news.news_route_prefix'))); ?>/<a href="#" class="open-edit-input" data-name="slug"><?php echo e($row->slug); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if($row->slug): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e($row->getDetailUrl()); ?>" target="_blank"><?php echo e(__("View Post")); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('News content')); ?></strong></div>
                        <div class="panel-body">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('News::admin/news/form',['parents'=>$rows, 'row'=>$row], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <?php echo $__env->make('Core::admin/seo-meta/seo-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                        <div class="panel-body">
                            <div>
                                <label><input <?php if($row->status=='publish'): ?> checked <?php endif; ?> type="radio" name="status" value="publish"> <?php echo e(__("Publish")); ?>

                                </label></div>
                            <div>
                                <label><input <?php if($row->status=='draft'): ?> checked <?php endif; ?> type="radio" name="status" value="draft"> <?php echo e(__("Draft")); ?>

                                </label></div>
                            <div class="text-right">
                                <button class="btn btn-primary" type="submit"><?php echo e(__('Save Changes')); ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title"> <?php echo e(__('Feature Image')); ?></h3>
                            <div class="form-group">
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id); ?>

                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label"> <?php echo e(__('Tag')); ?></label>
                                <div class="">
                                    <input type="text" data-role="tagsinput" value="<?php echo e($row->tag); ?>" placeholder="<?php echo e(__('Enter tag')); ?>" name="tag" class="form-control tag-input">
                                    <br>
                                    <div class="show_tags">
                                        <?php if(!empty($tags)): ?>
                                            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="tag_item"><?php echo e($tag->name); ?><span data-role="remove"></span>
                                                    <input type="hidden" name="tag_ids[]" value="<?php echo e($tag->id); ?>">
                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/News/Views/admin/news/detail.blade.php ENDPATH**/ ?>