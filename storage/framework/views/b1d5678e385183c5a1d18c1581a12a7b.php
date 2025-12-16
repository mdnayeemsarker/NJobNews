<?php $__env->startSection('title', 'Pages'); ?>
<?php $__env->startSection('nav_left'); ?>
    <?php echo $__env->make('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Pages',
        'sRoute' => route('pages.index'),
        'third' => 'Show',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Page Details</h3>
        </div>
        <div class="card-body">
            
            <div class="form-group row">
                <label class="col-lg-4">Title:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext"><?php echo e($page->title); ?></p>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-lg-4">Slug:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext"><?php echo e($page->slug); ?></p>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-lg-4">Content:</label>
                <div class="col-lg-8">
                    <div class="border p-2 rounded bg-light">
                        <?php echo $page->content; ?>

                    </div>
                </div>
            </div>

            
            <div class="form-group row">
                <label class="col-lg-4">Status:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">
                        <?php echo e($page->status ? 'Active' : 'Inactive'); ?>

                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="<?php echo e(route('pages.edit', $page->id)); ?>" class="btn btn-warning">Edit</a>
            <a href="<?php echo e(route('pages.index')); ?>" class="btn btn-secondary">Back to List</a>
            <form action="<?php echo e(route('pages.destroy', $page->id)); ?>" method="POST" style="display: inline-block;"
                onsubmit="return confirm('Are you sure you want to delete this page?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Njobs/resources/views/admin/pages/show.blade.php ENDPATH**/ ?>