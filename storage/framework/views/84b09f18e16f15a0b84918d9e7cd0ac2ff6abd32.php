<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(url('admin/module/user/changepass/'.$row->id)); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? 'Change Password: '.$row->getDisplayName() : 'Add new user'); ?></h1>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-title">
                            <?php if($row->id): ?>
                                <strong class=""><?php echo e(__('Change Password')); ?></strong>
                            <?php else: ?>
                                <strong class=""><?php echo e(__('Password')); ?></strong>
                            <?php endif; ?>
                        </div>
                        <div class="panel-body">

                            <?php if($row->id and $row->id != $currentUser->id and !$currentUser->hasPermissionTo('user_update') ): ?>
                                <div class="form-group">
                                    <label><?php echo e(__('Old Password')); ?></label>
                                    <input type="password" value="" placeholder="<?php echo e(__('Old Password')); ?>" name="old_password" class="form-control" >
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label><?php echo e(__('New password')); ?></label>
                                <input type="password" value="" placeholder="<?php echo e(__('Password')); ?>" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Re-Password')); ?></label>
                                <input type="password" value="" placeholder="<?php echo e(__('Re-Password')); ?>" name="password_confirmation" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary"> <?php echo e(__('Change Password')); ?> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/User/Views/admin/password.blade.php ENDPATH**/ ?>