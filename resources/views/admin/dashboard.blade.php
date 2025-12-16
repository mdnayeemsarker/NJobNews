@extends('admin.layouts.app')
@section('title', 'Admin')
@section('nav_left')@include('admin.layouts.partials._left_nuv_bar')@endsection
@section('page_header')@include('admin.layouts.partials._page_header', ['title' => 'Dashboard', 'pTitle' => 'Dashboard'])@endsection

@section('main_content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $jobStatistics['totalView'] }}</h3>

                    <p>Job</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $category }}</h3>

                    <p>Category</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ '0' }}</h3>

                    <p>Sub Category</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $visitorStatistics['totalView'] ?? 0 }}</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('track.visitor') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ '0' }}</h3>

                    <p>User</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('user.manage') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $category }}</h3>

                    <p>Category</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ '0' }}</h3>

                    <p>User</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('user.manage') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $visitorStatistics['totalView'] ?? 0 }}</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('track.visitor') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <section class="col-lg-7 connectedSortable">
            <div class="card bg-gradient-info">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-th mr-1"></i>
                        Job View Statistics, Total View {{ $jobStatistics['totalView'] }}
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="row">
                        <!-- Today's View Knob -->
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="{{ $jobStatistics['todayPercent'] }}"
                                data-width="100" data-height="100" data-fgColor="#39CCCC">

                            <div class="text-white">Today's {{ $jobStatistics['todayView'] }}</div>
                        </div>
                        <!-- Last 7 Days View Knob -->
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="{{ $jobStatistics['last7DaysPercent'] }}"
                                data-width="100" data-height="100" data-fgColor="#39CCCC">

                            <div class="text-white">Last 7 Days {{ $jobStatistics['last7DaysView'] }}</div>
                        </div>
                        <!-- Last 15 Days View Knob -->
                        <div class="col-4 text-center">
                            <input type="text" class="knob" data-readonly="true" value="{{ $jobStatistics['last15DaysPercent'] }}"
                                data-width="100" data-height="100" data-fgColor="#39CCCC">

                            <div class="text-white">Last 15 Days {{ $jobStatistics['last15DaysView'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
@endsection
