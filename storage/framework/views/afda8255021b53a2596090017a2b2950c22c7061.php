<div class="sidebar-widget widget_category">
    <div class="sidebar-title">
        <h4><?php echo e($item->title); ?></h4>
    </div>
    <?php
        $list_category = $model_category->get()->toTree();
    ?>
    <ul>
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse) {
            foreach ($categories as $category) {
                ?>
                    <li>
                        <span></span>
                        <a href="<?php echo e(url("/news/category/".$category->slug)); ?>"><?php echo e($prefix); ?> <?php echo e($category->name); ?></a>
                    </li>
                <?php
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($list_category);
        ?>
    </ul>
</div><?php /**PATH E:\Dungdt\booking-core\modules/News/Views/frontend/layouts/sidebars/category.blade.php ENDPATH**/ ?>