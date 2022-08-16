<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>


<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Files')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopPush(); ?>


<?php $__env->startPush('script-page'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.dropify').dropify();
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?php echo e("/projects/$project->id/files"); ?>" enctype="multipart/form-data">
                <input type="hidden" name="project_id" value="<?php echo e($project->id); ?>">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

                <input type="file" name="files[]" multiple class="dropify">

                <input type="submit" value="<?php echo e(__('Upload')); ?>" class="btn-create badge-blue">
            </form>

            <div class="card mt-4">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <th><?php echo e(__('Upload by')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $project->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($file->name); ?></td>
                                        <td><?php echo e($file->type); ?></td>
                                        <td><?php echo e($file->user->name); ?></td>
                                        <td><?php echo e($file->date_upload); ?></td>
                                        <td>
                                            <?php echo $__env->make('files.comments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                            <a href="<?php echo e("/projects/{$project->id}/files/{$file->id}/download"); ?>" class="edit-icon bg-success">
                                                <i class="fas fa-download"></i>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/files/index.blade.php ENDPATH**/ ?>