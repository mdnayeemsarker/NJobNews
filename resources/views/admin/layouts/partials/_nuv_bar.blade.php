<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    @yield('nav_left')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item d-none">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button 
                    type="submit" 
                    class="nav-link btn btn-danger btn-sm d-flex align-items-center text-white"
                    @click.prevent="$root.submit();"
                >
                    <i class="fas fa-sign-out-alt me-2"></i>
                    {{ __('Log Out') }}
                </button>
            </form>
        </li>
    </ul>
</nav>
