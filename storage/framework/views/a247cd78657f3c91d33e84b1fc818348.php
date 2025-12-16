<?php $__env->startSection('title', 'Category'); ?>
<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', ['second' => 'Category', 'third' => 'Index'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <?php echo $__env->make('admin.layouts.partials._page_header', [
        'title' => 'Category',
        'pTitle' => 'Category',
        'pSubtitle' => 'Create',
        'pSRoute' => route('categories.create'),
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories List</h3>
            <div class="card-tools">
                <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Category
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th width="5%">Order</th>
                        <th width="5%">Home</th>
                        <th width="5%">Menu</th>
                        <th width="5%">Status</th>
                        <th width="5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e('#' . ($key + 1 + ($categories->currentPage() - 1) * $categories->perPage())); ?></td>
                            <td><?php echo e($category->title); ?></td>
                            <td>
                                <?php if($category->image_url): ?>
                                    <img src="<?php echo e(get_file_url($category->image_url)); ?>" alt="Category Image"
                                        class="img-thumbnail" style="max-width: 50px;">
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($category->in_order); ?></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-home" data-id="<?php echo e($category->id); ?>" data-type="home"
                                        <?php echo e($category->is_home ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-menu" data-id="<?php echo e($category->id); ?>" data-type="menu"
                                        <?php echo e($category->is_menu ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="<?php echo e($category->id); ?>" data-type="status"
                                        <?php echo e($category->status ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="<?php echo e(route('categories.show', $category->id)); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
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
            <div class="mt-2"><?php echo e($categories->links()); ?></div>
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
        document.querySelectorAll('.toggle-home, .toggle-menu, .toggle-status').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const type = this.getAttribute('data-type');
                const newStatus = this.checked ? 1 : 0;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const toggleUrl = `<?php echo e(route('category.update.status', ':id')); ?>`.replace(':id', categoryId);
                
                fetch(toggleUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        status: newStatus,
                        type: type
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        notifyToastr('success', 'Updated', data.message);
                    } else {
                        notifyToastr('error', 'Failed', data.message || 'Update failed.');
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/categories/index.blade.php ENDPATH**/ ?>