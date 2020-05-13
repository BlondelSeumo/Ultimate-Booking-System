<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center bravo-login-form-page bravo-login-page">
        <div class="col-md-5">
            <div class="">
                <h4 class="form-title"><?php echo e(__('Login')); ?></h4>
                <?php echo $__env->make('auth.login-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\resources\views/auth/login.blade.php ENDPATH**/ ?>