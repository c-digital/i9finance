<?php $__env->startSection('page-title'); ?>
    <?php echo e(__($project->name)); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <ul class="mt-3 nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="">
                <i class="fa fa-th"></i>
                <?php echo e(__('Description')); ?>

            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo e("/projects/$id/tasks"); ?>">
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
                    <?php echo e(__('Resume')); ?>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p><b>#:</b> <?php echo e($project->id); ?></p>
                            <p><b><?php echo e(__('Customer')); ?>:</b> <?php echo e($project->customer->name); ?></p>
                            <p><b><?php echo e(__('Billing type')); ?>:</b> <?php echo e(__($project->billing_type)); ?></p>
                            <p><b><?php echo e(__('Total cost')); ?>:</b> <?php echo e($project->total_cost); ?></p>
                            <p><b><?php echo e(__('Date start')); ?>:</b> <?php echo e($project->date_start); ?></p>
                            <p><b><?php echo e(__('Date end')); ?>:</b> <?php echo e($project->date_end); ?></p>

                            <hr>

                            <p><b><?php echo e(__('Description')); ?></b></p>
                            <p><?php echo e($project->description); ?></p>

                            <hr>

                            <p><b><?php echo e(__('Members')); ?></b></p>

                            <?php $__currentLoopData = $project->project_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $user = App\User::find($member); ?>

                                <p>
                                    <span class="avatar rounded-circle">
                                        <img style="width: 65%" src="<?php echo e($user->avatar ? $user->avatar : '/storage/uploads/avatar/avatar.png'); ?>" alt="<?php echo e($user->name); ?>">
                                    </span>

                                    <?php echo e($user->name); ?>

                                </p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/projects/show.blade.php ENDPATH**/ ?>