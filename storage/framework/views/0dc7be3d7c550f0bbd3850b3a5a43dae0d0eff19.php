<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__("Site Information")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Information of your website for customer and goole')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" ><?php echo e(__("Site title")); ?></label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="site_title" value="<?php echo e($settings['site_title'] ?? 'Booking Core'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label ><?php echo e(__("Site Desc")); ?></label>
                    <div class="form-controls">
                        <textarea name="site_desc" class="form-control" cols="30" rows="7"><?php echo e($settings['site_desc'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label ><?php echo e(__("Date format")); ?></label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="date_format" value="<?php echo e($settings['date_format'] ?? 'm/d/Y'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__('Language')); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Change language of your websites')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label ><?php echo e(__("Select default language")); ?></label>
                    <div class="form-controls">
                        <select name="site_locale" class="form-control">
                            <option value=""><?php echo e(__("-- Default --")); ?></option>
                            <?php
                                $langs = \Modules\Language\Models\Language::getActive();
                            ?>

                            <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($lang->locale == ($settings['site_locale'] ?? '') ): ?> selected <?php endif; ?> value="<?php echo e($lang->locale); ?>"><?php echo e($lang->name); ?> - (<?php echo e($lang->locale); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <p><i><a href="<?php echo e(url('admin/module/language')); ?>"><?php echo e(__("Manage languages here")); ?></a></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__('Contact Information')); ?></h3>
        <p class="form-group-desc"><?php echo e(__('How your customer can contact to you')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label ><?php echo e(__("Admin Email")); ?></label>
                    <div class="form-controls">
                        <input type="email" class="form-control" name="admin_email" value="<?php echo e($settings['admin_email'] ?? ''); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__('Homepage')); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Change your homepage content')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label ><?php echo e(__("Page for Homepage")); ?></label>
                    <div class="form-controls">
                        <?php
                            $template = !empty($settings['home_page_id']) ? \Modules\Page\Models\Page::find($settings['home_page_id'] ) : false;

                            \App\Helpers\AdminForm::select2('home_page_id',[
                            'configs'=>[
                                    'ajax'=>[
                                        'url'=>url('/admin/module/page/getForSelect2'),
                                        'dataType'=>'json'
                                    ]
                                ]
                            ],
                            !empty($template->id) ? [$template->id,$template->title] :false
                            )
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__('Header & Footer Settings')); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Change your options')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label ><?php echo e(__("Logo")); ?></label>
                    <div class="form-controls form-group-image">
                        <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('logo_id',$settings['logo_id'] ?? ''); ?>

                    </div>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Social share")); ?></label>
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-5"><?php echo e(__("Link share")); ?></div>
                                    <div class="col-md-2"><?php echo e(__('Class icon')); ?></div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="g-items">
                                <?php
                                if(!empty($settings['social_share'])){
                                    $social_share = json_decode($settings['social_share']);
                                    ?>
                                    <?php $__currentLoopData = $social_share; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-number="<?php echo e($key); ?>">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <input type="text" name="social_share[<?php echo e($key); ?>][link]" class="form-control" value="<?php echo e($item->link); ?>" placeholder="<?php echo e(__('Eg: https://facebook.com')); ?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" min="0" name="social_share[<?php echo e($key); ?>][class_icon]" class="form-control" value="<?php echo e($item->class_icon); ?>" placeholder="<?php echo e(__('Eg: fa fa-facebook')); ?>">
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
                                        <div class="col-md-5">
                                            <input type="text" __name__="social_share[__number__][link]" class="form-control" value="" placeholder="<?php echo e(__('Eg: https://facebook.com')); ?>">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" min="0" __name__="social_share[__number__][class_icon]" class="form-control" value="" placeholder="<?php echo e(__('Eg: fa fa-facebook')); ?>">
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
                <div class="form-group">
                    <label><?php echo e(__("Footer List Widget")); ?></label>
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="form-group-item">
                                <div class="g-items-header">
                                    <div class="row">
                                        <div class="col-md-3"><?php echo e(__("Title")); ?></div>
                                        <div class="col-md-2"><?php echo e(__('Size')); ?></div>
                                        <div class="col-md-6"><?php echo e(__('Content')); ?></div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div class="g-items">
                                    <?php
                                    if(!empty($settings['list_widget_footer'])){
                                    $social_share = json_decode($settings['list_widget_footer']);
                                    ?>
                                    <?php $__currentLoopData = $social_share; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item" data-number="<?php echo e($key); ?>">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" name="list_widget_footer[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($item->title); ?>">
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control" name="list_widget_footer[<?php echo e($key); ?>][size]">
                                                        <option <?php if(!empty($item->size) && $item->size=='3'): ?> selected <?php endif; ?> value="3">1/4</option>
                                                        <option <?php if(!empty($item->size) && $item->size=='4'): ?> selected <?php endif; ?> value="4">1/3</option>
                                                        <option <?php if(!empty($item->size) && $item->size=='6'): ?> selected <?php endif; ?> value="6">1/2</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea name="list_widget_footer[<?php echo e($key); ?>][content]" rows="5" class="form-control"><?php echo e($item->content); ?></textarea>
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
                                            <div class="col-md-3">
                                                <input type="text" __name__="list_widget_footer[__number__][title]" class="form-control" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" __name__="list_widget_footer[__number__][size]">
                                                    <option value="3">1/4</option>
                                                    <option value="4">1/3</option>
                                                    <option value="6">1/2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <textarea __name__="list_widget_footer[__number__][content]" class="form-control" rows="5"></textarea>
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
                <div class="form-group">
                    <label><?php echo e(__("Footer Text Left")); ?></label>
                    <div class="form-controls">
                        <textarea name="footer_text_left" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($settings['footer_text_left'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Footer Text Left")); ?></label>
                    <div class="form-controls">
                        <textarea name="footer_text_right" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($settings['footer_text_right'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/Core/Views/admin/settings/groups/general.blade.php ENDPATH**/ ?>