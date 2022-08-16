<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Customer-Detail')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="<?php echo e(route('invoice.create',$customer->id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <?php echo e(__('Create Invoice')); ?>

                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create proposal')): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="<?php echo e(route('proposal.create',$customer->id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <?php echo e(__('Create Proposal')); ?>

                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit customer')): ?>
            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-size="2xl" data-url="<?php echo e(route('customer.edit',$customer['id'])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Customer')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete customer')): ?>
            <div class="col-xl-1 col-lg-2 col-md-2 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($customer['id']); ?>').submit();" class="btn btn-xs btn-white bg-danger btn-icon-only width-auto">
                        <i class="fa fa-trash"></i>
                    </a>
                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['customer.destroy', $customer['id']],'id'=>'delete-form-'.$customer['id']]); ?>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card pb-0 customer-detail-box">
                <h3 class="small-title"><?php echo e(__('Customer Info')); ?></h3>
                <div class="p-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['name']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['email']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['contact']); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card pb-0 customer-detail-box">
                <h3 class="small-title"><?php echo e(__('Billing Info')); ?></h3>
                <div class="p-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['billing_name']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['billing_phone']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['billing_address']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['billing_zip']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['billing_city'].', '. $customer['billing_state'] .', '.$customer['billing_country']); ?></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card pb-0 customer-detail-box">
                <h3 class="small-title"><?php echo e(__('Shipping Info')); ?></h3>
                <div class="p-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['shipping_name']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['shipping_phone']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['shipping_address']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['shipping_zip']); ?></h5>
                    <h5 class="report-text gray-text mb-0"><?php echo e($customer['shipping_city'].', '. $customer['billing_state'] .', '.$customer['billing_country']); ?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card pb-0">
                <h3 class="small-title"><?php echo e(__('Company Info')); ?></h3>
                <div class="row">
                    <?php
                        $totalInvoiceSum=$customer->customerTotalInvoiceSum($customer['id']);
                        $totalInvoice=$customer->customerTotalInvoice($customer['id']);
                        $averageSale=($totalInvoiceSum!=0)?$totalInvoiceSum/$totalInvoice:0;
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4">
                            <h5 class="report-text gray-text mb-0"><?php echo e(__('Customer Id')); ?></h5>
                            <h5 class="report-text mb-3"><?php echo e(AUth::user()->customerNumberFormat($customer['customer_id'])); ?></h5>
                            <h5 class="report-text gray-text mb-0"><?php echo e(__('Total Sum of Invoices')); ?></h5>
                            <h5 class="report-text mb-0"><?php echo e(\Auth::user()->priceFormat($totalInvoiceSum)); ?></h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4">
                            <h5 class="report-text gray-text mb-0"><?php echo e(__('Date of Creation')); ?></h5>
                            <h5 class="report-text mb-3"><?php echo e(\Auth::user()->dateFormat($customer['created_at'])); ?></h5>
                            <h5 class="report-text gray-text mb-0"><?php echo e(__('Quantity of Invoice')); ?></h5>
                            <h5 class="report-text mb-0"><?php echo e($totalInvoice); ?></h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4">
                            <h5 class="report-text gray-text mb-0"><?php echo e(__('Balance')); ?></h5>
                            <h5 class="report-text mb-3"><?php echo e(\Auth::user()->priceFormat($customer['balance'])); ?></h5>
                            <h5 class="report-text gray-text mb-0"><?php echo e(__('Average Sales')); ?></h5>
                            <h5 class="report-text mb-0"><?php echo e(\Auth::user()->priceFormat($averageSale)); ?></h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4">
                            <h5 class="report-text gray-text mb-0"><?php echo e(__('Overdue')); ?></h5>
                            <h5 class="report-text mb-3"><?php echo e(\Auth::user()->priceFormat($customer->customerOverdue($customer['id']))); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Proposal')); ?></h5>
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Proposal')); ?></th>
                                <th><?php echo e(__('Issue Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit proposal') || Gate::check('delete proposal') || Gate::check('show proposal')): ?>
                                    <th> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $customer->customerProposal($customer->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Id">
                                        <?php if(\Auth::guard('customer')->check()): ?>
                                            <a href="<?php echo e(route('customer.proposal.show',\Crypt::encrypt($proposal->id))); ?>"><?php echo e(AUth::user()->proposalNumberFormat($proposal->proposal_id)); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('proposal.show',\Crypt::encrypt($proposal->id))); ?>"><?php echo e(AUth::user()->proposalNumberFormat($proposal->proposal_id)); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(Auth::user()->dateFormat($proposal->issue_date)); ?></td>
                                    <td><?php echo e(Auth::user()->priceFormat($proposal->getTotal())); ?></td>
                                    <td>
                                        <?php if($proposal->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 1): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 3): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 4): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('edit proposal') || Gate::check('delete proposal') || Gate::check('show proposal')): ?>
                                        <td class="Action">
                                            <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert invoice')): ?>
                                                    <a href="#" class="edit-icon bg-yellow" data-toggle="tooltip" data-original-title="<?php echo e(__('Convert to Invoice')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="You want to confirm convert to invoice. Press Yes to continue or Cancel to go back" data-confirm-yes="document.getElementById('proposal-form-<?php echo e($proposal->id); ?>').submit();">
                                                    <i class="fas fa-exchange-alt"></i>
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['proposal.convert', $proposal->id],'id'=>'proposal-form-'.$proposal->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate proposal')): ?>
                                                    <a href="#" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="<?php echo e(__('Duplicate')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="You want to confirm duplicate this invoice. Press Yes to continue or Cancel to go back" data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($proposal->id); ?>').submit();">
                                                    <i class="fas fa-copy"></i>
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['proposal.duplicate', $proposal->id],'id'=>'duplicate-form-'.$proposal->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show proposal')): ?>
                                                    <?php if(\Auth::guard('customer')->check()): ?>
                                                        <a href="<?php echo e(route('customer.proposal.show',$proposal->id)); ?>" class="edit-icon bg-info" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('proposal.show',\Crypt::encrypt($proposal->id))); ?>" class="edit-icon bg-info" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit proposal')): ?>
                                                    <a href="<?php echo e(route('proposal.edit',\Crypt::encrypt($proposal->id))); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete proposal')): ?>
                                                    <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($proposal->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['proposal.destroy', $proposal->id],'id'=>'delete-form-'.$proposal->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Invoice')); ?></h5>
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Invoice')); ?></th>
                                <th><?php echo e(__('Issue Date')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Due Amount')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit invoice') || Gate::check('delete invoice') || Gate::check('show invoice')): ?>
                                    <th> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $customer->customerInvoice($customer->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Id">
                                        <?php if(\Auth::guard('customer')->check()): ?>
                                            <a href="<?php echo e(route('customer.invoice.show',\Crypt::encrypt($invoice->id))); ?>"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?>

                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('invoice.show',\Crypt::encrypt($invoice->id))); ?>"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?>

                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(\Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                    <td>
                                        <?php if(($invoice->due_date < date('Y-m-d'))): ?>
                                            <p class="text-danger"> <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?></p>
                                        <?php else: ?>
                                            <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(\Auth::user()->priceFormat($invoice->getDue())); ?></td>
                                    <td>
                                        <?php if($invoice->status == 0): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 1): ?>
                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 3): ?>
                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 4): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('edit invoice') || Gate::check('delete invoice') || Gate::check('show invoice')): ?>
                                        <td class="Action">
                                            <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate invoice')): ?>
                                                    <a href="#" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="<?php echo e(__('Duplicate')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="You want to confirm this action. Press Yes to continue or Cancel to go back" data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($invoice->id); ?>').submit();">
                                                    <i class="fas fa-copy"></i>
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['invoice.duplicate', $invoice->id],'id'=>'duplicate-form-'.$invoice->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show invoice')): ?>
                                                    <?php if(\Auth::guard('customer')->check()): ?>
                                                        <a href="<?php echo e(route('customer.invoice.show',\Crypt::encrypt($invoice->id))); ?>" class="edit-icon bg-info" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('invoice.show',\Crypt::encrypt($invoice->id))); ?>" class="edit-icon bg-info" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                                    <a href="<?php echo e(route('invoice.edit',\Crypt::encrypt($invoice->id))); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                                    <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($invoice->id); ?>').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $invoice->id],'id'=>'delete-form-'.$invoice->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/i9finance/public_html/resources/views/customer/show.blade.php ENDPATH**/ ?>