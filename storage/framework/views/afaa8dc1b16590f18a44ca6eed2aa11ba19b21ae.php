<div class="form-group">
    <label><?php echo e(__("Locale")); ?></label>
    <div>
        <select name="locale" class="form-control dungdt-select2-field dungdt_input_locale" data-options='{"allowClear":true}' data-id="<?php echo e($row->id); ?>">
            <option value=""><?php echo e(__("-- Please select --")); ?></option>
            <?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option data-name="<?php echo e($name); ?>" <?php if($row->locale == $locale): ?> selected <?php endif; ?> value="<?php echo e($locale); ?>"><?php echo e($name); ?> - (<?php echo e($locale); ?>)</option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label><?php echo e(__("Flag Icon")); ?></label>
    <div class="input-group mb-3">
        <input type="text" value="<?php echo e($row->flag); ?>" placeholder="<?php echo e(__("Eg: gb")); ?>" name="flag" class="form-control dungdt-input-flag-icon" required>
        <div class="input-group-append">
            <span class="input-group-text"><span class="flag-icon  flag-icon-<?php echo e($row->flag); ?>"></span></span>
        </div>

        <div class="invalid-feedback">
            <?php echo e(__('Please input flag code')); ?>

        </div>
    </div>
</div>
<div class="form-group">
    <label><?php echo e(__("Name")); ?></label>
    <input type="text" value="<?php echo e($row->name); ?>" placeholder="<?php echo e(__("Display Name")); ?>" name="name" class="form-control" required>
    <div class="invalid-feedback">
        <?php echo e(__('Please input language name')); ?>

    </div>
</div>
<div class="form-group">
    <label><?php echo e(__("Status")); ?></label>
    <div class="">
        <label>
            <input type="radio" <?php if(!$row->status or $row->status == 'publish'): ?> checked <?php endif; ?> name="status" value="publish"> <?php echo e(__('Publish')); ?>

        </label>
    </div>
    <div>
        <label>
            <input type="radio" <?php if($row->status == 'draft'): ?> checked <?php endif; ?> name="status" value="draft"> <?php echo e(__('Draft')); ?>

        </label>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/Language/Views/admin/language/form.blade.php ENDPATH**/ ?>