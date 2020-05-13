<div class="bravo_header">
    <div class="<?php echo e($container_class ?? 'container'); ?>">
        <div class="content">
            <div class="header-left">
                <a href="<?php echo e(url('/')); ?>" class="bravo-logo">
                    <?php if($logo_id = setting_item("logo_id")): ?>
                        <?php $logo = get_file_url($logo_id,'full') ?>
                        <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting_item("site_title")); ?>">
                    <?php endif; ?>
                </a>
                <div class="bravo-menu">
                    <?php generate_menu('primary') ?>
                </div>
            </div>
            <div class="header-right">
                <?php if(!empty($header_right_menu)): ?>
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

                                <a href="#" data-toggle="dropdown" class="is_login">
                                    <?php if($avatar_url = Auth::user()->getAvatarUrl()): ?>
                                        <img class="avatar" src="<?php echo e($avatar_url); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                                    <?php else: ?>
                                        <span class="avatar-text"><?php echo e(ucfirst( Auth::user()->name[0])); ?></span>
                                    <?php endif; ?>
                                    <?php echo e(__("Hi, :Name",['name'=>Auth::user()->name])); ?>

                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu text-left">
                                    <li><a href="<?php echo e(url('/user/profile')); ?>"><i class="icon ion-md-construct"></i> <?php echo e(__("My profile")); ?></a></li>

                                    <?php if(Auth::user()->hasPermissionTo('dashboard_access')): ?>
                                        <li class="menu-hr"><a href="<?php echo e(url('/admin')); ?>"><i class="icon ion-ios-ribbon"></i> <?php echo e(__("Dashboard")); ?></a></li>
                                    <?php endif; ?>
                                    <li class="menu-hr">
                                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <?php echo e(__('Logout')); ?></a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
                <button class="bravo-more-menu">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="bravo-menu-mobile">
        <div class="user-profile">
            <div class="b-close"><i class="icofont-scroll-left"></i></div>
            <div class="avatar">
                <?php if(Auth::id()): ?>
                    <?php
                        $user_id = Auth::id();
                        $dataUser = \Modules\User\Models\User::find($user_id);
                    ?>
                    <?php if($avatar_url = $dataUser->getAvatarUrl()): ?>
                        <img src="<?php echo e($avatar_url); ?>" alt="<?php echo e($dataUser->name); ?>">
                    <?php else: ?>
                        <i class="icofont-user-alt-2"></i>
                    <?php endif; ?>
                <?php else: ?>
                    <i class="icofont-user-alt-2"></i>
                <?php endif; ?>
            </div>
            <ul>
                <?php if(!Auth::id()): ?>
                    <li>
                        <a href="#login" data-toggle="modal" data-target="#login" class="login"><?php echo e(__('Login')); ?></a>
                    </li>
                    <li>
                        <a href="#register" data-toggle="modal" data-target="#register" class="signup"><?php echo e(__('Sign Up')); ?></a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo e(url('/user/profile')); ?>">
                            <i class="icofont-user-suited"></i> <?php echo e(__("Hi, :Name",['name'=>Auth::user()->name])); ?>

                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('/user/profile')); ?>">
                            <i class="icon ion-md-construct"></i> <?php echo e(__("My profile")); ?>

                        </a>
                    </li>
                    <?php if(Auth::user()->hasPermissionTo('dashboard_access')): ?>
                        <li>
                            <a href="<?php echo e(url('/admin')); ?>"><i class="icon ion-ios-ribbon"></i> <?php echo e(__("Dashboard")); ?></a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a  href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> <?php echo e(__('Logout')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="g-menu">
            <?php generate_menu('primary') ?>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\resources\views/layouts/parts/header.blade.php ENDPATH**/ ?>