<?php $__env->startSection('content'); ?>
    <form action="" method="post">
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? 'Edit: '.$row->name : __("'Add new location'")); ?></h1>
                    <?php if($row->slug): ?>
                        <p class="item-url-demo"><?php echo e(__("Permalink")); ?>: <?php echo e(url('news-category')); ?>/<a href="#" class="open-edit-input" data-name="slug"><?php echo e($row->slug); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if($row->slug): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e($row->detail_url); ?>" target="_blank"><?php echo e(__("View")); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="panel">
                        <div class="panel-title"><?php echo e(__("Language Content")); ?></div>
                        <div class="panel-body">
                            <?php echo $__env->make('Language::admin.language.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span></span>
                        <button class="btn btn-primary" type="submit"><?php echo e(__("Save Change")); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script.body'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Language/Views/admin/language/detail.blade.php ENDPATH**/ ?>