<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__("Google reCapcha Options")); ?></h3>
        <p class="form-group-desc"><?php echo e(__('Config google recapcha for system')); ?></p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="" ><?php echo e(__("Enable reCapcha Login Form")); ?></label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="user_enable_login_recaptcha" value="1" <?php if(!empty($settings['user_enable_login_recaptcha'])): ?> checked <?php endif; ?> /> <?php echo e(__("On")); ?> </label>
                        <br>
                        <small class="form-text text-muted"><?php echo e(__("Turn on the mode for login form")); ?></small>
                    </div>
                </div>
                <div class="form-group">
                    <label class="" ><?php echo e(__("Enable reCapcha Register Form")); ?></label>
                    <div class="form-controls">
                        <label><input type="checkbox" name="user_enable_register_recaptcha" value="1"  <?php if(!empty($settings['user_enable_register_recaptcha'])): ?> checked <?php endif; ?> /> <?php echo e(__("On")); ?> </label>
                        <br>
                        <small class="form-text text-muted"><?php echo e(__("Turn on the mode for register form")); ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__('Content Email User Registered')); ?></h3>
        <div class="form-group-desc"><?php echo e(__('Content email send to Customer or Administrator when user registered.')); ?>

            <?php $__currentLoopData = \Modules\User\Listeners\SendMailUserRegisteredListen::CODE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><code><?php echo e($value); ?></code></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label> <input type="checkbox" <?php if($settings['enable_mail_user_registered'] ?? '' == 1): ?> checked <?php endif; ?> name="enable_mail_user_registered" value="1"> <?php echo e(__("Enable send email to customer when customer registered ?")); ?></label>
                </div>
                <div class="form-group" data-condition="enable_mail_user_registered:is(1)">
                    <label ><?php echo e(__("Content")); ?></label>
                    <div class="form-controls">
                        <textarea name="user_content_email_registered" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($settings['user_content_email_registered'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label> <input type="checkbox" <?php if($settings['admin_enable_mail_user_registered'] ?? '' == 1): ?> checked <?php endif; ?> name="admin_enable_mail_user_registered" value="1"> <?php echo e(__("Enable send email to Administrator when customer registered ?")); ?></label>
                </div>
                <div class="form-group" data-condition="admin_enable_mail_user_registered:is(1)">
                    <label ><?php echo e(__("Content")); ?></label>
                    <div class="form-controls">
                        <textarea name="admin_content_email_user_registered" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($settings['admin_content_email_user_registered'] ?? ''); ?></textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title"><?php echo e(__('Content Email User Forgot Password')); ?></h3>
        <div class="form-group-desc">
            <?php $__currentLoopData = \Modules\User\Emails\ResetPasswordToken::CODE; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><code><?php echo e($value); ?></code></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group" >
                    <label ><?php echo e(__("Content")); ?></label>
                    <div class="form-controls">
                        <textarea name="user_content_email_forget_password" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($settings['user_content_email_forget_password'] ?? ''); ?></textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/User/Views/admin/settings/user.blade.php ENDPATH**/ ?>