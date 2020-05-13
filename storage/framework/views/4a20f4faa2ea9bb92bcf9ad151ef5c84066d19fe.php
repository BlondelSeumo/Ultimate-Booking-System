<?php
$meta_seo = $row->getSeoMeta();
$seo_share = $meta_seo['seo_share'] ?? false;
?>
<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Seo Manager")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label">
                <?php echo e(__("Allow search engines to show this service in search results?")); ?>

            </label>
            <select name="seo_index" class="form-control">
                <option value="1" <?php if(isset($meta_seo['seo_index']) and $meta_seo['seo_index'] == 1): ?> selected <?php endif; ?>><?php echo e(__("Yes")); ?></option>
                <option value="0" <?php if(isset($meta_seo['seo_index']) and $meta_seo['seo_index'] == 0): ?> selected <?php endif; ?>><?php echo e(__("No")); ?></option>
            </select>
        </div>
        <ul class="nav nav-tabs" data-condition="seo_index:is(1)">
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
        <div class="tab-content" data-condition="seo_index:is(1)">
            <div class="tab-pane active" id="seo_1">
                <div class="form-group" >
                    <label class="control-label"><?php echo e(__("Seo Title")); ?></label>
                    <input type="text" name="seo_title" class="form-control" placeholder="<?php echo e($row->title ?? $row->name ?? __("Leave blank to use service title")); ?>" value="<?php echo e($meta_seo['seo_title'] ?? ""); ?>">
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Seo Description")); ?></label>
                    <textarea name="seo_desc" rows="3" class="form-control" placeholder="<?php echo e($row->short_desc ?? __("Enter description...")); ?>"><?php echo e($meta_seo['seo_desc'] ?? ""); ?></textarea>
                </div>
                <div class="form-group form-group-image">
                    <label class="control-label"><?php echo e(__("Featured Image")); ?></label>
                    <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('seo_image', $meta_seo['seo_image'] ?? "" ); ?>

                </div>
            </div>
            <div class="tab-pane" id="seo_2">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Facebook Title")); ?></label>
                    <input type="text" name="seo_share[facebook][title]" class="form-control" placeholder="<?php echo e($row->title ?? $row->name ?? __("Enter title...")); ?>" value="<?php echo e($seo_share['facebook']['title'] ?? ""); ?>">
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Facebook Description")); ?></label>
                    <textarea name="seo_share[facebook][desc]" rows="3" class="form-control" placeholder="<?php echo e($row->short_desc ?? __("Enter description...")); ?>"><?php echo e($seo_share['facebook']['desc'] ?? ""); ?></textarea>
                </div>
                <div class="form-group form-group-image">
                    <label class="control-label"><?php echo e(__("Facebook Image")); ?></label>
                    <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ); ?>

                </div>
            </div>
            <div class="tab-pane" id="seo_3">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Twitter Title")); ?></label>
                    <input type="text" name="seo_share[twitter][title]" class="form-control" placeholder="<?php echo e($row->title ?? $row->name ?? __("Enter title...")); ?>" value="<?php echo e($seo_share['twitter']['title'] ?? ""); ?>">
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Twitter Description")); ?></label>
                    <textarea name="seo_share[twitter][desc]" rows="3" class="form-control" placeholder="<?php echo e($row->short_desc ?? __("Enter description...")); ?>"><?php echo e($seo_share['twitter']['desc'] ?? ""); ?></textarea>
                </div>
                <div class="form-group form-group-image">
                    <label class="control-label"><?php echo e(__("Twitter Image")); ?></label>
                    <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ); ?>

                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Core/Views/admin/seo-meta/seo-meta.blade.php ENDPATH**/ ?>