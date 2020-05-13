<?php
/**
 * Created by PhpStorm.
 * User: dunglinh
 * Date: 3/17/19
 * Time: 19:18
 */
?>


<?php $__env->startSection('content'); ?>
    <form action="" method="post">
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb40">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? 'Edit: '.$row->name : 'Add new category'); ?></h1>
                    <?php if($row->slug): ?>
                        <p class="item-url-demo">Permalink: <?php echo e(url('news-category')); ?>/<a href="#" class="open-edit-input" data-name="slug"><?php echo e($row->slug); ?></a></p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if($row->slug): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e($row->detail_url); ?>" target="_blank">View</a>
                    <?php endif; ?>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="panel-body-title">Category Content</h3>
                                <?php echo $__env->make('News::admin/category/form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="panel-body-title">Publish</h3>
                                <div class="form-group">
                                    <div><label ><input <?php if($row->status=='publish'): ?> checked <?php endif; ?> type="radio" name="status" value="publish"> Publish</label></div>
                                    <div><label ><input <?php if($row->status=='draft'): ?> checked <?php endif; ?> type="radio" name="status" value="draft"> Draft</label></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>
                    </span>
                    <button class="btn btn-primary" type="submit">Save Change</button>
                </div>

        </div>
    </form>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script.body'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* E:\Dungdt\booking-core\modules/News/Views/admin/category/detail.blade.php */ ?>