<?php $__env->startSection('title', 'Jobs'); ?>
<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', ['second' => 'Jobs', 'third' => 'Index'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <?php echo $__env->make('admin.layouts.partials._page_header', [
        'title' => 'Jobs',
        'pTitle' => 'Job',
        'pSubtitle' => 'Create',
        'pSRoute' => route('jobs.create'),
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Job List</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('jobs.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Job
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Post By</th>
                        <th>View</th>
                        <th width="5%" class="text-center"><i class="fas fa-eye"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e('#' . ($key + 1 + ($jobs->currentPage() - 1) * $jobs->perPage())); ?></td>
                            <td><?php echo e($job->title); ?></td>
                            <td><?php echo e($job->category->title); ?></td>
                            <td><?php echo e($job->user->name); ?></td>
                            <td><?php echo e($job->views); ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" style="">
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(route('jobs.show', $job->id)); ?>">
                                                <i class="fas fa-eye me-1 text-info"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo e(route('jobs.edit', $job->id)); ?>">
                                                <i class="fas fa-edit me-1 text-primary"></i> Edit
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item job-status-update"
                                                data-id="<?php echo e($job->id); ?>" data-type="status"
                                                data-status="<?php echo e($job->status ? 0 : 1); ?>">
                                                <i
                                                    class="fas fa-<?php echo e($job->status ? 'times' : 'check'); ?> me-1 text-warning"></i>
                                                <?php echo e($job->status ? 'Unpublish' : 'Publish'); ?>

                                            </a>
                                        </li>
                                        <li>
                                            <form action="<?php echo e(route('jobs.destroy', $job->id)); ?>" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this job?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <span>No data found</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="mt-2"><?php echo e($jobs->links()); ?></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.job-status-update').forEach(button => {
                button.addEventListener('click', function() {
                    const jobId = this.getAttribute('data-id');
                    const type = this.getAttribute('data-type');
                    const status = this.getAttribute('data-status');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    fetch(`<?php echo e(route('jobs.update.status', ':id')); ?>`.replace(':id', jobId), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                type: type,
                                status: status
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                notifyToastr('success', 'Updated', data.message);
                                setTimeout(() => location.reload(), 2000);
                            } else {
                                notifyToastr('error', 'Failed', 'Update failed.');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            notifyToastr('error', 'Error', 'Something went wrong.');
                        });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/jobs/index.blade.php ENDPATH**/ ?>