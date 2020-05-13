<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb40">
            <h1 class="title-bar">Page</h1>
            <div class="title-actions">
                <a href="<?php echo e(url('admin/module/user/permission/create')); ?>" class="btn btn-primary">Add new permission</a>
            </div>
        </div>

        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="panel">
            <div class="panel-title">All Permission</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60px"><input type="checkbox" class="check-all"></th>
                            <th>Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>"></td>
                                <td>
                                    <a href="<?php echo e(url('admin/module/user/permission/edit/'.$row->id)); ?>"><?php echo e($row->name); ?></a>
                                </td>
                                <td><?php echo e($row->updated_at); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($rows->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/User/Views/admin/permission/index.blade.php ENDPATH**/ ?>