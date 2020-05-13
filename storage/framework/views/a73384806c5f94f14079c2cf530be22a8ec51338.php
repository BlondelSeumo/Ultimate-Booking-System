<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('module/news/css/news.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/daterange/daterangepicker.css")); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/fotorama/fotorama.css")); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo-news">
        <?php
            $title_page = setting_item("news_page_list_title");
            if(!empty($custom_title_page)){
                $title_page = $custom_title_page;
            }
        ?>
        <?php if(!empty($title_page)): ?>
            <div class="bravo_banner" <?php if($bg = setting_item("news_page_list_banner")): ?> style="background-image: url(<?php echo e(get_file_url($bg,'full')); ?>)" <?php endif; ?> >
                <div class="container">
                    <h1>
                        <?php echo e($title_page); ?>

                    </h1>
                </div>
            </div>
        <?php endif; ?>
        <?php echo $__env->make('News::frontend.layouts.details.news-breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="bravo_content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <?php if($rows->count() > 0): ?>
                            <div class="list-news">
                                <?php echo $__env->make('News::frontend.layouts.details.news-loop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <hr>
                                <div class="bravo-pagination">
                                    <?php echo e($rows->appends(request()->query())->links()); ?>

                                    <span class="count-string"><?php echo e(__("Showing :from - :to of :total Posts",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-danger">
                                <?php echo e(__("Sorry, but nothing matched your search terms. Please try again with some different keywords.")); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $__env->make('News::frontend.layouts.details.news-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

 
  
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/News/Views/frontend/index.blade.php ENDPATH**/ ?>