<div class="destination-item <?php if(!$row->image_id): ?> no-image  <?php endif; ?>">
    <a href="<?php echo e(url("/tour?location_id=".$row->id)); ?>">
        <div class="image" <?php if($row->image_id): ?> style="background: url(<?php echo e($row->getImageUrl()); ?>)" <?php endif; ?> >
            <div class="effect"></div>
            <div class="content">
                <h4 class="title"><?php echo e($row->name); ?></h4>
                <div class="desc"><?php echo e($row->getDisplayNumberServiceInLocation($service_type)); ?></div>
            </div>
        </div>
    </a>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Location/Views/frontend/blocks/list-locations/loop.blade.php ENDPATH**/ ?>