<?php $__env->startSection('page-title'); ?>
    <?php echo e(__($project->name)); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-page'); ?>
    <script>
        function update_status(that) {
            status = $(that).val();
            id = $(that).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '/tasks/status',
                data: {
                    id: id,
                    status: status,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.log(error.responseText);
                }
            });
        }

        function update_priority(that) {
            priority = $(that).val();
            id = $(that).attr('data-id');

            $.ajax({
                type: 'POST',
                url: '/tasks/priority',
                data: {
                    id: id,
                    priority: priority,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (error) {
                    console.log(error.responseText);
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <ul class="mt-3 nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e("/projects/$id"); ?>">
                <i class="fa fa-th"></i>
                <?php echo e(__('Description')); ?>

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="<?php echo e("/projects/$id/tasks"); ?>">
                <i class="fa fa-check-circle"></i>
                <?php echo e(__('Tasks')); ?>

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo e("/projects/$id/files"); ?>">
                <i class="fa fa-copy"></i>
                <?php echo e(__('Files')); ?>

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo e("/projects/$id/contracts"); ?>">
                <i class="fa fa-file"></i>
                <?php echo e(__('Contracts')); ?>

            </a>
        </li>
    </ul>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <?php echo e(__('Tasks')); ?>

                </div>

                <div class="card-body">
                    <a href="<?php echo e("/projects/$id/tasks/create"); ?>" class="btn-create btn-xs badge-blue radius-10px"><?php echo e(__('Add task')); ?></a>
                    <a href="<?php echo e("/projects/$id/tasks?view=kanban"); ?>" class="btn-create btn-xs bg-gray radius-10px"><?php echo e(__('View as kan ban')); ?></a>

                    <hr>

                    <div class="row">
                        <div class="col-2">
                            <div class="card card-box">
                                <?php echo e(__('To start') . ': ' . $project->tasks->where('status', 'To start')->count()); ?>

                            </div>
                        </div>

                        <div class="col-2">
                            <div class="card card-box text-primary">
                                <?php echo e(__('In progress') . ': ' . $project->tasks->where('status', 'In progress')->count()); ?>

                            </div>
                        </div>

                        <div class="col-2">
                            <div class="card card-box">
                                <?php echo e(__('On trial') . ': ' . $project->tasks->where('status', 'On trial')->count()); ?>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box text-success">
                                <?php echo e(__('Wait for reply') . ': ' . $project->tasks->where('status', 'Wait for reply')->count()); ?>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box text-success">
                                <?php echo e(__('Complete') . ': ' . $project->tasks->where('status', 'Complete')->count()); ?>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Date start')); ?></th>
                                <th><?php echo e(__('Date end')); ?></th>
                                <th><?php echo e(__('Cost')); ?></th>
                                <th><?php echo e(__('Priority')); ?></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($task->theme); ?></td>

                                        <td><?php echo e(Form::select('status', $statuses, $task->status, ['data-id' => $task->id, 'class' => 'form-control select2', 'onchange' => 'update_status(this)'])); ?></td>

                                        <td><?php echo e($task->date_start); ?></td>
                                        <td><?php echo e($task->date_end); ?></td>
                                        <td><?php echo e($task->cost); ?></td>

                                        <td><?php echo e(Form::select('priority', $priorities, $task->priority, ['data-id' => $task->id, 'class' => 'form-control select2', 'onchange' => 'update_priority(this)'])); ?></td>

                                        <td nowrap>
                                            <a href="<?php echo e('/projects/' . $project->id . '/tasks/' . $task->id . '/edit'); ?>" class="edit-icon">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($task->id); ?>').submit();">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form method="POST" id="<?php echo e('delete-form-'.$task->id); ?>" action="<?php echo e('/projects/' . $project->id . '/tasks/' . $task->id); ?>">
                                                <?php echo method_field('DELETE'); ?>
                                                <?php echo csrf_field(); ?>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/tasks/index.blade.php ENDPATH**/ ?>