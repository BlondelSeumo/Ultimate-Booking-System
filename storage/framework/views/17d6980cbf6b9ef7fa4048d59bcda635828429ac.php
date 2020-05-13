<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Location")); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title"><?php echo e(__("Add Location")); ?></div>
                    <div class="panel-body panel-index">
                        <form action="" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('Location::admin/form',['parents'=>$rows], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="">
                                <button class="btn btn-primary" type="submit"><?php echo e(__("Add new")); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        <?php if(!empty($rows)): ?>
                            <form method="post" action="<?php echo e(url('admin/module/location/editBulk')); ?>"
                                  class="filter-form filter-form-left d-flex justify-content-start">
                                <?php echo e(csrf_field()); ?>


                                <select name="action" class="form-control">
                                    <option value=""><?php echo e(__(" Bulk Action ")); ?></option>
                                    <option value="publish"><?php echo e(__(" Publish ")); ?></option>
                                    <option value="draft"><?php echo e(__(" Move to Draft ")); ?></option>
                                    <option value="delete"><?php echo e(__(" Delete ")); ?></option>
                                </select>
                                <button data-confirm="<?php echo e(__("Do you want to delete?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit"><?php echo e(__('Apply')); ?></button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="col-left">
                        <form method="get" action="<?php echo e(url('/admin/module/location')); ?>" class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            <input type="text" name="s" value="<?php echo e(Request()->s); ?>" class="form-control" placeholder="<?php echo e(__("Search by name")); ?>">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit"><?php echo e(__('Search')); ?></button>
                        </form>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th><?php echo e(__("Name")); ?></th>
                                    <th class="slug d-none d-md-block"><?php echo e(__("Slug")); ?></th>
                                    <th class="status"><?php echo e(__("Status")); ?></th>
                                    <th class="date d-none d-md-block" ><?php echo e(__("Date")); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if( count($rows) > 0): ?>
                                    <?php
                                    $traverse = function ($categories, $prefix = '') use (&$traverse) {
                                    foreach ($categories as $row) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>" class="check-item">
                                        </td>
                                        <td class="title">
                                            <a href="<?php echo e(url('admin/module/location/edit/'.$row->id)); ?>"><?php echo e($prefix.' '.$row->name); ?></a>
                                        </td>
                                        <td class="d-none d-md-block"><?php echo e($row->slug); ?></td>
                                        <td><span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span></td>
                                        <td class="d-none d-md-block"><?php echo e(display_date($row->updated_at)); ?></td>
                                    </tr>
                                    <?php
                                    $traverse($row->children, $prefix . '-');
                                    }
                                    };
                                    $traverse($rows);
                                    ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5"><?php echo e(__("No data")); ?></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script.body'); ?>
    <script src="<?php echo e(url('module/core/js/map-engine.js')); ?>"></script>
    <script>
        jQuery(function ($) {
            new BravoMapEngine('map_content', {
                fitBounds: true,
                center: [<?php echo e($row->map_lat ?? "51.505"); ?>, <?php echo e($row->map_lng ?? "-0.09"); ?>],
                zoom:<?php echo e($row->map_zoom ?? "8"); ?>,
                ready: function (engineMap) {
                    <?php if($row->map_lat && $row->map_lng): ?>
                    engineMap.addMarker([<?php echo e($row->map_lat); ?>, <?php echo e($row->map_lng); ?>], {
                        icon_options: {}
                    });
                    <?php endif; ?>
                    engineMap.on('click', function (dataLatLng) {
                        engineMap.clearMarkers();
                        engineMap.addMarker(dataLatLng, {
                            icon_options: {}
                        });
                        $("input[name=map_lat]").attr("value", dataLatLng[0]);
                        $("input[name=map_lng]").attr("value", dataLatLng[1]);
                    });
                    engineMap.on('zoom_changed', function (zoom) {
                        $("input[name=map_zoom]").attr("value", zoom);
                    })
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Location/Views/admin/index.blade.php ENDPATH**/ ?>