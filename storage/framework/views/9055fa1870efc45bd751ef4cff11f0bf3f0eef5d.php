<?php if(setting_item("tour_enable_review")): ?>
    <div class="bravo-reviews">
        <h2 class="title-review"><?php echo e(__("Reviews")); ?></h2>
        <?php if($review_score = $row->review_data): ?>
            <div class="review-box">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="review-box-score">
                            <div class="review-score">
                                <?php echo e($review_score['score_total']); ?><span class="per-total">/5</span>
                            </div>
                            <div class="review-score-text">
                                <?php echo e($review_score['score_text']); ?>

                            </div>
                            <div class="review-score-base">
                                <?php echo e(__("Based on")); ?> <span><?php echo e($review_score['total_review']); ?> <?php echo e(__("reviews")); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="review-sumary">
                            <?php if($review_score['rate_score']): ?>
                                <?php $__currentLoopData = $review_score['rate_score']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <div class="label">
                                            <?php echo e($item['title']); ?>

                                        </div>
                                        <div class="progress">
                                            <div class="percent green" style="width: <?php echo e($item['percent']); ?>%"></div>
                                        </div>
                                        <div class="number"><?php echo e($item['total']); ?></div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="review-list">
            <?php if($review_list): ?>
                <?php $__currentLoopData = $review_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $userInfo = $item->getUserInfo; ?>
                    <div class="review-item">
                        <div class="review-item-head">
                            <div class="media">
                                <div class="media-left">
                                    <?php if($avatar_url = $userInfo->getAvatarUrl()): ?>
                                        <img class="avatar" src="<?php echo e($avatar_url); ?>" alt="<?php echo e($userInfo->getDisplayName()); ?>">
                                    <?php else: ?>
                                        <span class="avatar-text"><?php echo e(ucfirst($userInfo->getDisplayName()[0])); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo e($userInfo->getDisplayName()); ?></h4>
                                    <div class="date"><?php echo e(display_datetime($item->created_at)); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="review-item-body">
                            <h4 class="title"> <?php echo e($item->title); ?> </h4>
                            <?php if($item->rate_number): ?>
                                <ul class="review-star">
                                    <?php for( $i = 0 ; $i < 5 ; $i++ ): ?>
                                        <?php if($i < $item->rate_number): ?>
                                            <li><i class="fa fa-star"></i></li>
                                        <?php else: ?>
                                            <li><i class="fa fa-star-o"></i></li>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </ul>
                            <?php endif; ?>
                            <div class="detail">
                                <?php echo e($item->content); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <div class="review-pag-wrapper">
            <?php if($review_list->total() > 0): ?>
                <div class="bravo-pagination">
                    <?php echo e($review_list->appends(request()->query())->fragment('review-list')->links()); ?>

                </div>
                <div class="review-pag-text">
                    <?php echo e(__("Showing :from - :to of :total total",["from"=>$review_list->firstItem(),"to"=>$review_list->lastItem(),"total"=>$review_list->total()])); ?>

                </div>
            <?php else: ?>
                <div class="review-pag-text"><?php echo e(__("No Review")); ?></div>
            <?php endif; ?>
        </div>
        <div class="review-form">
            <div class="title-form">
                <?php echo e(__("Write a review")); ?>

            </div>
            <div class="form-wrapper">
                <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <form action="<?php echo e(url("/review")); ?>" class="needs-validation" novalidate method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" required class="form-control" name="review_title" placeholder="<?php echo e(__("Title")); ?>">
                                <div class="invalid-feedback"><?php echo e(__('Review title is required')); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <textarea name="review_content" required class="form-control" placeholder="<?php echo e(__("Review content")); ?>" minlength="10"></textarea>
                                <div class="invalid-feedback">
                                    <?php echo e(__('Review content has at least 10 character')); ?>

                                </div>
                            </div>
                        </div>
                        <?php if($tour_review_stats = setting_item("tour_review_stats")): ?>
                            <?php $tour_review_stats = json_decode($tour_review_stats) ?>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group review-items">
                                    <?php $__currentLoopData = $tour_review_stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item">
                                            <label><?php echo e($item->title); ?></label>
                                            <input class="review_stats" type="hidden" name="review_stats[<?php echo e($item->title); ?>]">
                                            <div class="rates">
                                                <i class="fa fa-star-o grey"></i>
                                                <i class="fa fa-star-o grey"></i>
                                                <i class="fa fa-star-o grey"></i>
                                                <i class="fa fa-star-o grey"></i>
                                                <i class="fa fa-star-o grey"></i>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group review-items">
                                    <div class="item">
                                        <label><?php echo e(__("Review rate")); ?></label>
                                        <input class="review_stats" type="hidden" name="review_rate">
                                        <div class="rates">
                                            <i class="fa fa-star-o grey"></i>
                                            <i class="fa fa-star-o grey"></i>
                                            <i class="fa fa-star-o grey"></i>
                                            <i class="fa fa-star-o grey"></i>
                                            <i class="fa fa-star-o grey"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="text-center">
                        <input type="hidden" name="review_service_id" value="<?php echo e($row->id); ?>">
                        <input type="hidden" name="review_service_type" value="tour">
                        <input id="submit" type="submit" name="submit" class="btn" value="<?php echo e(__("Leave a Review")); ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/layouts/details/tour-review.blade.php ENDPATH**/ ?>