<form action="" class="form bravo_form d-flex justify-content-start" method="get" onsubmit="return false;">
    <div class="filter-item">
        <div class="form-group field-detination">
            <i class="field-icon fa icofont-map"></i>
            <div class="dropdown" id="dropdown-destination">
                <select name="location_id" class="form-control input-filter">
                    <option value=""><?php echo e(__("Where are you going?")); ?></option>
                    <?php
                    $current_location_id = Request::query('location_id');
                    $traverse = function ($locations, $prefix = '') use (&$traverse, $current_location_id) {
                        foreach ($locations as $location) {
                            $selected = '';
                            if ($current_location_id == $location->id)
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
    </div>
    <div class="filter-item">
        <div class="form-group field-detination">
            <i class="field-icon icofont-beach"></i>
            <div class="dropdown" id="dropdown-destination">
                <select name="cat_id" class="form-control input-filter">
                    <option value=""><?php echo e(__("All Category")); ?></option>
                    <?php
                    $current_location_id = Request::query('cat_id');
                    $traverse = function ($locations, $prefix = '') use (&$traverse, $current_location_id) {
                        foreach ($locations as $location) {
                            $selected = '';
                            if ($current_location_id == $location->id)
                                $selected = 'selected';
                            printf("<option value='%s' %s>%s</option>", $location->id, $selected, $prefix . ' ' . $location->name);
                            $traverse($location->children, $prefix . '-');
                        }
                    };
                    $traverse($tour_category);
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="filter-item">
        <div class="form-group form-date-field form-date-search clearfix  has-icon" data-format="DD/MM/YYYY">
            <i class="field-icon icofont-wall-clock"></i>
            <div class="date-wrapper clearfix">
                <div class="check-in-wrapper d-flex align-items-center">
                    <div class="render check-in-render"><?php echo e(Request::query('start',date("d/m/Y"))); ?></div>
                    <span> - </span>
                    <div class="render check-out-render"><?php echo e(Request::query('end',date("d/m/Y",strtotime("+1 day")))); ?></div>
                </div>
            </div>
            <input type="hidden" class="check-in-input" value="<?php echo e(Request::query('start',date("d/m/Y"))); ?>" name="start">
            <input type="hidden" class="check-out-input" value="<?php echo e(Request::query('end',date("d/m/Y",strtotime("+1 day")))); ?>" name="end">
            <input type="text" class="check-in-out input-filter" name="date" value="<?php echo e(Request::query('date')); ?>">
        </div>
    </div>
    <div class="filter-item filter-simple dropdown">
        <div class="form-group" data-toggle="dropdown">
            <span class="filter-title"><?php echo e(__('Price filter')); ?> <i class="fa fa-angle-down"></i></span>
        </div>
        <div class="filter-dropdown dropdown-menu dropdown-menu-right">
            <div class="bravo-filter-price">
                <?php
                $price_min = $pri_from = $tour_min_max_price[0];
                $price_max = $pri_to = $tour_min_max_price[1];
                if (!empty($price_range = Request::query('price_range'))) {
                    $pri_from = explode(";", $price_range)[0];
                    $pri_to = explode(";", $price_range)[1];
                }
                $currency = App\Currency::getCurrency(setting_item('currency_main'))
                ?>
                <input type="hidden" class="filter-price irs-hidden-input" name="price_range"
                       data-symbol=" <?php echo e($currency['symbol'] ?? ''); ?>"
                       data-min="<?php echo e($price_min); ?>"
                       data-max="<?php echo e($price_max); ?>"
                       data-from="<?php echo e($pri_from); ?>"
                       data-to="<?php echo e($pri_to); ?>"
                       readonly="" value="<?php echo e($price_range); ?>">
                <div class="text-right">
                    <br>
                    <a href="#" onclick="return false;" class="btn btn-primary btn-sm btn-apply-advances"><?php echo e(__("APPLY")); ?></a>

                </div>
            </div>
        </div>
    </div>
    <div class="filter-item filter-simple">
        <div class="form-group">
            <span class="filter-title toggle-advance-filter" data-target="#advance_filters"><?php echo e(__('More filters')); ?> <i class="fa fa-angle-down"></i></span>
        </div>
    </div>
</form>
<?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/frontend/layouts/search-map/form-search-map.blade.php ENDPATH**/ ?>