<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__("Page Search")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Config page search of your website')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" ><?php echo e(__("Title Page")); ?></label>
                    <div class="form-controls">
                        <input type="text" name="tour_page_search_title" value="<?php echo e($settings['tour_page_search_title'] ?? ''); ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="" ><?php echo e(__("Banner Page")); ?></label>
                    <div class="form-controls form-group-image">
                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('tour_page_search_banner',$settings['tour_page_search_banner'] ?? ""); ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="" ><?php echo e(__("Layout Search")); ?></label>
                    <div class="form-controls">
                        <select name="tour_layout_search" class="form-control" >
                            <option value="normal" <?php echo e(($settings['tour_layout_search'] ?? '') == 'normal' ? 'selected' : ''); ?>><?php echo e(__("Normal Layout")); ?></option>
                            <option value="map" <?php echo e(($settings['tour_layout_search'] ?? '') == 'map' ? 'selected' : ''); ?>><?php echo e(__('Map Layout')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="" ><?php echo e(__("SEO Options")); ?></label>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#seo_1"><?php echo e(__("General Options")); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_2"><?php echo e(__("Share Facebook")); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_3"><?php echo e(__("Share Twitter")); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content" >
                        <div class="tab-pane active" id="seo_1">
                            <div class="form-group" >
                                <label class="control-label"><?php echo e(__("Seo Title")); ?></label>
                                <input type="text" name="tour_page_list_seo_title" class="form-control" placeholder="<?php echo e(__("Enter title...")); ?>" value="<?php echo e($settings['tour_page_list_seo_title'] ?? ""); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Seo Description")); ?></label>
                                <input type="text" name="tour_page_list_seo_desc" class="form-control" placeholder="<?php echo e(__("Enter description...")); ?>" value="<?php echo e($settings['tour_page_list_seo_desc'] ?? ""); ?>">
                            </div>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Featured Image")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('tour_page_list_seo_image', $settings['tour_page_list_seo_image'] ?? "" ); ?>

                            </div>
                        </div>
                        <?php $seo_share = !empty($settings['tour_page_list_seo_share']) ? json_decode($settings['tour_page_list_seo_share'],true): false; ?>
                        <div class="tab-pane" id="seo_2">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Facebook Title")); ?></label>
                                <input type="text" name="tour_page_list_seo_share[facebook][title]" class="form-control" placeholder="<?php echo e(__("Enter title...")); ?>" value="<?php echo e($seo_share['facebook']['title'] ?? ""); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Facebook Description")); ?></label>
                                <input type="text" name="tour_page_list_seo_share[facebook][desc]" class="form-control" placeholder="<?php echo e(__("Enter description...")); ?>" value="<?php echo e($seo_share['facebook']['desc'] ?? ""); ?>">
                            </div>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Facebook Image")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('tour_page_list_seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ); ?>

                            </div>
                        </div>
                        <div class="tab-pane" id="seo_3">
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Twitter Title")); ?></label>
                                <input type="text" name="tour_page_list_seo_share[twitter][title]" class="form-control" placeholder="<?php echo e(__("Enter title...")); ?>" value="<?php echo e($seo_share['twitter']['title'] ?? ""); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo e(__("Twitter Description")); ?></label>
                                <input type="text" name="tour_page_list_seo_share[twitter][desc]" class="form-control" placeholder="<?php echo e(__("Enter description...")); ?>" value="<?php echo e($seo_share['twitter']['title'] ?? ""); ?>">
                            </div>
                            <div class="form-group form-group-image">
                                <label class="control-label"><?php echo e(__("Twitter Image")); ?></label>
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('tour_page_list_seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__("Review Options")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Config review for tour')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" ><?php echo e(__("Write review")); ?></label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="tour_enable_review" value="1" <?php if(!empty($settings['tour_enable_review'])): ?> checked <?php endif; ?> /> <?php echo e(__("On Review")); ?> </label>
                        <br>
                        <small class="form-text text-muted"><?php echo e(__("Turn on the mode for reviewing tour")); ?></small>
                    </div>
                </div>
                <div class="form-group" data-condition="tour_enable_review:is(1)">
                    <label class="" ><?php echo e(__("Enable review after booking")); ?></label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="tour_enable_review_after_booking" value="1"  <?php if(!empty($settings['tour_enable_review_after_booking'])): ?> checked <?php endif; ?> /> <?php echo e(__("On")); ?> </label>
                        <br>
                        <small class="form-text text-muted"><?php echo e(__("ON: Only post a review after booking - Off: Post review without booking")); ?></small>
                    </div>
                </div>
                <div class="form-group" data-condition="tour_enable_review:is(1)">
                    <label class="" ><?php echo e(__("Review approved")); ?></label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="tour_review_approved" value="1"  <?php if(!empty($settings['tour_review_approved'])): ?> checked <?php endif; ?> /> <?php echo e(__("On approved")); ?> </label>
                        <br>
                        <small class="form-text text-muted"><?php echo e(__("ON: Review must be approved by admin - OFF: Review is automatically approved")); ?></small>
                    </div>
                </div>
                <div class="form-group" data-condition="tour_enable_review:is(1)">
                    <label class="" ><?php echo e(__("Review number per page")); ?></label>
                    <div class="form-controls">
                        <input type="number" class="form-control" name="tour_review_number_per_page" value="<?php echo e($settings['tour_review_number_per_page'] ?? 5); ?>" />
                        <small class="form-text text-muted"><?php echo e(__("Break comments into pages")); ?></small>
                    </div>
                </div>
                <div class="form-group" data-condition="tour_enable_review:is(1)">
                    <label class="" ><?php echo e(__("Review criteria")); ?></label>
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-5"><?php echo e(__("Title")); ?></div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="g-items">
                                <?php
                                if(!empty($settings['tour_review_stats'])){
                                $social_share = json_decode($settings['tour_review_stats']);
                                ?>
                                <?php $__currentLoopData = $social_share; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item" data-number="<?php echo e($key); ?>">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" name="tour_review_stats[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($item->title); ?>" placeholder="<?php echo e(__('Eg: Service')); ?>">
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php } ?>
                            </div>
                            <div class="text-right">
                                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
                            </div>
                            <div class="g-more hide">
                                <div class="item" data-number="__number__">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text" __name__="tour_review_stats[__number__][title]" class="form-control" value="" placeholder="<?php echo e(__('Eg: Service')); ?>">
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Core/Views/admin/settings/groups/tour.blade.php ENDPATH**/ ?>