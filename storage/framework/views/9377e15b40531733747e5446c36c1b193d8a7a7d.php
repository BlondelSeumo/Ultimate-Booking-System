<div class="bravo_topbar">
    <div class="container">
        <div class="content">
            <div class="topbar-left">
                <?php if($social_share = setting_item("social_share")): ?>
                    <?php $social_share = json_decode($social_share); ?>
                    <div class="st-list socials">
                        <?php $__currentLoopData = $social_share; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($item->link); ?>" target="_blank">
                                <i class="<?php echo e($item->class_icon); ?>"></i>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if($admin_email = setting_item("admin_email")): ?>
                    <ul class="topbar-items">
                        <li class="hidden-xs hidden-sm"><a href="mailto:<?php echo e($admin_email); ?>" target=""><?php echo e($admin_email); ?></a>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="topbar-right">
                <ul class="topbar-items">
                    <?php if(!Auth::id()): ?>
                        <li class="login-item">
                            <a href="#login" data-toggle="modal" data-target="#login" class="login"><?php echo e(__('Login')); ?></a>
                        </li>
                        <li class="signup-item">
                            <a href="#register" data-toggle="modal" data-target="#register" class="signup"><?php echo e(__('Sign Up')); ?></a>
                        </li>
                    <?php else: ?>
                        <li class="login-item dropdown">
                            <a href="#" data-toggle="dropdown" class="login"><?php echo e(__("Hi, :Name",['name'=>Auth::user()->getDisplayName()])); ?>

                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu text-left">
                                <li><a href="<?php echo e(url('/user/profile')); ?>"><i class="icon ion-md-construct"></i> <?php echo e(__("My profile")); ?></a></li>

                                <?php if(Auth::user()->hasPermissionTo('dashboard_access')): ?>
                                    <li class="menu-hr"><a href="<?php echo e(url('/admin')); ?>"><i class="icon ion-ios-ribbon"></i> <?php echo e(__("Dashboard")); ?></a></li>
                                <?php endif; ?>
                                <li class="menu-hr">
                                    <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();"><i class="fa fa-sign-out"></i> <?php echo e(__('Logout')); ?></a>
                                </li>
                            </ul>
                            <form id="logout-form-topbar" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\resources\views/layouts/parts/topbar.blade.php ENDPATH**/ ?>