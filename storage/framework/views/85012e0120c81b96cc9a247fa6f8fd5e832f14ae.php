<?php
$dataUser = Auth::user();
$menus = [
    [
        'url'        => '/user/dashboard',
        'title'      => __("Dashboard"),
        'icon'       => 'fa fa-home',
        'permission' => 'tour_view',
    ],
    [
        'url'   => '/user/profile',
        'title' => __("Settings"),
        'icon'  => 'fa fa-cogs',
    ],
    /*[
        'url'=>'/user/wishlist',
        'title'=>__("Wishlist"),
        'icon'=>'fa fa-heart-o',
    ],*/
    [
        'url'   => '/user/booking-history',
        'title' => __("Booking History"),
        'icon'  => 'fa fa-clock-o',
    ],
    [
        'url'        => '/user/tour',
        'title'      => __("Manage Tour"),
        'icon'       => 'fa fa-cogs',
        'permission' => 'tour_view',
        'children'   => [
            [
                'url'   => '/user/tour',
                'title' => "All Tours",
            ],
            [
                'url'        => '/user/tour/create',
                'title'      => "Add Tour",
                'permission' => 'tour_create',
            ],
        ]
    ],
];
$currentUrl = url(Illuminate\Support\Facades\Route::current()->uri());
if (!empty($menus))
    foreach ($menus as $k => $menuItem) {
        if (!empty($menuItem['permission']) and !Auth::user()->hasPermissionTo($menuItem['permission'])) {
            unset($menus[$k]);
            continue;
        }
        $menus[$k]['class'] = $currentUrl == url($menuItem['url']) ? 'active' : '';
        if (!empty($menuItem['children'])) {
            $menus[$k]['class'] .= ' has-children';
            foreach ($menuItem['children'] as $k2 => $menuItem2) {
                if (!empty($menuItem2['permission']) and !Auth::user()->hasPermissionTo($menuItem2['permission'])) {
                    unset($menus[$k]['children'][$k2]);
                    continue;
                }
                $menus[$k]['children'][$k2]['class'] = $currentUrl == url($menuItem2['url']) ? 'active active_child' : '';
            }
        }
    }
?>
<div class="sidebar-user">
    <div class="bravo-close-menu-user"><i class="icofont-scroll-left"></i></div>
    <div class="logo">
        <?php if($avatar_url = $dataUser->getAvatarUrl()): ?>
            <div class="avatar"><img src="<?php echo e($avatar_url); ?>" alt="<?php echo e($dataUser->name); ?>"></div>
        <?php else: ?>
            <span class="avatar-text"><?php echo e(ucfirst($dataUser->name[0])); ?></span>
        <?php endif; ?>
    </div>
    <div class="user-profile-avatar">
        <div class="info-new">
            <h5><?php echo e($dataUser->name); ?></h5>
            <p><?php echo e(__("Member Since :time" , ['time'=> date("M Y",strtotime($dataUser->created_at))])); ?></p>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="main-menu">
            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($menuItem['class']); ?>">
                    <a href="<?php echo e(url($menuItem['url'])); ?>">
                        <?php if(!empty($menuItem['icon'])): ?>
                            <span class="icon text-center"><i class="<?php echo e($menuItem['icon']); ?>"></i></span>
                        <?php endif; ?>
                        <?php echo e($menuItem['title']); ?>


                    </a>
                    <?php if(!empty($menuItem['children'])): ?>
                        <i class="caret"></i>
                    <?php endif; ?>
                    <?php if(!empty($menuItem['children'])): ?>
                        <ul class="children">
                            <?php $__currentLoopData = $menuItem['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e($menuItem2['class']); ?>"><a href="<?php echo e(url($menuItem2['url'])); ?>">
                                        <?php if(!empty($menuItem2['icon'])): ?>
                                            <i class="<?php echo e($menuItem2['icon']); ?>"></i>
                                        <?php endif; ?>
                                        <?php echo e($menuItem2['title']); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="logout">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo e(csrf_field()); ?>

        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <?php echo e(__("Log Out")); ?>

        </a>
    </div>
    <div class="logout">
        <a href="<?php echo e(url('/')); ?>"><i class="fa fa-long-arrow-left"></i> <?php echo e(__("Back to Homepage")); ?></a>
    </div>
</div>
<?php /**PATH E:\Dungdt\booking-core\modules/User/Views/frontend/layouts/sidebar.blade.php ENDPATH**/ ?>