

<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Projects')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create customer')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="/projects/create"class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-2">
            <div class="card card-box">
                <a href="?status=Not started">
                    <?php echo e(__('Not started') . ': ' . $projectsWidget->where('status', 'Not started')->count()); ?>

                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="card card-box">
                <a href="?status=Developing" class="text-primary">
                    <?php echo e(__('Developing') . ': ' . $projectsWidget->where('status', 'Developing')->count()); ?>

                </a>
            </div>
        </div>

        <div class="col-2">
            <div class="card card-box">
                <a href="?status=On holding" class="text-danger">
                    <?php echo e(__('On holding') . ': ' . $projectsWidget->where('status', 'On holding')->count()); ?>

                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="card card-box">
                <a href="?status=Finalized" class="text-success">
                    <?php echo e(__('Finalized') . ': ' . $projectsWidget->where('status', 'Finalized')->count()); ?>

                </a>
            </div>
        </div>

        <div class="col-2">
            <div class="card card-box">
                <a href="?status=Cancelled">
                    <?php echo e(__('Cancelled') . ': ' . $projectsWidget->where('status', 'Cancelled')->count()); ?>

                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Customer')); ?></th>
                                <th> <?php echo e(__('Date start')); ?></th>
                                <th> <?php echo e(__('Date end')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($loop->iteration); ?> </td>
                                        <td> <?php echo e($project->name); ?> </td>
                                        <td> <?php echo e($project->customer->name); ?> </td>
                                        <td> <?php echo e($project->date_start); ?> </td>
                                        <td> <?php echo e($project->date_end); ?> </td>
                                        <td> <?php echo e(__($project->status)); ?> </td>
                                        <td>
                                            <a href="<?php echo e(route('projects.show', $project->id)); ?>" class="edit-icon bg-success">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="<?php echo e(route('projects.edit', $project->id)); ?>" class="edit-icon">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($project->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.destroy', $project->id],'id'=>'delete-form-'.$project->id]); ?>

                                            <?php echo Form::close(); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/projects/index.blade.php ENDPATH**/ ?>