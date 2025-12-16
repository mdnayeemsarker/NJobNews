<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link text-center">
        <span class="elevation-3" style="opacity: .8"><?php echo e(get_setting('site_name')); ?></span>
    </a>
    <div class="sidebar">
        <div class="form-inline mt-3 mb-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item <?php echo e(hasPermission('admin.dashboard') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                        class="nav-link <?php if(request()->routeIs('admin.dashboard')): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('uploads') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('upload.index')); ?>"
                        class="nav-link <?php if(request()->routeIs('upload.index')): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Uploads</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('jobs') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('jobs.index')); ?>"
                        class="nav-link <?php if(request()->routeIs(config('menu.jobs_all'))): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Jobs</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('pages') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('pages.index')); ?>"
                        class="nav-link <?php if(request()->routeIs(config('menu.page_active'))): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Pages</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('ads') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('ads.index')); ?>"
                        class="nav-link <?php if(request()->routeIs(config('menu.ad_active'))): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Ads</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('user.manage') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('user.manage')); ?>"
                        class="nav-link <?php if(request()->routeIs('user.manage')): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>User Manage</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('categories') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('categories.index')); ?>"
                        class="nav-link <?php if(request()->routeIs(config('menu.cat_active'))): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('roles') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('roles.index')); ?>"
                        class="nav-link <?php if(request()->routeIs(config('menu.roles_active'))): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Role & Permission</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('track.visitor') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('track.visitor')); ?>"
                        class="nav-link <?php if(request()->routeIs('track.visitor')): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Track Visitor</p>
                    </a>
                </li>
                <li class="nav-item <?php echo e(hasPermission('admin.setting') ? '' : 'd-none'); ?>">
                    <a href="<?php echo e(route('admin.setting')); ?>"
                        class="nav-link <?php if(request()->routeIs('admin.setting')): ?> active <?php endif; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Setting</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<?php /**PATH /var/www/html/Njobs/resources/views/admin/layouts/partials/_sidebar.blade.php ENDPATH**/ ?>