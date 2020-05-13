<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Languages")); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title"><?php echo e(__("Add Language")); ?></div>
                    <div class="panel-body">
                        <form action="" class="needs-validation" novalidate method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('Language::admin.language.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="">
                                <button class="btn btn-primary" type="submit"><?php echo e(__("Add new")); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel">
                    <div class="panel-title"><?php echo e(__("All Languages")); ?></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th><?php echo e(__("Name")); ?></th>
                                    <th><?php echo e(__("Locale")); ?></th>
                                    <th><?php echo e(__("Status")); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(count($rows) > 0): ?>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" class="check-item" name="ids[]" value="<?php echo e($row->id); ?>">
                                        </td>
                                        <td class="title">
                                            <a href="<?php echo e(url('/admin/module/language/edit/'.$row->id)); ?>">
                                                <?php if($row->flag): ?>
                                                    <span class="flag-icon flag-icon-<?php echo e($row->flag); ?>"></span>
                                                <?php endif; ?>
                                                <?php echo e($row->name); ?>

                                            </a>
                                        </td>
                                        <td><?php echo e($row->locale); ?></td>
                                        <td><?php echo e($row->status == 'publish' ? __('Publish'):__("Draft")); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4"><?php echo e(__("No data")); ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Language/Views/admin/language/index.blade.php ENDPATH**/ ?>