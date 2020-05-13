<div class="form-group">
    <label><?php echo e(__("Name")); ?></label>
    <input type="text" value="<?php echo e($row->name); ?>" placeholder="<?php echo e(__("Location name")); ?>" name="name" class="form-control">
</div>
<div class="form-group">
    <label><?php echo e(__("Parent")); ?></label>
    <select name="parent_id" class="form-control">
        <option value=""><?php echo e(__("-- Please Select --")); ?></option>
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
            foreach ($categories as $category) {
                if ($category->id == $row->id) {
                    continue;
                }
                $selected = '';
                if ($row->parent_id == $category->id)
                    $selected = 'selected';
                printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($parents);
        ?>
    </select>
</div>
<div class="form-group">
    <label class="control-label"><?php echo e(__("Description")); ?></label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($row->content); ?></textarea>
    </div>
</div>
<div class="form-group form-index-hide">
    <label class="control-label"><?php echo e(__("Map Engine")); ?></label>
    <div class="control-map-group">
        <div id="map_content"></div>
        <div class="g-control">
            <div class="form-group">
                <label><?php echo e(__("Map Lat")); ?>:</label>
                <input type="text" name="map_lat" class="form-control" value="<?php echo e($row->map_lat); ?>">
            </div>
            <div class="form-group">
                <label><?php echo e(__("Map Lng")); ?>:</label>
                <input type="text" name="map_lng" class="form-control" value="<?php echo e($row->map_lng); ?>">
            </div>
            <div class="form-group">
                <label><?php echo e(__("Map Zoom")); ?>:</label>
                <input type="text" name="map_zoom" class="form-control" value="<?php echo e($row->map_zoom ?? "8"); ?>">
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Location/Views/admin/form.blade.php ENDPATH**/ ?>