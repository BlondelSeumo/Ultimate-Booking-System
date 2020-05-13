<!DOCTYPE html>
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html lang="en-US" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="UTF-8"/>
    <title>Booking Core - Ultimate Booking System</title>
    <link rel="icon" type="image/png" href="<?php echo e(url('icon/favicon.png')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(url('landing')); ?>/bs/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo e(url('landing')); ?>/owlcarousel/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="<?php echo e(url('landing')); ?>/css/main.css"/>
    <link rel="icon" type="image/png" href="<?php echo e(url('images/favicon.png')); ?>" />
</head>
<body>
<?php echo setting_item('body_scripts'); ?>

<div class="header parallax">
    <div id="main-menu" class="sticky">
        <div class="container">
            <div class="row">
                <div class="col-xs-3">
                    <h1><a href="<?php echo e(url('intro')); ?>"><img src="<?php echo e(url('images')); ?>/logo.svg"
                                                                 alt="Booking Core Logo"/></a></h1>
                </div>
                <div class="col-xs-9">
                    <div class="dropdown dropdown-main-menu">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="https://www.facebook.com/bookingcore/" target="_blank">Support</a>
                            <a class="dropdown-item" href="http://docs.bookingcore.org">Documentation</a>
                            <a href="<?php echo e(config('landing.item_url')); ?>"
                               class="dropdown-item btn-buynow">BUY NOW</a></li>
                        </div>
                    </div>
                    <ul class="menu">
                        <li>
                            <a href="<?php echo e(config('landing.item_url')); ?>"
                               class="btn-buynow">BUY NOW</a></li>
                        <li><a href="https://www.facebook.com/bookingcore/">Support</a></li>
                        <li><a href="http://docs.bookingcore.org">Documentation</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row ld-full-height">
            <div class="col-lg-6">
                <h2 class="heading">
                    <span>Ultimate</span>
                    Booking System<br/>
                    based on Laravel
                </h2>
                
                
                    
            </div>
            <div class="col-lg-6 hidden-md hidden-sm hidden-xs">
                <img src="<?php echo e(url('landing/img/header_img.png')); ?>" class="effectSwing img-rounder"/>
            </div>
        </div>
    </div>
</div>

<div class="full-demo">
    <div class="text-heading">
        <h3>Full Website Demo</h3>
        <p>Easy Demo Importer,<br />all features in all demos can be combined.</p>

    </div>
    <div class="demo-grid">
        <div class="container">
            <div class="demo-tab-wrapper">
                <?php $__currentLoopData = config('landing.list_demo'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="modern-layout item-tab active">
                        <?php echo $__env->make('landing.view.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<div class="demo-plugin">
    <h3>Exclusive  Features</h3>
    <div class="demo-plugin-content">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = config('landing.exclusive_features'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6 col-md-6">
                        <div class="item">
                            <img src="<?php echo e(url('landing')); ?>/<?php echo e($feature['thumb']); ?>" alt="Traveler Plugin"/>
                            <div class="plugin-info">
                                <h5><?php echo e($feature['name']); ?></h5>
                                <div class="desc"><?php echo e($feature['desc']); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

    </div>
</div>

<div class="demo-theme-option">
    <?php $__currentLoopData = config('landing.screenshots'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$screenshot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="feature-theme-option feature-services">
            <div class="container">
                <div class="row ld-flex justify-content-center">
                    <div class="col-md-6 col-sm-6 col-left <?php if($k % 2 == 1): ?> col-img  <?php endif; ?>">
                        <?php if($k % 2 == 0): ?>
                            <h3><?php echo $screenshot['name']; ?></h3>
                            <div class="desc"><?php echo $screenshot['desc']; ?>

                            </div>
                        <?php else: ?>
                            <div class="col-pull-left">
                                <img src="<?php echo e(asset('landing/'.$screenshot['thumb'])); ?>" class="img-responsive"/>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-right">
                        <?php if($k % 2 == 1): ?>
                            <h3><?php echo $screenshot['name']; ?></h3>
                            <div class="desc"><?php echo $screenshot['desc']; ?>

                            </div>
                        <?php else: ?>
                            <div class="col-pull-right">
                                <img src="<?php echo e(asset('landing/'.$screenshot['thumb'])); ?>" class="img-responsive"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>



<div class="other-feature">
    <h3>Other Features</h3>
    <div class="other-content">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = config('landing.other_features'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <?php if($item['type'] == 'more'): ?>
                        <div class="item more">
                            <img src="<?php echo e(asset('landing/'.$item['thumb'])); ?>" />
                            <h5><?php echo e($item['name']); ?></h5>
                        </div>
                        <?php else: ?>
                        <div class="item">
                            <img src="<?php echo e(asset('landing/'.$item['thumb'])); ?>" />
                            <h5><?php echo e($item['name']); ?></h5>
                            <p class="desc"><?php echo e($item['desc']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<div class="footer">
<!--<img src="<?php /*echo $url . '/img/footer-corrner.png'; */?>" class="footer-corrner"/>-->
    <div class="container">
        <h3>Creating your own Booking<br />System with <span>Booking Core</span> is super<br />fast and easy <img src="<?php echo e(url('landing/img/hand.svg')); ?>" /></h3>
        <a href="<?php echo e(config('landing.item_url')); ?>"
           class="btn-buynow">BUY NOW</a>
        <div class="social">
            <span>FOLLOW US</span>
            <ul>
                <li><a href="https://www.facebook.com/bookingcore/"><svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.59375 3.23828C7.17188 3.23828 6.83203 3.30859 6.57422 3.44922C6.33984 3.58984 6.1875 3.76562 6.11719 3.97656C6.04688 4.1875 6.01172 4.45703 6.01172 4.78516V7H9L8.57812 10.1992H6.01172V18.25H2.70703V10.1992H0V7H2.70703V4.46875C2.70703 3.13281 3.08203 2.10156 3.83203 1.375C4.58203 0.625 5.57812 0.25 6.82031 0.25C7.82812 0.25 8.64844 0.296875 9.28125 0.390625V3.23828H7.59375Z" fill="#1A2B48"/>
                        </svg>
                    </a></li>
                <li><a href="#"><svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.3359 2.60938C19.4062 2.89062 19.4648 3.24219 19.5117 3.66406C19.582 4.08594 19.6289 4.50781 19.6523 4.92969C19.6758 5.32812 19.6875 5.70312 19.6875 6.05469C19.7109 6.40625 19.7227 6.69922 19.7227 6.93359V7.25C19.7227 9.35938 19.5938 10.918 19.3359 11.9258C19.2188 12.3242 19.0078 12.6758 18.7031 12.9805C18.3984 13.2852 18.0352 13.4961 17.6133 13.6133C17.168 13.7305 16.3242 13.8242 15.082 13.8945C13.8398 13.9414 12.7031 13.9766 11.6719 14H10.125C6.11719 14 3.62109 13.8711 2.63672 13.6133C1.72266 13.3555 1.14844 12.793 0.914062 11.9258C0.796875 11.4805 0.703125 10.8711 0.632812 10.0977C0.585938 9.30078 0.550781 8.63281 0.527344 8.09375V7.25C0.527344 5.16406 0.65625 3.61719 0.914062 2.60938C1.03125 2.1875 1.24219 1.82422 1.54688 1.51953C1.85156 1.21484 2.21484 1.00391 2.63672 0.886719C3.08203 0.769531 3.92578 0.6875 5.16797 0.640625C6.41016 0.570312 7.54688 0.523438 8.57812 0.5H10.125C14.1328 0.5 16.6289 0.628906 17.6133 0.886719C18.0352 1.00391 18.3984 1.21484 18.7031 1.51953C19.0078 1.82422 19.2188 2.1875 19.3359 2.60938ZM8.15625 10.1328L13.1836 7.25L8.15625 4.40234V10.1328Z" fill="#1A2B48"/>
                        </svg>
                    </a></li>
                <li><a href="mailto:bookingcore.org@gmail.com"><svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.6484 4.96484C17.7188 4.89453 17.7891 4.88281 17.8594 4.92969C17.9531 4.97656 18 5.04688 18 5.14062V12.3125C18 12.7812 17.8359 13.1797 17.5078 13.5078C17.1797 13.8359 16.7812 14 16.3125 14H1.6875C1.21875 14 0.820312 13.8359 0.492188 13.5078C0.164063 13.1797 0 12.7812 0 12.3125V5.14062C0 5.04688 0.0351562 4.98828 0.105469 4.96484C0.199219 4.91797 0.28125 4.91797 0.351562 4.96484C1.125 5.55078 2.92969 6.875 5.76562 8.9375C5.8125 8.98438 5.96484 9.11328 6.22266 9.32422C6.50391 9.53516 6.72656 9.69922 6.89062 9.81641C7.05469 9.91016 7.26562 10.0391 7.52344 10.2031C7.78125 10.3438 8.02734 10.4492 8.26172 10.5195C8.51953 10.5898 8.76562 10.625 9 10.625C9.21094 10.625 9.42188 10.6016 9.63281 10.5547C9.84375 10.4844 10.043 10.4141 10.2305 10.3438C10.418 10.25 10.6172 10.1328 10.8281 9.99219C11.0391 9.85156 11.2148 9.73438 11.3555 9.64062C11.4961 9.52344 11.6602 9.39453 11.8477 9.25391C12.0352 9.11328 12.1641 9.00781 12.2344 8.9375C15 6.94531 16.8047 5.62109 17.6484 4.96484ZM9 9.5C8.8125 9.5 8.57812 9.44141 8.29688 9.32422C8.03906 9.18359 7.82812 9.06641 7.66406 8.97266C7.5 8.85547 7.25391 8.67969 6.92578 8.44531C6.62109 8.1875 6.45703 8.05859 6.43359 8.05859C3.57422 5.97266 1.53516 4.46094 0.316406 3.52344C0.105469 3.35937 0 3.13672 0 2.85547V2.1875C0 1.71875 0.164063 1.32031 0.492188 0.992188C0.820312 0.664063 1.21875 0.5 1.6875 0.5H16.3125C16.7812 0.5 17.1797 0.664063 17.5078 0.992188C17.8359 1.32031 18 1.71875 18 2.1875V2.85547C18 3.13672 17.8945 3.35937 17.6836 3.52344C16.5352 4.41406 14.4961 5.92578 11.5664 8.05859C11.543 8.05859 11.3672 8.1875 11.0391 8.44531C10.7344 8.67969 10.5 8.85547 10.3359 8.97266C10.1719 9.06641 9.94922 9.18359 9.66797 9.32422C9.41016 9.44141 9.1875 9.5 9 9.5Z" fill="#1A2B48"/>
                        </svg>
                    </a></li>

            </ul>
        </div>
    </div>
</div>


<script src="<?php echo e(url('landing')); ?>/js/jquery.min.js"></script>
<script src="<?php echo e(url('landing')); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo e(url('landing')); ?>/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo e(url('landing')); ?>/js/jquery.marquee.min.js"></script>
<script src="<?php echo e(url('landing')); ?>/js/scrollreveal.js"></script>
<script src="<?php echo e(url('landing')); ?>/js/jquery.matchHeight.js"></script>
<script src="<?php echo e(url('landing')); ?>/js/main.js"></script>
</body>
</html>
<?php /**PATH E:\Dungdt\booking-core\resources\views/landing/index.blade.php ENDPATH**/ ?>