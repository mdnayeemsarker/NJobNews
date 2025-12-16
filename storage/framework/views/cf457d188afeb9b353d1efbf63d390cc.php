<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo $__env->yieldContent('title'); ?> | NJobs Admin Dashboard</title>
    <?php echo $__env->make('admin.layouts.partials.asset._css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <div class="wrapper">
        <?php echo $__env->make('admin.layouts.partials._nuv_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin.layouts.partials._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="content-wrapper">
            <?php echo $__env->yieldContent('page_header'); ?>
            <section class="content">
                <div class="container-fluid">
                    <?php echo $__env->yieldContent('main_content'); ?>
                </div>
            </section>
        </div>

        <?php if(isset($selector)): ?>
            <?php echo $__env->make('admin.layouts.partials._select_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if(isset($addModal)): ?>
            <?php echo $__env->make('admin.layouts.partials._add_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php echo $__env->make('admin.layouts.partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php echo $__env->make('admin.layouts.partials.asset._script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH /var/www/html/Njobs/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>