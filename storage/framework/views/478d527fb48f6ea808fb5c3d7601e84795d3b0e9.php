<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Create contract')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php echo e(Form::open(array('url' => 'contracts', 'class'=>'w-100'))); ?>

        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('customer_id', __('Customer'),['class'=>'form-control-label'])); ?>


                                <?php echo e(Form::select('customer_id', $customers, null, array('class' => 'form-control select2','id'=>'customer', 'required'=>'required'))); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('project_id', __('Project'),['class'=>'form-control-label'])); ?>


                                <?php echo e(Form::select('project_id', $projects, null, array('class' => 'form-control select2','id'=>'project', 'required'=>'required'))); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('theme', __('Theme'),['class'=>'form-control-label'])); ?>


                                <?php echo e(Form::text('theme', '', array('class' => 'form-control', 'required'=>'required'))); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('amount', __('Contract amount'),['class'=>'form-control-label'])); ?>


                                <?php echo e(Form::number('amount', '', array('class' => 'form-control'))); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('type', __('Contract type'),['class'=>'form-control-label'])); ?>


                                <?php echo e(Form::select('type', ['' => '', 'Criative Digital' => 'Criative Digital', 'Página web' => 'Página web'], null, array('class' => 'form-control', 'id'=>'customer', 'required'=>'required'))); ?>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('date_start', __('Date start'),['class'=>'form-control-label'])); ?>


                                <?php echo e(Form::text('date_start', '', array('class' => 'form-control datepicker'))); ?>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('date_end', __('Date end'),['class'=>'form-control-label'])); ?>


                                <?php echo e(Form::text('date_end', '', array('class' => 'form-control datepicker'))); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo e(Form::label('description', __('Description'),['class'=>'form-control-label'])); ?>


                                <?php echo e(Form::textarea('description', '', array('class' => 'form-control'))); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 text-right">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create btn-xs badge-blue radius-10px">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("contracts.index")); ?>';" class="btn-create btn-xs bg-gray radius-10px">
        </div>

        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/contracts/create.blade.php ENDPATH**/ ?>