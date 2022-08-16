<?php $__env->startSection('page-title'); ?>
    <?php echo e(__($project->name)); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-button'); ?>
    <a href="<?php echo e("/projects/$id/tasks/create"); ?>" class="btn-create btn-xs badge-blue radius-10px"><?php echo e(__('Add task')); ?></a>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('css-page'); ?>
    <style>
        .container {
            width: 70%;
            min-width: 50%;
            margin: auto;
            display: flex;
            flex-direction: column;
        }

        .kanban-block {
            border: 1px solid black;
            margin: 0px 5px 5px 0px;
        }

        .kanban-board {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-family: sans-serif;
        }

        .kanban-block,
        .create-new-task-block {
            padding: 0.6rem;
            width: 30.5%;
            min-width: 14rem;
            min-height: 4.5rem;
            border-radius: 0.3rem;
        }

        .task {
            background-color: white;
            margin: 0.2rem 0rem 0.3rem 0rem;
            border: 0.1rem solid black;
            border-radius: 0.2rem;
            padding: 0.5rem 0.2rem 0.5rem 2rem;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script-page'); ?>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.currentTarget.appendChild(document.getElementById(data));

            status = $(ev.currentTarget).attr('data-status');
            id = $('#' + data).attr('data-id');

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
                <div class="card-body">
                    <div class="container">
                        <div class="kanban-board">
                            <div class="kanban-block" data-status="To start" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong><?php echo e(__('To start')); ?></strong>                                

                                <?php $__currentLoopData = $project->tasks->where('status', 'To start'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="task" data-id="<?php echo e($task->id); ?>" id="<?php echo e(Str::slug($task->theme)); ?>" draggable="true" ondragstart="drag(event)">
                                        <span><?php echo e($task->theme); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="kanban-block" data-status="In progress" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong><?php echo e(__('In progress')); ?></strong>

                                <?php $__currentLoopData = $project->tasks->where('status', 'In progress'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="task" data-id="<?php echo e($task->id); ?>" id="<?php echo e(Str::slug($task->theme)); ?>" draggable="true" ondragstart="drag(event)">
                                        <span><?php echo e($task->theme); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="kanban-block" data-status="On trial" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong><?php echo e(__('On trial')); ?></strong>

                                <?php $__currentLoopData = $project->tasks->where('status', 'On trial'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="task" data-id="<?php echo e($task->id); ?>" id="<?php echo e(Str::slug($task->theme)); ?>" draggable="true" ondragstart="drag(event)">
                                        <span><?php echo e($task->theme); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="kanban-block" data-status="Wait for reply" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong><?php echo e(__('Wait for reply')); ?></strong>

                                <?php $__currentLoopData = $project->tasks->where('status', 'Wait for reply'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="task" data-id="<?php echo e($task->id); ?>" id="<?php echo e(Str::slug($task->theme)); ?>" draggable="true" ondragstart="drag(event)">
                                        <span><?php echo e($task->theme); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="kanban-block" data-status="Complete" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <strong><?php echo e(__('Complete')); ?></strong>

                                <?php $__currentLoopData = $project->tasks->where('status', 'Complete'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="task" data-id="<?php echo e($task->id); ?>" id="<?php echo e(Str::slug($task->theme)); ?>" draggable="true" ondragstart="drag(event)">
                                        <span><?php echo e($task->theme); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/tasks/kanban.blade.php ENDPATH**/ ?>