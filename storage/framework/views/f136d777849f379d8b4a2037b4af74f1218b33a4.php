<?php $__env->startSection('content'); ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <style>

    #table-log {
        font-size: 0.85rem;
    }

    .sidebar {
        font-size: 0.85rem;
        line-height: 1;
    }

    .stack {
      font-size: 0.85em;
    }

    .date {
      min-width: 75px;
    }

    .text {
      word-break: break-all;
    }

    a.llv-active {
      z-index: 2;
      background-color: #f5f5f5;
      border-color: #777;
    }

    .list-group-item {
      word-wrap: break-word;
    }

    .folder {
      padding-top: 15px;
    }

    .div-scroll {
      height: 80vh;
      overflow: hidden auto;
    }
    .nowrap {
      white-space: nowrap;
    }

  </style>
<div class="container-fluid">
  <div class="row">
    <div class="col sidebar mb-3">

        <h5><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo e(__('System Log Viewer')); ?></h5>
        <br>
        <div class="list-group div-scroll">
                    <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item">
                            <a href="?f=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($folder)); ?>">
                                <span class="fa fa-folder"></span> <?php echo e($folder); ?>

                            </a>
                            <?php if($current_folder == $folder): ?>
                                <div class="list-group folder">
                                    <?php $__currentLoopData = $folder_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="?l=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($file)); ?>&f=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($folder)); ?>"
                                           class="list-group-item <?php if($current_file == $file): ?> llv-active <?php endif; ?>">
                                            <?php echo e($file); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="?l=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($file)); ?>"
                           class="list-group-item <?php if($current_file == $file): ?> llv-active <?php endif; ?>">
                            <?php echo e($file); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
    </div>
    <div class="col-10 table-container">
      <div class="panel">
          <div class="panel-body">
              <?php if($logs === null): ?>
                  <div>
                      <?php echo e(__('Log file >50M, please download it.')); ?>

                  </div>
              <?php else: ?>
                  <table id="table-log" class="table table-striped" data-ordering-index="<?php echo e($standardFormat ? 2 : 0); ?>">
                      <thead>
                      <tr>
                          <?php if($standardFormat): ?>
                              <th><?php echo e(__('Level')); ?></th>
                              <th><?php echo e(__('Context')); ?></th>
                              <th><?php echo e(__('Date')); ?></th>
                          <?php else: ?>
                              <th><?php echo e(__('Line number')); ?></th>
                          <?php endif; ?>
                          <th><?php echo e(__('Content')); ?></th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr data-display="stack<?php echo e($key); ?>">
                              <?php if($standardFormat): ?>
                                  <td class="nowrap text-<?php echo e($log['level_class']); ?>">
                                      <span class="fa fa-<?php echo e($log['level_img']); ?>" aria-hidden="true"></span>&nbsp;&nbsp;<?php echo e($log['level']); ?>

                                  </td>
                                  <td class="text"><?php echo e($log['context']); ?></td>
                              <?php endif; ?>
                              <td class="date"><?php echo e($log['date']); ?></td>
                              <td class="text">
                                  <?php if($log['stack']): ?>
                                      <button type="button"
                                              class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                              data-display="stack<?php echo e($key); ?>">
                                          <span class="fa fa-search"></span>
                                      </button>
                                  <?php endif; ?>
                                  <?php echo e($log['text']); ?>

                                  <?php if(isset($log['in_file'])): ?>
                                      <br/><?php echo e($log['in_file']); ?>

                                  <?php endif; ?>
                                  <?php if($log['stack']): ?>
                                      <div class="stack" id="stack<?php echo e($key); ?>"
                                           style="display: none; white-space: pre-wrap;"><?php echo e(trim($log['stack'])); ?>

                                      </div>
                                  <?php endif; ?>
                              </td>
                          </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </tbody>
                  </table>
              <?php endif; ?>
              <div class="p-3">
                  <?php if($current_file): ?>
                      <a href="?dl=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file)); ?><?php echo e(($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : ''); ?>">
                          <span class="fa fa-download"></span> Download file
                      </a>
                      -
                      <a id="clean-log" href="?clean=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file)); ?><?php echo e(($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : ''); ?>">
                          <span class="fa fa-sync"></span> Clean file
                      </a>
                      -
                      <a id="delete-log" href="?del=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($current_folder ? $current_folder . "/" . $current_file : $current_file)); ?><?php echo e(($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : ''); ?>">
                          <span class="fa fa-trash"></span> Delete file
                      </a>
                      <?php if(count($files) > 1): ?>
                          -
                          <a id="delete-all-log" href="?delall=true<?php echo e(($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : ''); ?>">
                              <span class="fa fa-trash-alt"></span> Delete all files
                          </a>
                      <?php endif; ?>
                  <?php endif; ?>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script.body'); ?>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.table-container tr').on('click', function () {
                $('#' + $(this).data('display')).toggle();
            });
            $('#table-log').DataTable({
                "order": [$('#table-log').data('orderingIndex'), 'desc'],
                "stateSave": true,
                "stateSaveCallback": function (settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function (settings) {
                    var data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });
            $('#delete-log, #clean-log, #delete-all-log').click(function () {
                return confirm('Are you sure?');
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Dungdt\booking-core\resources\views/vendor/laravel-log-viewer/log.blade.php ENDPATH**/ ?>