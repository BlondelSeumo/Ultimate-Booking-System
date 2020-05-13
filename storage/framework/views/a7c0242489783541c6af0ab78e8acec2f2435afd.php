<?php $__env->startSection('title','News'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("All news")); ?></h1>
            <div class="title-actions">
                <a href="<?php echo e(url('admin/module/news/create')); ?>" class="btn btn-primary"><?php echo e(__("Add new Post")); ?></a>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                <?php if(!empty($rows)): ?>
                    <form method="post" action="<?php echo e(url('admin/module/news/bulkEdit')); ?>"
                          class="filter-form filter-form-left d-flex justify-content-start">
                        <?php echo e(csrf_field()); ?>

                        <select name="action" class="form-control">
                            <option value=""><?php echo e(__(" Bulk Actions ")); ?></option>
                            <option value="publish"><?php echo e(__(" Publish ")); ?></option>
                            <option value="draft"><?php echo e(__(" Move to Draft ")); ?></option>
                            <option value="delete"><?php echo e(__(" Delete ")); ?></option>
                        </select>
                        <button data-confirm="<?php echo e(__("Do you want to delete?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="submit"><?php echo e(__('Apply')); ?></button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="col-left">
                <form method="get" action="<?php echo e(url('/admin/module/news/')); ?> " class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Search by name')); ?>"
                           class="form-control">
                    <select name="cate_id" class="form-control">
                        <option value=""><?php echo e(__('--All Category --')); ?> </option>
                        <?php
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                printf("<option value='%s' >%s</option>", $category->id, $category->name);
                            }
                        }
                        ?>
                    </select>
                    <button class="btn-info btn btn-icon btn_search" type="submit"><?php echo e(__('Search News')); ?></button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i><?php echo e(__('Found :total items',['total'=>$rows->total()])); ?></i></p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th class="title"> <?php echo e(__('Name')); ?></th>
                                    <th class="category"> <?php echo e(__('Category')); ?></th>
                                    <th class="author"> <?php echo e(__('Author')); ?></th>
                                    <th class="date"> <?php echo e(__('Date')); ?></th>
                                    <th width="100px"><?php echo e(__('Status')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($rows->total() > 0): ?>
                                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="check-item" name="ids[]" value="<?php echo e($row->id); ?>">
                                            </td>
                                            <td class="title">
                                                <a href="<?php echo e(url('admin/module/news/edit/'.$row->id)); ?>"><?php echo e($row->title); ?></a>
                                            </td>
                                            <td><?php echo e($row->getCategory->name ?? ''); ?></td>
                                            <td> <?php echo e($row->getAuthor->name ?? ''); ?> </td>
                                            <td> <?php echo e(display_date($row->updated_at)); ?></td>
                                            <td><span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6"><?php echo e(__("No data")); ?></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            </div>
                        </form>
                        <?php echo e($rows->appends(request()->query())->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\modules/News/Views/admin/news/index.blade.php ENDPATH**/ ?>