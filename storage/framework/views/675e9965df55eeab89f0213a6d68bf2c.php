<?php $__env->startSection('title', 'Ads'); ?>

<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Ads',
        'third' => 'Index',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_header'); ?>
    <?php echo $__env->make('admin.layouts.partials._page_header', [
        'title' => 'Ads',
        'pTitle' => 'Ads',
        'pSubtitle' => 'Index',
        'pSRoute' => '#',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ads List</h3>
            <div class="card-tools <?php echo e(hasPermission('ads.create') ? '' : 'd-none'); ?>">
                <a href="<?php echo e(route('ads.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Ad
                </a>
            </div>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Location</th>
                        <th>Thumbnail</th>
                        <th>Link</th>
                        <th>Size</th>
                        <th width="8%">Status</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e('#' . ($key + 1 + ($ads->currentPage() - 1) * $ads->perPage())); ?></td>
                            <td><?php echo e($ad->location); ?></td>
                            <td>
                                <?php if($ad->thumb): ?>
                                    <img src="<?php echo e(get_file_url($ad->thumb)); ?>" alt="Ad Image"
                                        class="img-thumbnail" style="width: 50px; height: 50px;">
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($ad->link): ?>
                                    <a href="<?php echo e($ad->link); ?>" target="_blank" class="text-primary">
                                        <?php echo e(Str::limit($ad->link, 30)); ?>

                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($ad->width && $ad->height ? "{$ad->width} × {$ad->height}" : '—'); ?></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="<?php echo e($ad->id); ?>"
                                        <?php echo e($ad->status ? 'checked' : ''); ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="<?php echo e(route('ads.show', $ad->id)); ?>" class="btn btn-info btn-sm <?php echo e(hasPermission('ads.show') ? '' : 'd-none'); ?>">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('ads.edit', $ad->id)); ?>" class="btn btn-warning btn-sm <?php echo e(hasPermission('ads.edit') ? '' : 'd-none'); ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No ads found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="mt-2"><?php echo e($ads->links()); ?></div>
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
                    const adId = this.getAttribute('data-id');
                    const newStatus = this.checked ? 1 : 0;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const toggleStatusUrl = `<?php echo e(route('ad.update.status', ':id')); ?>`.replace(':id', adId);

                    fetch(toggleStatusUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ status: newStatus })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            notifyToastr('success', 'Status Updated', 'Ad status updated successfully.');
                        } else {
                            notifyToastr('error', 'Update Failed', 'Failed to update ad status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        notifyToastr('error', 'Request Failed', 'Error updating ad status.');
                    });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/ads/index.blade.php ENDPATH**/ ?>