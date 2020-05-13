<?php $__env->startSection('content'); ?>
    
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb40">
            <h1 class="title-bar">News Categories</h1>
        </div>

        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="panel">
                    <div class="panel-title">Add Category</div>
                    <div class="panel-body">                        
                        <form action="" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo $__env->make('News::admin/category/form',['parents'=>$rows], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="">
                                <button class="btn btn-primary" type="submit">Add new</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">                
                <div class="panel">
                    <div class="panel-title">All Categories</div>
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
                                <?php
                                $traverse = function ($categories, $prefix = '') use (&$traverse) {
                                    foreach ($categories as $row) {
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>"></td>
                                                <td>
                                                    <a href="<?php echo e(url('admin/module/news/category/edit/'.$row->id)); ?>"><?php echo e($prefix.' '.$row->name); ?></a>
                                                </td>
                                                <td><?php echo e($row->updated_at); ?></td>
                                            </tr>
                                        <?php
                                        $traverse($row->children, $prefix.'-');
                                    }
                                };

                                $traverse($rows);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* E:\Dungdt\booking-core\modules/News/Views/admin/category/index.blade.php */ ?>