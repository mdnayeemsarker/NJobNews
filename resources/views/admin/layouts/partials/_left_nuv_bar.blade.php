<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a target="_blank" href="{{ route('frontend.home') }}" class="nav-link">Home</a>
    </li>
    @isset($second)
        <li class="nav-item d-none d-sm-inline-block">
            <a href="@isset($sRoute){{ $sRoute }} @else # @endisset" class="nav-link">{{ __($second) }}</a>
        </li>
    @endisset
    @isset($third)
        <li class="nav-item d-none d-sm-inline-block">
            <a href="@isset($tRoute){{ $tRoute }} @else # @endisset" class="nav-link">{{ __($third) }}</a>
        </li>
    @endisset
</ul>
