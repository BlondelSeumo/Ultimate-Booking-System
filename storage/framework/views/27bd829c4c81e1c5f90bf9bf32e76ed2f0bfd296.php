<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('module/tour/css/tour.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_search_tour">
        <div class="bravo_banner" <?php if($bg = setting_item("tour_page_search_banner")): ?> style="background-image: url(<?php echo e(get_file_url($bg,'full')); ?>)" <?php endif; ?> >
            <div class="container">
                <h1>
                    <?php echo e(setting_item("tour_page_search_title")); ?>

                </h1>
            </div>
        </div>
        <div class="bravo_form_search">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <?php echo $__env->make('Tour::frontend.layouts.search.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php echo $__env->make('Tour::frontend.layouts.search.list-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('module/tour/js/tour.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/search.blade.php ENDPATH**/ ?>