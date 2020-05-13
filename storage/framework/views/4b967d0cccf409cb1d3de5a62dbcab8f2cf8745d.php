<?php $__env->startSection('content'); ?>
    <?php $services  = []; ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Tour Booking Calendar")); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="panel">

            <div class="panel-body">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        <form method="get" action="" class="filter-form filter-form-left d-flex flex-column flex-sm-row" role="search">
                            <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Search by name')); ?>" class="form-control">
                            <select name="cat_id" class="form-control">
                                <option value=""><?php echo e(__('--All Category --')); ?> </option>
                                <?php
                                foreach ($tour_categories as $category) {
                                    $selected = '';

                                    if($request->query('cat_id') == $category->id) $selected = 'selected';

                                    printf("<option value='%s' %s>%s</option>", $category->id,$selected, $category->name);
                                }
                                ?>
                            </select>
                            <button class="btn-info btn btn-icon btn_search" type="submit"><?php echo e(__('Search')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="booking-calendar vec-wrap panel" id="booking-calendar" >
            <div class="panel-body">
                <div class="vec-header-toolbar d-flex justify-content-between align-items-center">
                    <div class=""><i><span class="count-string"><?php echo e(__("Showing :from - :to of :total Tour(s)",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></span></i></div>
                    <div class="current-month"><?php echo e(date('M-Y',$current_month)); ?></div>
                    <div class="btn-group" role="group">
                        <a href="<?php echo e($prev_url); ?>" type="button" class="btn btn-secondary"><i class="icon ion-ios-arrow-back"></i></a>
                        <a href="<?php echo e($next_url); ?>" type="button" class="btn btn-secondary"><i class="icon ion-ios-arrow-forward"></i></a>
                    </div>
                </div>
                <table class="vec-view-container" width="100%" cellpadding="0" cellspacing="0">
                    <thead class="vec-head">
                    <tr>
                        <th width="300px" class="vec-event-header"><?php echo e(__('Tours')); ?></th>
                        <th class="vec-divider"></th>
                        <th class="vc-time-area">
                            <div class="vec-scroll-flip">
                                <div class="vec-scroll-box">
                                    <table class="" width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <?php for($i = 1 ; $i <= date('t',$current_month) ; $i++): ?>
                                                <?php $day = strtotime(date('Y-m-',$current_month).$i) ?>
                                                <td class="vec-time-text">
                                                    <span class="vec-day"><?php echo e(date('d',$day)); ?></span>
                                                    <span class="vec-month"><?php echo e(date('M',$day)); ?></span>
                                                    <span class="vec-year"><?php echo e(date('Y',$day)); ?></span>
                                                    <span class="vec-day-of-week"><?php echo e(date('D',$day)); ?></span>
                                                </td>
                                            <?php endfor; ?>

                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="vec-body">
                    <tr>
                        <td class="vec-events" width="300px">
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="vec-event-<?php echo e($row->id); ?> vec-event-name">
                                        <a href="<?php echo e($row->getEditUrl()); ?>" target="_blank" title="#<?php echo e($row->id); ?> - <?php echo e($row->title); ?>">#<?php echo e($row->id); ?> - <?php echo e($row->title); ?></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td class="vec-divider"></td>
                        <td class="vec-time-area">
                            <div class="vec-scroll-flip">
                                <div class="vec-scroll-box">
                                    <table width="100%" class="vec-events-list" cellspacing="0" cellpadding="0">
                                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="vec-event-list-tr">
                                                <td>
                                                    <div class="vec-event-containers" data-id="<?php echo e($row->id); ?>">
                                                        <?php $bookings = $row->getBookingsInRange(date('Y-m-01',$current_month),date('Y-m-t',$current_month)) ?>
                                                        <?php if(!empty($bookings)): ?>
                                                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php $service = $booking->service;
                                                                if(!empty($service)){
                                                                    $service->booking = $booking;
                                                                    $services[] = $service;
                                                                }
                                                                ?>
                                                                <div title="#<?php echo e($booking->id); ?> - <?php echo e($booking->email); ?>" data-from="<?php echo e(date('d',strtotime($booking->start_date))); ?>" data-to="<?php echo e(date('d',strtotime($booking->end_date))); ?>" class="vec-event-item d-none status-<?php echo e($booking->status); ?>" data-toggle="modal" data-target="#modal-booking-<?php echo e($booking->id); ?>">
                                                                    #<?php echo e($booking->id); ?> - <?php echo e($booking->email); ?>

                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                    <div class="vec-events-bg">
                                        <table class="" width="100%" cellpadding="0" cellspacing="0">
                                            <tr class="vec-event-time-row">
                                                <?php for($i = 1 ; $i <= date('t',$current_month) ; $i++): ?>
                                                    <td class="vec-event-time-td" >
                                                        <div>&nbsp;</div>
                                                    </td>
                                                <?php endfor; ?>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make($service->checkout_booking_detail_modal_file ?? '',['booking'=>$service->booking], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="d-flex justify-content-center">
            <?php echo e($rows->appends($request->query())->links()); ?>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script.head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('libs/vertical-calendar/css/vertical-calendar.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script.body'); ?>
<script src="<?php echo e(asset('libs/vertical-calendar/vertical-calendar.js')); ?>"></script>
<script>
	new VerticalEventCalendar({
        el:'#booking-calendar',
		eventHeaderName:'<?php echo e(__('Tours')); ?>'
    });
    var baseColumnWidth = ($('.vec-header-toolbar').width() - $('.vec-event-header').width() ) / <?php echo e(date('t',$current_month)); ?>;
    baseColumnWidth = parseInt(baseColumnWidth);
    var baseEventHeight = 25;

    (function ($) {
        $('.vec-event-containers').each(function () {
            var me = this;
            var items = $(this).find('.vec-event-item');
            if(!items.length){
                return;
            }
            var id = $(this).data('id');
            items.each(function (i,v) {
                $(this).css({
                    left:baseColumnWidth * (parseInt($(this).data('from')) - 1),
                    width:baseColumnWidth * (parseInt($(this).data('to') - parseInt($(this).data('from')) + 1)),
                    top:baseEventHeight * i + (i * 2) + 1
                });
                $(this).removeClass('d-none')
            });

            $(this).css({
                height:(baseEventHeight + 1) * items.length + 2
            });

            $('.vec-events .vec-event-'+id).css({
                height:(baseEventHeight + 1) * items.length+ 2
            });

        })

    })(jQuery);

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Tour/Views/admin/booking/index.blade.php ENDPATH**/ ?>