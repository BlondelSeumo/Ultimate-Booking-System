<?php $__env->startSection('content'); ?>
    <form action="" method="post">
        <?php echo csrf_field(); ?>
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? __('Edit: ').$row->title : __('Add new tour')); ?></h1>
                    <?php if($row->slug): ?>
                        <p class="item-url-demo"><?php echo e(__("Permalink")); ?>: <?php echo e(url(config('tour.tour_route_prefix') )); ?>/<a href="#" class="open-edit-input" data-name="slug"><?php echo e($row->slug); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="">
                    <?php if($row->slug): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e($row->getDetailUrl()); ?>" target="_blank"><?php echo e(__("View Tour")); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <?php echo $__env->make('Tour::admin/tour/tour-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('Tour::admin/tour/tour-location', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('Tour::admin/tour/pricing', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('Tour::admin/tour/availability', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('Core::admin/seo-meta/seo-meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                        <div class="panel-body">
                            <div>
                                <label><input <?php if($row->status=='publish'): ?> checked <?php endif; ?> type="radio" name="status" value="publish"> <?php echo e(__("Publish")); ?>

                                </label></div>
                            <div>
                                <label><input <?php if($row->status=='draft'): ?> checked <?php endif; ?> type="radio" name="status" value="draft"> <?php echo e(__("Draft")); ?>

                                </label></div>
                            <div class="text-right">
                                <button class="btn btn-primary" type="submit"><?php echo e(__('Save Changes')); ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__("Tour Featured")); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <input type="checkbox" name="is_featured" <?php if($row->is_featured): ?> checked <?php endif; ?> value="1"> <?php echo e(__("Enable featured")); ?>

                            </div>
                        </div>
                    </div>
                    <?php echo $__env->make('Tour::admin/tour/attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Feature Image')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script.body'); ?>
    <?php echo App\Helpers\MapEngine::scripts(); ?>

    <script>
        jQuery(function ($) {
            new BravoMapEngine('map_content', {
                disableScripts: true,
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/admin/detail.blade.php ENDPATH**/ ?>