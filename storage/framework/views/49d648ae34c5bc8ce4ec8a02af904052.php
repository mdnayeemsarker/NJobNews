<?php $__env->startSection('title', 'SMS Workers'); ?>

<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', [
        'second' => 'SMS',
        'third' => 'Workers',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <?php echo $__env->make('admin.layouts.partials._page_header', [
        'title' => 'SMS Workers',
        'pTitle' => 'SMS',
        'pSubtitle' => 'Worker List',
        'pSRoute' => '#',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SMS Worker List</h3>
            <div class="card-tools <?php echo e(hasPermission('sms-workers.create') ? '' : 'd-none'); ?>">
                <a href="<?php echo e(route('sms-workers.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add SMS
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Receiver</th>
                        <th>Message</th>
                        <th>Sender</th>
                        <th>Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $smsWorkers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>

                            <td><?php echo e($sms->receiver); ?></td>

                            <td>
                                <span title="<?php echo e($sms->body); ?>">
                                    <?php echo e(\Illuminate\Support\Str::limit($sms->body, 40)); ?>

                                </span>
                            </td>

                            <td><?php echo e($sms->sender ?? '—'); ?></td>

                            <td>
                                <span class="badge 
                                    <?php if($sms->status == 'create'): ?> badge-secondary
                                    <?php elseif($sms->status == 'sent'): ?> badge-info
                                    <?php elseif($sms->status == 'paid'): ?> badge-warning
                                    <?php elseif($sms->status == 'complete'): ?> badge-success
                                    <?php endif; ?>">
                                    <?php echo e(ucfirst($sms->status)); ?>

                                </span>
                            </td>

                            <td>
                                <a href="<?php echo e(route('sms-workers.show', $sms->id)); ?>"
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="<?php echo e(route('sms-workers.edit', $sms->id)); ?>"
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="<?php echo e(route('sms-workers.destroy', $sms->id)); ?>"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this record?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No SMS records found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="mt-3">
                <?php echo e($smsWorkers->links()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/sms_workers/index.blade.php ENDPATH**/ ?>