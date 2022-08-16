<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Contracts')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create customer')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="/contracts/create"class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="row p-4">
                        <div class="col-3">
                            <div class="card card-box">
                                <?php echo e(__('Active') . ': ' . $active); ?>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box text-primary">
                                <?php echo e(__('Expired') . ': ' . $expired); ?>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box">
                                <?php echo e(__('About to expire') . ': ' . $about_to_expire); ?>

                            </div>
                        </div>

                        <div class="col-3">
                            <div class="card card-box text-success">
                                <?php echo e(__('Recently added') . ': ' . $recently_added); ?>

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Theme')); ?></th>
                                <th><?php echo e(__('Customer')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Date start')); ?></th>
                                <th><?php echo e(__('Date end')); ?></th>
                                <th><?php echo e(__('Project')); ?></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($contract->theme); ?></td>
                                        <td><?php echo e($contract->customer->name); ?></td>
                                        <td><?php echo e($contract->type); ?></td>
                                        <td><?php echo e($contract->amount); ?></td>
                                        <td><?php echo e($contract->date_start); ?></td>
                                        <td><?php echo e($contract->date_end); ?></td>
                                        <td><?php echo e($contract->project->name); ?></td>
                                        <td nowrap>
                                            <a href="<?php echo e(route('contracts.show', $contract->id)); ?>" class="edit-icon bg-success">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="<?php echo e(route('contracts.edit', $contract->id)); ?>" class="edit-icon">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($contract->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['contracts.destroy', $contract->id],'id'=>'delete-form-'.$contract->id]); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/contracts/index.blade.php ENDPATH**/ ?>