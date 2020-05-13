<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Translation Manager")); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="alert alert-warning">
            <?php echo e(__("After translation. You must re-build language file to apply the change")); ?>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-title"><?php echo e(__("All Languages")); ?></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th><?php echo e(__("Name")); ?></th>
                                <th><?php echo e(__("Percent")); ?></th>
                                <th><?php echo e(__("Translated")); ?></th>
                                <th><?php echo e(__("Last build at")); ?></th>
                                <th><?php echo e(__("Actions")); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(count($languages) > 0): ?>
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="title">
                                            <a href="<?php echo e(url('admin/module/language/translations/detail/'.$language->id)); ?>">
                                                <span class="flag-icon flag-icon-<?php echo e($language->flag); ?>"></span> <?php echo e($language->name); ?>

                                                - (<?php echo e($language->locale); ?>)
                                            </a>
                                        </td>
                                        <td><?php echo e($total_text ? $language->translated_percent / $total_text * 100 : 0); ?>%</td>
                                        <td><?php echo e($language->translated_number); ?>/<?php echo e($total_text); ?></td>
                                        <td><?php echo e($language->last_build_at ? display_datetime($language->last_build_at) : ''); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('admin/module/language/translations/detail/'.$language->id)); ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> <?php echo e(__("Translate")); ?>

                                            </a>
                                            <a href="<?php echo e(url('admin/module/language/translations/build/'.$language->id)); ?>" class="btn btn-sm btn-info"><i class="fa fa-cubes"></i> <?php echo e(__("Build")); ?>

                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5"><?php echo e(__("No data")); ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        </div>
                        <div class="d-flex justify-content-end"><?php echo e($languages->links()); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Language/Views/translations/index.blade.php ENDPATH**/ ?>