<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Test Map</div>

                    <div class="card-body">
                        <div id="test_map" style="height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<script src="<?php echo e(url('module/core/js/map-engine.js')); ?>"></script>
<script>
    new BravoMapEngine('test_map',{
        fitBounds:true,
        center:[51.505, -0.09],
        zoom:6,
        ready: function (engine) {
            console.log(engine);

            engine.addMarker([51.505, -0.09],{
                icon_options:{
                    iconUrl :'http://travelhotel.wpengine.com/wp-content/uploads/2018/11/ico_mapker_hotel.png'
                }
            });

            engine.on('click',function (center) {
                engine.addMarker(center,{
                    icon_options:{
                        iconUrl :'http://travelhotel.wpengine.com/wp-content/uploads/2018/11/ico_mapker_hotel.png'
                    }
                });
            })
        }
    });


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\resources\views/test.blade.php ENDPATH**/ ?>