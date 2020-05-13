<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('module/tour/css/tour.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/fotorama/fotorama.css")); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_detail_tour">
        <?php echo $__env->make('Tour::frontend.layouts.details.tour-banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="bravo_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-9">
                        <?php echo $__env->make('Tour::frontend.layouts.details.tour-detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('Tour::frontend.layouts.details.tour-review', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-md-12 col-lg-3">
                        <?php echo $__env->make('Tour::frontend.layouts.details.tour-form-book', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="row end_tour_sticky">
                    <div class="col-md-12">
                        <?php echo $__env->make('Tour::frontend.layouts.details.tour-related', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bravo-more-book-mobile">
            <div class="container">
                <div class="left">
                    <div class="g-price">
                        <div class="prefix">
                            <span class="fr_text"><?php echo e(__("from")); ?></span>
                        </div>
                        <div class="price">
                            <span class="onsale"><?php echo e($row->display_sale_price); ?></span>
                            <span class="text-price"><?php echo e($row->display_price); ?></span>
                        </div>
                    </div>
                    <?php
                    $reviewData = $row->getScoreReview();
                    $score_total = $reviewData['score_total'];
                    ?>
                    <div class="service-review tour-review-<?php echo e($score_total); ?>">
                        <div class="list-star">
                            <ul class="booking-item-rating-stars">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                            </ul>
                            <div class="booking-item-rating-stars-active" style="width: <?php echo e($score_total * 2 * 10 ?? 0); ?>%">
                                <ul class="booking-item-rating-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                        </div>
                        <span class="review">
                        <?php if($reviewData['total_review'] > 1): ?>
                                <?php echo e(__(":number Reviews",["number"=>$reviewData['total_review'] ])); ?>

                            <?php else: ?>
                                <?php echo e(__(":number Review",["number"=>$reviewData['total_review'] ])); ?>

                            <?php endif; ?>
                    </span>
                    </div>
                </div>
                <div class="right">
                    <a class="btn btn-primary bravo-button-book-mobile"><?php echo e(__("Book Now")); ?></a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>

    <script>
        jQuery(function ($) {
            <?php if($row->map_lat && $row->map_lng): ?>
            new BravoMapEngine('map_content', {
                disableScripts: true,
                fitBounds: true,
                center: [<?php echo e($row->map_lat); ?>, <?php echo e($row->map_lng); ?>],
                zoom:<?php echo e($row->map_zoom ?? "8"); ?>,
                ready: function (engineMap) {
                    engineMap.addMarker([<?php echo e($row->map_lat); ?>, <?php echo e($row->map_lng); ?>], {
                        icon_options: {}
                    });
                }
            });
            <?php endif; ?>
        })
    </script>
    <script>
        var bravo_booking_data = <?php echo json_encode($booking_data); ?>

    </script>
    <script type="text/javascript" src="<?php echo e(asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset("libs/fotorama/fotorama.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset("libs/sticky/jquery.sticky.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('module/tour/js/single-tour.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/detail.blade.php ENDPATH**/ ?>