

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Create project')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e(Form::open(array('url' => 'projects', 'class'=>'w-100'))); ?>

        <div class="row mt-4">
            <div class="col-12">
                <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('name', __('Name'),['class'=>'form-control-label'])); ?>


                                    <?php echo e(Form::text('name', '', array('class' => 'form-control', 'required'=>'required'))); ?>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('customer_id', __('Customer'),['class'=>'form-control-label'])); ?>


                                    <?php echo e(Form::select('customer_id', $customers, null, array('class' => 'form-control','id'=>'customer', 'required'=>'required'))); ?>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('billing_type', __('Billing type'),['class'=>'form-control-label'])); ?>


                                    <?php echo e(Form::select('billing_type', $billing_type, null, array('class' => 'form-control','id'=>'billing_type', 'required'=>'required'))); ?>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('status', __('Status'),['class'=>'form-control-label'])); ?>


                                    <?php echo e(Form::select('status', $status, null, array('class' => 'form-control','id'=>'status'))); ?>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo e(Form::label('total_cost', __('Total cost'),['class'=>'form-control-label'])); ?>


                                    <?php echo e(Form::number('total_cost', '', array('class' => 'form-control', 'required'=>'required'))); ?>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('estimated_hours', __('Estimated hours'),['class'=>'form-control-label'])); ?>


                                    <?php echo e(Form::number('estimated_hours', '', array('class' => 'form-control', 'required'=>'required'))); ?>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('project_members', __('Project members'),['class'=>'form-control-label'])); ?>


                                    <?php echo e(Form::select('project_members[]', $members, null, array('multiple' => 'multiple', 'class' => 'select2 form-control','id'=>'project_members', 'required'=>'required'))); ?>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('date_start', __('Date start'),['class'=>'form-control-label'])); ?>


                                    <?php echo e(Form::text('date_start', '', array('class' => 'form-control datepicker', 'required'=>'required'))); ?>

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


                                    <?php echo e(Form::textarea('description', '', ['class' => 'form-control'])); ?>

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
        </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/projects/create.blade.php ENDPATH**/ ?>