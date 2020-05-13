<?php
$user = Auth::user();
?>
<div class="header-logo flex-shrink-0">
    <h3 class="logo-text"><a href="<?php echo e(url('/admin')); ?>">Booking Core <span><?php echo e(config('app.version')); ?></span></a></h3>
</div>
<div class="header-widgets d-flex flex-grow-1">
    <div class="widgets-left d-flex flex-grow-1 align-items-center">
        <div class="header-widget">
            <span class="btn-toggle-admin-menu btn btn-sm btn-link"><i class="icon ion-ios-menu"></i></span>
        </div>
        <div class="header-widget search-widget">
            
            <a href="<?php echo e(url('/')); ?>" class="btn btn-link" target="_blank"><i class="fa fa-eye"></i> <?php echo e(__('Home')); ?>

            </a>
        </div>
    </div>
    <div class="widgets-right flex-shrink-0 d-flex">
        <div class="dropdown header-widget widget-user">
            <div data-toggle="dropdown" class="user-dropdown d-flex align-items-center" aria-haspopup="true" aria-expanded="false">
                <span class="user-avatar flex-shrink-0">
                    <?php if($user->avatar_url): ?>:
                    <img class="image-responsive" src="<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->getDisplayName()); ?>">
                    <?php else: ?>
                        <span class="avatar-text"><?php echo e(ucfirst($user->getDisplayName()[0])); ?></span>
                    <?php endif; ?>
                </span>
                <div class="user-info flex-grow-1">
                    <div class="user-name"><?php echo e($user->getDisplayName()); ?></div>
                    <div class="user-role"><?php echo e(ucfirst($user->roles[0]->name ?? '')); ?></div>
                </div>
                <i class="fa fa-angle-down"></i>
            </div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?php echo e(url('admin/module/user/edit/'.$user->id)); ?>"><?php echo e(__('Edit Profile')); ?></a>
                <a class="dropdown-item" href="<?php echo e(url('admin/module/user/password/'.$user->id)); ?>"><?php echo e(__('Change Password')); ?></a>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <?php echo e(__('Logout')); ?>

                </a>
            </div>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo e(csrf_field()); ?>

            </form>
        </div>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\resources\views/admin/layouts/parts/header.blade.php ENDPATH**/ ?>