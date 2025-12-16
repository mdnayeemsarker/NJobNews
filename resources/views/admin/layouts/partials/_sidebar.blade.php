<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <span class="elevation-3" style="opacity: .8">{{ get_setting('site_name') }}</span>
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
                <li class="nav-item {{ hasPermission('admin.dashboard') ? '' : 'd-none' }}">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (request()->routeIs('admin.dashboard')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('uploads') ? '' : 'd-none' }}">
                    <a href="{{ route('upload.index') }}"
                        class="nav-link @if (request()->routeIs('upload.index')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Uploads</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('jobs') ? '' : 'd-none' }}">
                    <a href="{{ route('jobs.index') }}"
                        class="nav-link @if (request()->routeIs(config('menu.jobs_all'))) active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Jobs</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('pages') ? '' : 'd-none' }}">
                    <a href="{{ route('pages.index') }}"
                        class="nav-link @if (request()->routeIs(config('menu.page_active'))) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Pages</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('ads') ? '' : 'd-none' }}">
                    <a href="{{ route('ads.index') }}"
                        class="nav-link @if (request()->routeIs(config('menu.ad_active'))) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Ads</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('user.manage') ? '' : 'd-none' }}">
                    <a href="{{ route('user.manage') }}"
                        class="nav-link @if (request()->routeIs('user.manage')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>User Manage</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('categories') ? '' : 'd-none' }}">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link @if (request()->routeIs(config('menu.cat_active'))) active @endif">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Categories</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('roles') ? '' : 'd-none' }}">
                    <a href="{{ route('roles.index') }}"
                        class="nav-link @if (request()->routeIs(config('menu.roles_active'))) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Role & Permission</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('track.visitor') ? '' : 'd-none' }}">
                    <a href="{{ route('track.visitor') }}"
                        class="nav-link @if (request()->routeIs('track.visitor')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Track Visitor</p>
                    </a>
                </li>
                <li class="nav-item {{ hasPermission('admin.setting') ? '' : 'd-none' }}">
                    <a href="{{ route('admin.setting') }}"
                        class="nav-link @if (request()->routeIs('admin.setting')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Setting</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
