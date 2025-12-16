<?php $__env->startSection('title', 'Category'); ?>
<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', ['second' => 'Category', 'sRoute' => route('categories.index'), 'third' => 'Show'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Category Details</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-lg-4">Name:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext"><?php echo e($category->title); ?></p>
                </div>
            </div>

            <div class="form-group row">
                <label for="image_url" class="col-lg-4">Image:</label>
                <div class="col-lg-8">
                    <?php if($category->image_url): ?>
                        <img src="<?php echo e(get_file_url($category->image_url)); ?>" alt="Category Image" class="img-thumbnail" style="max-width: 100px;">
                    <?php else: ?>
                        <p>No image uploaded.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="in_order" class="col-lg-4">In Order:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext"><?php echo e($category->in_order); ?></p>
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-lg-4">Status:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext"><?php echo e($category->status == 1 ? 'Active' : 'Inactive'); ?></p>
                </div>
            </div>

            <div class="form-group row">
                <label for="meta_title" class="col-lg-4">Meta Title:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext"><?php echo e($category->meta_title ?? 'not set'); ?></p>
                </div>
            </div>

            <div class="form-group row">
                <label for="meta_tag" class="col-lg-4">Meta Tag:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext"><?php echo e($category->meta_tag ?? 'not set'); ?></p>
                </div>
            </div>

            <div class="form-group row">
                <label for="meta_description" class="col-lg-4">Meta Description:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext"><?php echo e($category->meta_description ?? 'not set'); ?></p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="<?php echo e(route('categories.edit', $category->id)); ?>" class="btn btn-warning">Edit</a>
            <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-secondary">Back to List</a>
            <form action="<?php echo e(route('categories.destroy', $category->id)); ?>" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/categories/show.blade.php ENDPATH**/ ?>