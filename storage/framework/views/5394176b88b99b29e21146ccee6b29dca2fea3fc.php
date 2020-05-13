<form class="bravo-form-login" method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <input type="text" class="form-control" name="email" autocomplete="off" placeholder="<?php echo e(__('Email address')); ?>">
        <i class="input-icon fa fa-envelope-o"></i>
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" autocomplete="off"  placeholder="<?php echo e(__('Password')); ?>">
        <i class="input-icon fa fa-lock"></i>
        <span class="invalid-feedback error error-password"></span>
    </div>
    <div class="form-group">
        <div class="d-flex justify-content-between">
            <label for="remember-me" class="mb0">
                <input type="checkbox" name="remember" id="remember-me" value="1"> <?php echo e(__('Remember me')); ?> <span class="checkmark fcheckbox"></span>
            </label>
            <a href="<?php echo e(url("/password/reset")); ?>"><?php echo e(__('Forgot Password?')); ?></a>
        </div>
    </div>
    <?php if(setting_item("user_enable_login_recaptcha")): ?>
        <div class="form-group">
            <?php echo e(recaptcha_field($captcha_action ?? 'login')); ?>

        </div>
    <?php endif; ?>
    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button class="btn btn-primary form-submit" type="submit">
            <?php echo e(__('Login')); ?>

            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
    <?php if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable')): ?>
        <div class="advanced">
            <p class="text-center f14 c-grey"><?php echo e(__('or continue with')); ?></p>
            <div class="row">
                <?php if(setting_item('facebook_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('/social-login/facebook')); ?>"class="btn btn_login_fb_link" data-channel="facebook">
                            <i class="input-icon fa fa-facebook"></i>
                            <?php echo e(__('Facebook')); ?>

                        </a>
                    </div>
                <?php endif; ?>
                <?php if(setting_item('google_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('social-login/google')); ?>" class="btn btn_login_gg_link" data-channel="google">
                            <i class="input-icon fa fa-google"></i>
                            <?php echo e(__('Google')); ?>

                        </a>
                    </div>
                <?php endif; ?>
                <?php if(setting_item('twitter_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('social-login/twitter')); ?>" class="btn btn_login_tw_link" data-channel="twitter">
                            <i class="input-icon fa fa-twitter"></i>
                            <?php echo e(__('Twitter')); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="c-grey font-medium f14 text-center"> <?php echo e(__('Do not have an account?')); ?> <a href="" data-target="#register" data-toggle="modal"><?php echo e(__('Sign Up')); ?></a>
    </div>
</form><?php /**PATH E:\Dungdt\booking-core\resources\views/auth/login-form.blade.php ENDPATH**/ ?>