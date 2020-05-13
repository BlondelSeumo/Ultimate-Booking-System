<?php $main_color =setting_item('style_main_color','#5191FA');
$style_typo = json_decode(setting_item('style_typo',"{}"),true);
?>
<style id="custom-css">
    body{
        <?php if(!empty($style_typo) && is_array($style_typo)): ?>
            <?php $__currentLoopData = $style_typo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php echo e(str_replace('_','-',$k)); ?>:<?php echo $v; ?>;
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    }
    a,
    .bravo-news .btn-readmore,
    .bravo_wrap .bravo_header .content .header-left .bravo-menu ul li:hover > a,
    .bravo_wrap .bravo_search_tour .bravo_form_search .bravo_form .field-icon,
    .bravo_wrap .bravo_search_tour .bravo_form_search .bravo_form .render,
    .bravo_wrap .bravo_search_tour .bravo_form_search .bravo_form .field-detination #dropdown-destination .form-control,
    .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .btn-apply-price-range,
    .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .btn-more-item,
    .input-number-group i,
    .bravo_wrap .page-template-content .bravo-form-search-tour .bravo_form_search_tour .field-icon,
    .bravo_wrap .page-template-content .bravo-form-search-tour .bravo_form_search_tour .field-detination #dropdown-destination .form-control,
    .bravo_wrap .page-template-content .bravo-form-search-tour .bravo_form_search_tour .render
    {
        color:<?php echo e($main_color); ?>

    }
    .bravo-pagination ul li.active a, .bravo-pagination ul li.active span
    {
        color:<?php echo e($main_color); ?>!important;
    }
    .bravo-news .widget_category ul li span,
    .bravo_wrap .bravo_search_tour .bravo_form_search .bravo_form .g-button-submit button,
    .bravo_wrap .bravo_search_tour .bravo_filter .filter-title:before,
    .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .bravo-filter-price .irs--flat .irs-bar,
    .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .bravo-filter-price .irs--flat .irs-from, .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .bravo-filter-price .irs--flat .irs-to, .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .bravo-filter-price .irs--flat .irs-single,
    .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .bravo-filter-price .irs--flat .irs-handle>i:first-child,
    .bravo-news .header .cate ul li,
    .bravo_wrap .page-template-content .bravo-form-search-tour .bravo_form_search_tour .g-button-submit button,
    .bravo_wrap .page-template-content .bravo-list-locations .list-item .destination-item .image .content .desc
    {
        background: <?php echo e($main_color); ?>;
    }
    .bravo-pagination ul li.active a, .bravo-pagination ul li.active span
    {
        border-color:<?php echo e($main_color); ?>!important;
    }
    .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .bravo-filter-price .irs--flat .irs-from:before, .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .bravo-filter-price .irs--flat .irs-to:before, .bravo_wrap .bravo_search_tour .bravo_filter .g-filter-item .item-content .bravo-filter-price .irs--flat .irs-single:before,
    .bravo-reviews .review-form .form-wrapper,
    .bravo_wrap .bravo_detail_tour .bravo_content .bravo_tour_book
    {
        border-top-color:<?php echo e($main_color); ?>;
    }

    .bravo_wrap .bravo_footer .main-footer .nav-footer .context .contact{
        border-left-color:<?php echo e($main_color); ?>;
    }

    <?php echo setting_item('style_custom_css'); ?>

</style>
<?php /**PATH E:\Dungdt\booking-core\resources\views/layouts/parts/custom-css.blade.php ENDPATH**/ ?>