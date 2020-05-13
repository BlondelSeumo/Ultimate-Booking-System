<div class="form-group">
    <label >Name</label>
    <input type="text" value="<?php echo e($row->name); ?>" placeholder="Category name" name="name" class="form-control">
</div>
<div class="form-group">
    <label >Parent</label>
    <select name="parent_id" class="form-control">
        <option value="">-- Please Select --</option>
        <?php
        $traverse = function ($categories, $prefix ='') use (&$traverse,$row) {
            foreach ($categories as $category) {
                if($category->id == $row->id){
                    continue;
                }
                $selected = '';
                if($row->parent_id == $category->id) $selected = 'selected';

                printf("<option value='%s' %s>%s</option>",$category->id,$selected,$prefix.' '.$category->name);

                $traverse($category->children, $prefix.'-');
            }
        };

        $traverse($parents);
        ?>
    </select>
</div>


<div class="form-group">
    <label class="control-label" >Description</label>
    <div class="">
        <textarea name="content" class="d-none has-ckeditor"  cols="30" rows="10"><?php echo e($row->content); ?></textarea>
    </div>
</div>
<?php /* E:\Dungdt\booking-core\modules/News/Views/admin/category/form.blade.php */ ?>