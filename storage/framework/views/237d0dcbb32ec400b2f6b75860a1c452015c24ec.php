<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('installer_messages.welcome.templateTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Booking Core :version Installer',['version'=>config('app.version')])); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
    <p class="text-center">
      <?php echo e(trans('installer_messages.welcome.message')); ?>

    </p>
    <p class="text-center">
      <a href="<?php echo e(route('LaravelInstaller::requirements')); ?>" class="button">
        <?php echo e(trans('installer_messages.welcome.next')); ?>

        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
      </a>
    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\resources\views/vendor/installer/welcome.blade.php ENDPATH**/ ?>