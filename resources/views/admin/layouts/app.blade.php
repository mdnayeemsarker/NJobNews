<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') | NJobs Admin Dashboard</title>
    @include('admin.layouts.partials.asset._css')
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="wrapper">
        @include('admin.layouts.partials._nuv_bar')
        @include('admin.layouts.partials._sidebar')
        <div class="content-wrapper">
            @yield('page_header')
            <section class="content">
                <div class="container-fluid">
                    @yield('main_content')
                </div>
            </section>
        </div>

        @isset($selector)
            @include('admin.layouts.partials._select_modal')
        @endisset
        @isset($addModal)
            @include('admin.layouts.partials._add_modal')
        @endisset

        @include('admin.layouts.partials._footer')
    </div>
    @include('admin.layouts.partials.asset._script')
    @yield('script')
</body>

</html>
