<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Subscribers")); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-title"><?php echo e(__("Add Subscriber")); ?></div>
                    <div class="panel-body">
                        <form action="<?php echo e(url('/admin/module/user/subscriber/store')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('User::newsletter/subscriber/form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <form method="post" action="<?php echo e(url('admin/module/user/subscriber/editBulk')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                                <?php echo e(csrf_field()); ?>

                                <select name="action" class="form-control">
                                    <option value=""><?php echo e(__(" Bulk Action ")); ?></option>
                                    <option value="delete"><?php echo e(__(" Delete ")); ?></option>
                                </select>
                                <button data-confirm="<?php echo e(__("Do you want to delete?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit"><?php echo e(__('Apply')); ?></button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="col-left">
                        <form method="get" action="<?php echo e(url('/admin/module/user/subscriber')); ?> " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                            <a class="btn btn-warning btn-icon" href="<?php echo e(url('/admin/module/user/subscriber/export')); ?>" target="_blank" title="<?php echo e(__("Export to excel")); ?>"><i class="icon ion-md-cloud-download"></i>&nbsp;<?php echo e(__('Export')); ?>

                            </a>
                            <input type="text" name="s" value="<?php echo e(Request()->s); ?>" class="form-control" placeholder="<?php echo e(__("Search by name or email")); ?>">
                            <button class="btn-info btn btn-icon btn_search" id="search-submit" type="submit"><?php echo e(__('Search')); ?></button>
                        </form>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-body">
                        <form class="bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th><?php echo e(__("Name")); ?></th>
                                    <th><?php echo e(__("First name")); ?></th>
                                    <th><?php echo e(__("Last name")); ?></th>
                                    <th class="date"><?php echo e(__("Date")); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>" class="check-item">
                                        <td class="title">
                                            <a href="<?php echo e(url('admin/module/user/subscriber/edit/'.$row->id)); ?>"><?php echo e($row->email); ?></a>
                                        </td>
                                        <td><?php echo e($row->first_name); ?></td>
                                        <td><?php echo e($row->last_name); ?></td>
                                        <td><?php echo e(display_date($row->updated_at)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-center"><?php echo e($rows->links()); ?></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/User/Views/newsletter/subscriber/index.blade.php ENDPATH**/ ?>