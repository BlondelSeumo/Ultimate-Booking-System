<div class="g-header">
    <div class="left">
        <h2><?php echo e($row->title); ?></h2>
    </div>
    <div class="right">
        <?php if($review_score = $row->review_data): ?>
            <div class="review-score">
                <span class="head-rating"><?php echo e($review_score['score_text']); ?></span>
                <div class="list-star">
                    <ul class="booking-item-rating-stars">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                    </ul>
                    <div class="booking-item-rating-stars-active" style="width: <?php echo e($review_score['score_total'] * 2 * 10 ?? 0); ?>%">
                        <ul class="booking-item-rating-stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                    </div>
                </div>
                <span>
                    <?php echo e(__("from :number reviews",['number'=>$review_score['total_review']])); ?>

                </span>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="g-tour-feature">
    <div class="row">
        <?php if($row->duration): ?>
            <div class="col-xs-6 col-lg-3 col-md-6">
                <div class="item">
                    <div class="icon">
                        <i class="icofont-wall-clock"></i>
                    </div>
                    <div class="info">
                        <h4 class="name"><?php echo e(__("Duration")); ?></h4>
                        <p class="value">
                            <?php if($row->duration > 1): ?>
                                <?php echo e(__(":number hours",array('number'=>$row->duration))); ?>

                            <?php else: ?>
                                <?php echo e(__(":number hour",array('number'=>$row->duration))); ?>

                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!empty($row->category_tour->name)): ?>
            <div class="col-xs-6 col-lg-3 col-md-6">
                <div class="item">
                    <div class="icon">
                        <i class="icofont-beach"></i>
                    </div>
                    <div class="info">
                        <h4 class="name"><?php echo e(__("Tour Type")); ?></h4>
                        <p class="value">
                            <?php echo e($row->category_tour->name ?? ''); ?>

                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if($row->max_people): ?>
            <div class="col-xs-6 col-lg-3 col-md-6">
                <div class="item">
                    <div class="icon">
                        <i class="icofont-travelling"></i>
                    </div>
                    <div class="info">
                        <h4 class="name"><?php echo e(__("Group Size")); ?></h4>
                        <p class="value">
                            <?php echo e($row->max_people); ?> <?php echo e(__("people")); ?>

                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!empty($row->location->name)): ?>
            <div class="col-xs-6 col-lg-3 col-md-6">
                <div class="item">
                    <div class="icon">
                        <i class="icofont-island-alt"></i>
                    </div>
                    <div class="info">
                        <h4 class="name"><?php echo e(__("Location")); ?></h4>
                        <p class="value">
                            <?php echo e($row->location->name ?? ''); ?>

                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php if($row->getGallery()): ?>
    <div class="g-gallery">
        <div class="fotorama" data-width="100%" data-thumbwidth="135" data-thumbheight="135" data-thumbmargin="15" data-nav="thumbs" data-allowfullscreen="true">
            <?php $__currentLoopData = $row->getGallery(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($item['large']); ?>"><img src="<?php echo e($item['thumb']); ?>"></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php if($row->content): ?>
    <div class="g-overview">
        <h3><?php echo e(__("Overview")); ?></h3>
        <div class="description">
            <?php echo $row->content ?>
        </div>
    </div>
<?php endif; ?>
<?php if($row->faqs): ?>
<div class="g-faq">
    <h3> <?php echo e(__("FAQs")); ?> </h3>
    <?php $__currentLoopData = $row->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item">
            <div class="header">
                <i class="field-icon icofont-support-faq"></i>
                <h5><?php echo e($item['title']); ?></h5>
                <span class="arrow"><i class="fa fa-angle-down"></i></span>
            </div>
            <div class="body">
                <?php echo e($item['content']); ?>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<?php if($row->map_lat && $row->map_lng): ?>
<div class="g-location">
    <h3><?php echo e(__("Tour Location")); ?></h3>
    <div class="location-map">
        <div id="map_content"></div>
    </div>
</div>
<?php endif; ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/layouts/details/tour-detail.blade.php ENDPATH**/ ?>