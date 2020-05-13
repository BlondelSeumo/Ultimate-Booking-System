<?php $__env->startSection('content'); ?>
    <form action="" method="post">
        <?php echo csrf_field(); ?>
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? __('Edit: ') .$row->title :  __('Add new page')); ?></h1>
                    <?php if($row->slug): ?>
                        <p class="item-url-demo"><?php echo e(__('Permalink: ')); ?> <?php echo e(url( config('page.page_route_prefix') )); ?>/<a href="#" class="open-edit-input" data-name="slug"><?php echo e($row->slug); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if($row->slug): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e($row->getDetailUrl()); ?>" target="_blank"><?php echo e(__('View page')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title"><?php echo e(__('Page Content')); ?></h3>
                            <div class="form-group">
                                <label><?php echo e(__('Title')); ?></label>
                                <input type="text" value="<?php echo e($row->title); ?>" placeholder="Page title" name="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__('Content')); ?></label>
                                <div class="">
                                    <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($row->content); ?></textarea>
                                </div>
                            </div>
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
                        <div class="panel-title"><strong><?php echo e(__('Template Setting')); ?></strong></div>
                        <div class="panel-body">
                            <select name="template_id" class="form-control">
                                <option value=""><?php echo e(__('-- Select --')); ?></option>
                                <?php if($templates): ?>
                                    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($template->id); ?>" <?php if($row->template_id == $template->id): ?> selected <?php endif; ?> ><?php echo e($template->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title"><?php echo e(__('Feature Image')); ?></h3>
                            <div class="form-group">
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script.body'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Page/Views/admin/detail.blade.php ENDPATH**/ ?>