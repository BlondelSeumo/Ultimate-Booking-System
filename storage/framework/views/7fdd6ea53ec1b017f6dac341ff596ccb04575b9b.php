<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Pricing")); ?></strong></div>
    <div class="panel-body">
        <h3 class="panel-body-title"><?php echo e(__("Tour Price")); ?></h3>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Price")); ?></label>
                    <input type="number" min="0" name="price" class="form-control" value="<?php echo e($row->price); ?>" placeholder="<?php echo e(__("Tour Price")); ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="control-label"><?php echo e(__("Sale Price")); ?></label>
                    <input type="text" name="sale_price" class="form-control" value="<?php echo e($row->sale_price); ?>" placeholder="<?php echo e(__("Tour Sale Price")); ?>">
                </div>
            </div>
        </div>
        <hr>
        <h3 class="panel-body-title"><?php echo e(__('Person Types')); ?></h3>
        <div class="form-group">
            <label><input type="checkbox" name="enable_person_types" <?php if(!empty($row->meta->enable_person_types)): ?> checked <?php endif; ?> value="1"> <?php echo e(__('Enable Person Types')); ?>

            </label>
        </div>
        <div class="form-group-item" data-condition="enable_person_types:is(1)">
            <label class="control-label"><?php echo e(__('Person Types')); ?></label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5"><?php echo e(__("Person Type")); ?></div>
                    <div class="col-md-2"><?php echo e(__('Min')); ?></div>
                    <div class="col-md-2"><?php echo e(__('Max')); ?></div>
                    <div class="col-md-2"><?php echo e(__('Price')); ?></div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                <?php if(!empty($row->meta->person_types)): ?>
                    <?php $__currentLoopData = $row->meta->person_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$person_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item" data-number="<?php echo e($key); ?>">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="person_types[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($person_type['name']); ?>" placeholder="<?php echo e(__('Eg: Adults')); ?>">
                                    <input type="text" name="person_types[<?php echo e($key); ?>][desc]" class="form-control" value="<?php echo e($person_type['desc'] ?? ''); ?>" placeholder="<?php echo e(__('Description')); ?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="person_types[<?php echo e($key); ?>][min]" class="form-control" value="<?php echo e($person_type['min']); ?>" placeholder="<?php echo e(__("Minimum per booking")); ?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="person_types[<?php echo e($key); ?>][max]" class="form-control" value="<?php echo e($person_type['max']); ?>" placeholder="<?php echo e(__("Maximum per booking")); ?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="person_types[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($person_type['price']); ?>" placeholder="<?php echo e(__("per 1 item")); ?>">
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="person_types[__number__][name]" class="form-control" value="" placeholder="<?php echo e(__('Eg: Adults')); ?>">
                            <input type="text" __name__="person_types[__number__][desc]" class="form-control" value="" placeholder="<?php echo e(__('Description')); ?>">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="person_types[__number__][min]" class="form-control" value="" placeholder="<?php echo e(__("Minimum per booking")); ?>">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="person_types[__number__][max]" class="form-control" value="" placeholder="<?php echo e(__("Maximum per booking")); ?>">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="person_types[__number__][price]" class="form-control" value="" placeholder="<?php echo e(__("per 1 item")); ?>">
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <h3 class="panel-body-title"><?php echo e(__('Extra Price')); ?></h3>
        <div class="form-group">
            <label><input type="checkbox" name="enable_extra_price" <?php if(!empty($row->meta->enable_extra_price)): ?> checked <?php endif; ?> value="1"> <?php echo e(__('Enable extra price')); ?>

            </label>
        </div>

        <div class="form-group-item" data-condition="enable_extra_price:is(1)">
            <label class="control-label"><?php echo e(__('Extra Price')); ?></label>
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-5"><?php echo e(__("Name")); ?></div>
                    <div class="col-md-3"><?php echo e(__('Price')); ?></div>
                    <div class="col-md-3"><?php echo e(__('Type')); ?></div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                <?php if(!empty($row->meta->extra_price)): ?>
                    <?php $__currentLoopData = $row->meta->extra_price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item" data-number="<?php echo e($key); ?>">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="extra_price[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($item['name'] ?? ''); ?>" placeholder="<?php echo e(__('Extra price name')); ?>">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" name="extra_price[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($item['price']); ?>">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[<?php echo e($key); ?>][type]" class="form-control">
                                        <option value=""><?php echo e(__('-- Select --')); ?></option>
                                        <option <?php if($item['type'] ==  'one_time'): ?> selected <?php endif; ?> value="one_time"><?php echo e(__("One-time")); ?></option>
                                        <option <?php if($item['type'] ==  'per_hour'): ?> selected <?php endif; ?> value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                        <option <?php if($item['type'] ==  'per_day'): ?> selected <?php endif; ?> value="per_day"><?php echo e(__("Per day")); ?></option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[<?php echo e($key); ?>][per_person]" class="form-control" value="on" <?php if($item['per_person'] ?? ''): ?> checked <?php endif; ?> >
                                        <?php echo e(__("Price per person")); ?>

                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" __name__="extra_price[__number__][name]" class="form-control" value="" placeholder="<?php echo e(__('Extra price name')); ?>">
                        </div>
                        <div class="col-md-3">
                            <input type="number" min="0" __name__="extra_price[__number__][price]" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <select __name__="extra_price[__number__][type]" class="form-control">
                                <option value=""><?php echo e(__('-- Select --')); ?></option>
                                <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                <option value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                <option value="per_day"><?php echo e(__("Per day")); ?></option>
                            </select>

                            <label>
                                <input type="checkbox" min="0" __name__="extra_price[__number__][per_person]" class="form-control" value="on">
                                <?php echo e(__("Price per person")); ?>

                            </label>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <h3 class="panel-body-title"><?php echo e(__('Discount by number of people')); ?></h3>

        <div class="form-group-item">
            <div class="g-items-header">
                <div class="row">
                    <div class="col-md-4"><?php echo e(__("No of people")); ?></div>
                    <div class="col-md-3"><?php echo e(__('Discount')); ?></div>
                    <div class="col-md-3"><?php echo e(__('Type')); ?></div>
                    <div class="col-md-1"></div>
                </div>
            </div>
            <div class="g-items">
                <?php if(!empty($row->meta->discount_by_people)): ?>
                    <?php $__currentLoopData = $row->meta->discount_by_people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item" data-number="<?php echo e($key); ?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][from]" class="form-control" value="<?php echo e($item['from']); ?>" placeholder="<?php echo e(__('From')); ?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][to]" class="form-control" value="<?php echo e($item['from']); ?>" placeholder="<?php echo e(__('To')); ?>">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][amount]" class="form-control" value="<?php echo e($item['amount']); ?>">
                                </div>
                                <div class="col-md-3">
                                    <select name="discount_by_people[<?php echo e($key); ?>][type]" class="form-control">
                                        <option value=""><?php echo e(__('-- Select --')); ?></option>
                                        <option <?php if($item['type'] ==  'fixed'): ?> selected <?php endif; ?> value="fixed"><?php echo e(__("Fixed")); ?></option>
                                        <option <?php if($item['type'] ==  'percent'): ?> selected <?php endif; ?> value="percent"><?php echo e(__("Percent (%)")); ?></option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="text-right">
                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
            </div>
            <div class="g-more hide">
                <div class="item" data-number="__number__">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="discount_by_people[__number__][from]" class="form-control" value="" placeholder="<?php echo e(__('From')); ?>">
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0" __name__="discount_by_people[__number__][to]" class="form-control" value="" placeholder="<?php echo e(__('To')); ?>">
                        </div>
                        <div class="col-md-3">
                            <input type="number" min="0" __name__="discount_by_people[__number__][amount]" class="form-control" value="">
                        </div>
                        <div class="col-md-3">
                            <select __name__="discount_by_people[__number__][type]" class="form-control">
                                <option value=""><?php echo e(__('-- Select --')); ?></option>
                                <option value="fixed"><?php echo e(__("Fixed")); ?></option>
                                <option value="percent"><?php echo e(__("Percent")); ?></option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/admin/tour/pricing.blade.php ENDPATH**/ ?>