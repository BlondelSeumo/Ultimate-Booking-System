<?php
namespace App\Helpers;

class AdminForm{

    public static function select($name,$options,$old = '',$class=''){
        ?>
        <select class="form-control <?php echo e($class) ?>" name="<?php echo e($name) ?>">
            <?php 
            if(!empty($options)):
            foreach($options as $option): $selected = ''; if($old == $option['id']) $selected = 'selected' ?>
            <option value="<?php echo e($option['id']) ?>" <?php echo e($selected) ?>><?php echo e($option['name']) ?></option>
            <?php endforeach;endif; ?>
        </select>
        <?php
    }

    public static function select2($name,$options,$old = []){
        ?>
        <select class="form-control dungdt-select2-field" data-options='<?php echo json_encode($options['configs']) ?>' name="<?php echo e($name) ?>">
            <?php if(!empty($old[1])):?>
                <option value="<?php echo e($old[0]) ?>" selected><?php echo e($old[1]) ?></option>
            <?php endif;?>
        </select>
        <?php
    }

    public static function generate($options){
        if(!empty($options))
        {
            foreach ($options as $option)
            {
                switch ($option['type'])
                {
                    case "checkbox":
                        ?>
                        <div class="form-group" <?php if(!empty($option['condition'])) echo 'data-condition="'.e($option['condition']).'"'; ?> >
                            <label class="" >
                                <input type="checkbox" class="form-control" name="<?php echo  e($option['id']) ?>" value="1" <?php if($option['value'] == 1) echo 'checked'; ?>>
                                <?php echo e($option['label']) ?></label>
                        </div>
                        <?php
                        break;
                    case "input":
                        ?>
                        <div class="form-group" <?php if(!empty($option['condition'])) echo 'data-condition="'.e($option['condition']).'"'; ?> >
                            <label class="" ><?php echo e($option['label']) ?></label>
                            <div class="form-controls">
                                <input type="<?php e($option['input_type'] ?? 'text') ?>" class="form-control" name="<?php echo e($option['id']) ?>" value="<?php echo e($option['value'] ?? '') ?>">
                            </div>
                            <?php if(!empty($option['desc'])){
                                printf('<small class="form-text text-muted">%s</small>',$option['desc']);
                            } ?>
                        </div>
                        <?php
                        break;
                    case "select":
                        ?>
                        <div class="form-group" <?php if(!empty($option['condition'])) echo 'data-condition="'.e($option['condition']).'"'; ?> >
                            <label class="" ><?php echo e($option['label']) ?></label>
                            <div class="form-controls">
                                <select name="<?php echo e($option['id']) ?>" class="form-control">
                                    <option value=""><?php echo __('-- Select --') ?></option>
                                    <?php if(!empty($option['options'])){
                                        foreach ($option['options'] as $val=>$label)
                                        {
                                            ?>
                                            <option <?php if($option['value'] == $val) echo 'selected'; ?> value="<?php echo e($val) ?>"><?php echo e($label) ?></option>
                                            <?php
                                        }
                                    } ?>
                                </select>
                            </div>
                            <?php if(!empty($option['desc'])){
                                printf('<small class="form-text text-muted">%s</small>',$option['desc']);
                            } ?>
                        </div>
                        <?php
                        break;

                    case "editor":
                        ?>
                        <div class="form-group" <?php if(!empty($option['condition'])) echo 'data-condition="'.e($option['condition']).'"'; ?>  >
                            <label class="" ><?php echo e($option['label']) ?></label>
                            <div class="form-controls">
                                <textarea name="<?php echo e($option['id']) ?>" class="has-ckeditor"  cols="30" rows="7"><?php echo clean($option['value']) ?></textarea>
                            </div>
                        </div>
                        <?php
                        break;

                    case "upload":
                        ?>
                        <div class="form-group" <?php if(!empty($option['condition'])) echo 'data-condition="'.e($option['condition']).'"'; ?>  >
                            <label class="" ><?php echo e($option['label']) ?></label>
                            <div class="form-controls">
                                <?php
                                echo \Modules\Media\Helpers\FileHelper::fieldUpload($option['id'],$option['value'] ?? '');
                                ?>
                            </div>
                        </div>
                        <?php

                        break;

                }
            }
        }
    }
}