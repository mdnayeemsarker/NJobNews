<?php $__env->startSection('title', 'Pages'); ?>
<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', ['second' => 'Pages', 'third' => 'Index'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <?php echo $__env->make('admin.layouts.partials._page_header', [
        'title' => 'Pages',
        'pTitle' => 'Pages',
        'pSubtitle' => 'Create',
        'pSRoute' => route('pages.create'),
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pages List</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('pages.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Page
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th width="5%">Status</th>
                        <th width="5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e('#' . ($key + 1 + ($pages->currentPage() - 1) * $pages->perPage())); ?></td>
                            <td><?php echo e($page->title); ?></td>
                            <td><?php echo e($page->slug); ?></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="<?php echo e($page->id); ?>"
                                        <?php echo e($page->status ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="<?php echo e(route('pages.show', $page->id)); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center">
                                <span>No pages found</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="mt-2"><?php echo e($pages->links()); ?></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #4caf50;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-status').forEach(button => {
                button.addEventListener('click', function() {
                    const pageId = this.getAttribute('data-id');
                    const newStatus = this.checked ? 1 : 0;
                    const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfTokenElement) {
                        console.error('CSRF token meta tag not found!');
                        return;
                    }
                    const csrfToken = csrfTokenElement.getAttribute('content');
                    const toggleStatusUrl = `<?php echo e(route('page.update.status', ':id')); ?>`.replace(':id', pageId);
                    fetch(toggleStatusUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            notifyToastr('success', 'Status Updated',
                                'The page status has been updated successfully.');
                        } else {
                            notifyToastr('error', 'Update Failed',
                                'Failed to update page status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        notifyToastr('error', 'Request Failed',
                            'An error occurred while updating the status.');
                    });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/pages/index.blade.php ENDPATH**/ ?>