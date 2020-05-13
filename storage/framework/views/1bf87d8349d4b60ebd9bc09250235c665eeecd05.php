<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('module/tour/css/tour.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
    <style type="text/css">
        .bravo_topbar, .bravo_footer {
            display: none
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_search_tour">
        <div class="bravo_form_search_map">
            <?php echo $__env->make('Tour::frontend.layouts.search-map.form-search-map', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="bravo_search_map">
            <div class="results_map">
                <div class="map-loading d-none">
                    <div class="st-loader"></div>
                </div>
                <div id="bravo_results_map" class="results_map_inner"></div>
            </div>
            <div class="results_item">
                <?php echo $__env->make('Tour::frontend.layouts.search-map.advance-filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="listing_items">
                    <?php echo $__env->make('Tour::frontend.layouts.search-map.list-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>

    <script>
        var bravo_map_data = {
            markers:<?php echo json_encode($markers); ?>

        };
    </script>
    <script type="text/javascript" src="<?php echo e(asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('module/tour/js/tour-map.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/search-map.blade.php ENDPATH**/ ?>