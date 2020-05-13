<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Translate Manager for: :name",['name'=>$lang->name])); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="filter-div d-flex justify-content-between">
                    <div class="col-left">
                        <form method="get" action="" class="filter-form filter-form-left d-flex justify-content-start flex-column flex-sm-row">
                            <select name="type" class="form-control">
                                <option value=""><?php echo e(__("All text")); ?></option>
                                <option <?php if(Request()->type == 'not_translated'): ?> selected <?php endif; ?> value="not_translated"><?php echo e(__("Not translated")); ?></option>
                                <option <?php if(Request()->type == 'translated'): ?> selected <?php endif; ?> value="translated"><?php echo e(__("Translated")); ?></option>
                            </select>
                            <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Search by key ...')); ?>" class="form-control">
                            <button class="btn-info btn btn-icon" type="submit"><?php echo e(__('Filter')); ?></button>
                        </form>
                    </div>
                    <div class="col-left">
                        <p><i><?php echo e(__('Found :total texts',['total'=>$origins->total()])); ?></i></p>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-title"><?php echo e(__("Translate")); ?></div>
                    <div class="panel-body">
                        <form action="<?php echo e(url('admin/module/language/translations/store/'.$lang->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="50px"></th>
                                    <th width="50%"><?php echo e(__("Origin")); ?></th>
                                    <th><?php echo e(__("Translated")); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $origins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($origins->firstItem() + $k); ?></td>
                                        <td>
                                            <?php echo e($item->string); ?>

                                        </td>
                                        <td>
                                            <textarea name="translate[<?php echo e($item->id); ?>]" class="form-control"><?php echo e($item->translate); ?></textarea>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <button class="btn btn-success"><?php echo e(__('Save changes')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-end"><?php echo e($origins->links()); ?></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Language/Views/translations/detail.blade.php ENDPATH**/ ?>