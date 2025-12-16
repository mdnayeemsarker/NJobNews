<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">Admin</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a target="_blank" href="<?php echo e(route('frontend.home')); ?>" class="nav-link">Home</a>
    </li>
    <?php if(isset($second)): ?>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php if(isset($sRoute)): ?><?php echo e($sRoute); ?> <?php else: ?> # <?php endif; ?>" class="nav-link"><?php echo e(__($second)); ?></a>
        </li>
    <?php endif; ?>
    <?php if(isset($third)): ?>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php if(isset($tRoute)): ?><?php echo e($tRoute); ?> <?php else: ?> # <?php endif; ?>" class="nav-link"><?php echo e(__($third)); ?></a>
        </li>
    <?php endif; ?>
</ul>
<?php /**PATH /var/www/html/Njobs/resources/views/admin/layouts/partials/_left_nuv_bar.blade.php ENDPATH**/ ?>