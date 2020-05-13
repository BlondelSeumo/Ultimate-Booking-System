<div class="form-group">
    <label><?php echo e(__('Title')); ?></label>
    <input type="text" value="<?php echo e($row->title ?? 'New Post'); ?>" placeholder="News title" name="title" class="form-control">
</div>
<div class="form-group">
    <label><?php echo e(__('Category')); ?> </label>
    <select name="cat_id" class="form-control">
        <option value=""><?php echo e(__('-- Please Select --')); ?> </option>
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
            foreach ($categories as $category) {
                $selected = '';
                if ($row->cat_id == $category->id)
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
    <label class="control-label"><?php echo e(__('Content')); ?> </label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($row->content); ?></textarea>
    </div>
</div>
 <?php /**PATH E:\Dungdt\booking-core\modules/News/Views/admin/news/form.blade.php ENDPATH**/ ?>