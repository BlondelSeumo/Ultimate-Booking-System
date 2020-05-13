<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(url('admin/module/user/role/save_permissions')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e(__('Permission Matrix')); ?></h1>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <td><strong><?php echo e(__('Role')); ?></strong></td>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><strong><?php echo e(ucfirst($role->name)); ?></strong></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $permissions_group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gName=>$permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="">
                                            <td>
                                                <strong><?php echo e(ucfirst($gName)); ?></strong>
                                            </td>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td></td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        <?php if(!empty($permissions)): ?>
                                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($permission->name); ?></td>
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <td>
                                                            <input type="checkbox" <?php if(in_array($permission->id,$selectedIds[$role->id])): ?> checked <?php endif; ?> name="matrix[<?php echo e($role->id); ?>][]" value="<?php echo e($permission->id); ?>">
                                                        </td>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>&nbsp;</span>
                        <button class="btn btn-primary" type="submit"><?php echo e(__('Save Change')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script.body'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/User/Views/admin/role/permission_matrix.blade.php ENDPATH**/ ?>