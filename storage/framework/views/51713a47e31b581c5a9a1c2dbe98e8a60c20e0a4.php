<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__('All Contact Submissions')); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left"> 
                <?php if(!empty($rows)): ?>
                <form method="post" action="<?php echo e(url('admin/module/page/bulkEdit')); ?>" class="filter-form filter-form-left d-flex justify-content-start">
                    <?php echo e(csrf_field()); ?>

                    <select name="action" class="form-control">
                        <option value=""><?php echo e(__(" Bulk Actions ")); ?></option>
                        <option value="delete"><?php echo e(__(" Delete ")); ?></option>
                    </select>
                    <button data-confirm="<?php echo e(__("Do you want to delete?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit"><?php echo e(__('Apply')); ?></button>
                </form>
               <?php endif; ?>
            </div>
            <div class="col-left">
               <form method="get" action="<?php echo e(url('/admin/module/contact/')); ?> " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                    <input  type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Search...')); ?>" class="form-control">
                    <button class="btn-info btn btn-icon btn_search"  type="submit"><?php echo e(__('Search')); ?></button>
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
                                <th ><?php echo e(__('Name')); ?></th>
                                <th class="author"><?php echo e(__('Email')); ?> </th>
                                <th ><?php echo e(__('Content')); ?> </th>
                                <th class="date"><?php echo e(__('Date')); ?> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($rows->total() > 0): ?>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" class="check-item" value="<?php echo e($row->id); ?>"></td>
                                        <td class="title">
                                            <?php echo e($row->name); ?>

                                        </td>
                                        <td class="author"><?php echo e($row->email ?? ''); ?> </td>
                                        <td><?php echo e($row->message); ?></td>
                                        <td class="date"><?php echo e(display_datetime($row->updated_at)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5"><?php echo e(__("No data")); ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
                <?php echo e($rows->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/Contact/Views/admin/index.blade.php ENDPATH**/ ?>