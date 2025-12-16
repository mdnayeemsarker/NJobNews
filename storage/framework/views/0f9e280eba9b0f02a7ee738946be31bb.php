<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo e($title); ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Admin</li>
                    <?php if(isset($pTitle)): ?>
                        <li class="breadcrumb-item"><?php echo e($pTitle); ?></li>
                    <?php endif; ?>
                    <?php if(isset($pSubtitle)): ?>
                        <li class="breadcrumb-item"> <a href="<?php echo e($pSRoute); ?>"><?php echo e($pSubtitle); ?></a> </li>
                    <?php endif; ?>
                </ol>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/html/Njobs/resources/views/admin/layouts/partials/_page_header.blade.php ENDPATH**/ ?>