<div class="sidebar-widget widget_search">
    <form method="get" class="search" action="<?php echo e(url("/news")); ?>">
        <input type="text" class="form-control" value="<?php echo e(Request::query("s")); ?>" name="s" placeholder="<?php echo e(__("Search ...")); ?>">
        <button type="submit" class="icon_search"></button>
    </form>
</div><?php /**PATH E:\Dungdt\booking-core\modules/News/Views/frontend/layouts/sidebars/search_form.blade.php ENDPATH**/ ?>