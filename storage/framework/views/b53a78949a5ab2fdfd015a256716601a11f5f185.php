<?php if(!empty($seo_meta)): ?>
    <?php if(isset($seo_meta['seo_index']) and $seo_meta['seo_index'] == 0): ?>
        <meta name="robots" content="noindex">
    <?php endif; ?>
    <title><?php echo e($seo_meta['seo_title'] ?? $seo_meta['service_title'] ?? $page_title ?? ""); ?> - <?php echo e(setting_item('site_title' ,'Booking Core')); ?></title>
    <meta name="description" content="<?php echo e($seo_meta['seo_desc'] ?? $seo_meta['service_desc'] ?? setting_item("site_desc")); ?>"/>
    
    <meta property="og:url" content="<?php echo e($seo_meta['full_url'] ?? ""); ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?php echo e($seo_meta['seo_share']['facebook']['title'] ?? $seo_meta['seo_title'] ?? $seo_meta['service_title'] ?? $page_title ?? ""); ?>"/>
    <meta property="og:description" content="<?php echo e($seo_meta['seo_share']['facebook']['desc'] ?? $seo_meta['seo_desc'] ?? $seo_meta['service_desc'] ?? ""); ?>"/>
    <meta property="og:image" content="<?php echo e(get_file_url( $seo_meta['seo_share']['facebook']['image'] ?? $seo_meta['seo_image'] ?? $seo_meta['service_image'] ?? "" )); ?>"/>
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($seo_meta['seo_share']['twitter']['title'] ?? $seo_meta['seo_title'] ?? $seo_meta['service_title'] ?? $page_title ?? ""); ?>">
    <meta name="twitter:description" content="<?php echo e($seo_meta['seo_share']['twitter']['desc'] ?? $seo_meta['seo_desc'] ?? $seo_meta['service_desc'] ?? ""); ?>">
    <meta name="twitter:image" content="<?php echo e(get_file_url( $seo_meta['seo_share']['twitter']['image'] ?? $seo_meta['seo_image'] ?? $seo_meta['service_image'] ?? "" )); ?>">
    <link rel="canonical" href="<?php echo e($seo_meta['full_url'] ?? ""); ?>"/>
<?php else: ?>
    <title><?php echo e($page_title ?? ''); ?> <?php echo e(setting_item('site_title' ,'Booking Core')); ?></title>
    <meta name="description" content="<?php echo e(setting_item("site_desc")); ?>"/>
<?php endif; ?>
<?php /**PATH E:\Dungdt\booking-core\resources\views/layouts/parts/seo-meta.blade.php ENDPATH**/ ?>