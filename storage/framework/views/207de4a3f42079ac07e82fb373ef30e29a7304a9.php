<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="<?php echo e($html_class ?? ''); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(url('images/favicon.png')); ?>" />
    <?php echo $__env->make('layouts.parts.seo-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link href="<?php echo e(asset('libs/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/ionicons/css/ionicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('libs/icofont/icofont.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("libs/daterange/daterangepicker.css")); ?>" >
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel='stylesheet' id='google-font-css-css'  href='https://fonts.googleapis.com/css?family=Poppins%3A400%2C500%2C600' type='text/css' media='all' />
    <script>
        var bookingCore = {
            url:'<?php echo e(url('/')); ?>',
            booking_decimals:<?php echo e((int)setting_item('currency_no_decimal',2)); ?>,
            thousand_separator:'<?php echo e(setting_item('currency_thousand')); ?>',
            decimal_separator:'<?php echo e(setting_item('currency_decimal')); ?>',
            currency_position:'<?php echo e(setting_item('currency_format')); ?>',
            currency_symbol:'<?php echo e(currency_symbol()); ?>',
            date_format:'<?php echo e(get_moment_date_format()); ?>',
            map_provider:'<?php echo e(setting_item('map_provider')); ?>',
            map_gmap_key:'<?php echo e(setting_item('map_gmap_key')); ?>',
        };
    </script>
    <!-- Styles -->
    <?php echo $__env->yieldContent('head'); ?>
    
    <?php echo $__env->make('layouts.parts.custom-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link href="<?php echo e(asset('libs/carousel-2/owl.carousel.css')); ?>" rel="stylesheet">
</head>
<body class="<?php echo e($body_class ?? ''); ?>">
    <div class="bravo_wrap">

        <?php echo $__env->make('layouts.parts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('layouts.parts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('layouts.parts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</body>
</html>
<?php /**PATH E:\Dungdt\booking-core\resources\views/layouts/app.blade.php ENDPATH**/ ?>