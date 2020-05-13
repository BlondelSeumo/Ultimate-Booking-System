<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Tour Locations")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Location")); ?></label>
            <div class="">
                <select name="location_id" class="form-control">
                    <option value=""><?php echo e(__("-- Please Select --")); ?></option>
                    <?php
                    $traverse = function ($locations, $prefix = '') use (&$traverse, $row) {
                        foreach ($locations as $location) {
                            $selected = '';
                            if ($row->location_id == $location->id)
                                $selected = 'selected';
                            printf("<option value='%s' %s>%s</option>", $location->id, $selected, $prefix . ' ' . $location->name);
                            $traverse($location->children, $prefix . '-');
                        }
                    };
                    $traverse($tour_location);
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Real tour address")); ?></label>
            <input type="text" name="address" class="form-control" placeholder="<?php echo e(__("Real tour address")); ?>" value="<?php echo e($row->address); ?>">
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Map Engine")); ?></label>
            <div class="control-map-group">
                <div id="map_content"></div>
                <div class="g-control">
                    <div class="form-group">
                        <label><?php echo e(__("Map Lat")); ?>:</label>
                        <input type="text" name="map_lat" class="form-control" value="<?php echo e($row->map_lat); ?>" readonly="">
                    </div>
                    <div class="form-group">
                        <label><?php echo e(__("Map Lng")); ?>:</label>
                        <input type="text" name="map_lng" class="form-control" value="<?php echo e($row->map_lng); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(__("Map Zoom")); ?>:</label>
                        <input type="text" name="map_zoom" class="form-control" value="<?php echo e($row->map_zoom ?? "8"); ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/admin/tour/tour-location.blade.php ENDPATH**/ ?>