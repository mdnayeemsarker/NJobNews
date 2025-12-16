@extends('admin.layouts.app')

@section('title', 'Job')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Jobs',
        'sRoute' => route('jobs.index'),
        'third' => 'Show'
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Job',
        'pTitle' => 'Job',
        'pSubtitle' => 'Edit',
        'pSRoute' => route('jobs.index', $job->id),
    ])
@endsection

@section('main_content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Job Details</h3>
    </div>

    {{-- View statistics --}}
    <div class="card bg-gradient-info">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-chart-line mr-1"></i>
                Job View Statistics, Total Views {{ $job->views }}
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
                <div class="col-4 text-center">
                    <input type="text" class="knob" value="{{ $todayView }}"
                        data-readonly="true" data-width="100"
                        data-height="100" data-fgColor="#39CCCC">
                    <div class="text-white">View</div>
                    <input type="text" class="knob" value="{{ $todayPercent }}"
                        data-readonly="true" data-width="100"
                        data-height="100" data-fgColor="#39CCCC">
                    <div class="text-white">Percent</div>
                    Today
                </div>
                <div class="col-4 text-center">
                    <input type="text" class="knob" value="{{ $last7DaysView }}"
                        data-readonly="true" data-width="100"
                        data-height="100" data-fgColor="#39CCCC">
                    <div class="text-white">View</div>
                    <input type="text" class="knob" value="{{ $last7DaysPercent }}"
                        data-readonly="true" data-width="100"
                        data-height="100" data-fgColor="#39CCCC">
                    <div class="text-white">View</div>
                    Last 7 Days
                </div>
                <div class="col-4 text-center">
                    <input type="text" class="knob" value="{{ $last15DaysView }}"
                        data-readonly="true" data-width="100"
                        data-height="100" data-fgColor="#39CCCC">
                    <div class="text-white">View</div>
                    <input type="text" class="knob" value="{{ $last15DaysPercent }}"
                        data-readonly="true" data-width="100"
                        data-height="100" data-fgColor="#39CCCC">
                    <div class="text-white">Percent</div>
                    Last 15 Days
                </div>
            </div>
        </div>
    </div>

    {{-- Job information --}}
    <div class="card-body">

        <div class="form-group row">
            <label class="col-lg-4">Title:</label>
            <div class="col-lg-8">
                <p class="form-control-plaintext">{{ $job->title }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4">Category:</label>
            <div class="col-lg-8">
                <p class="form-control-plaintext">
                    {{ $job->category->title ?? 'N/A' }}
                </p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4">Company:</label>
            <div class="col-lg-8">
                <p class="form-control-plaintext">{{ $job->company ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4">Vacancy:</label>
            <div class="col-lg-8">
                <p class="form-control-plaintext">{{ $job->vacancy ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4">Salary:</label>
            <div class="col-lg-8">
                <p class="form-control-plaintext">{{ $job->salary ?? 'Negotiable' }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4">Job Type:</label>
            <div class="col-lg-8">
                <p class="form-control-plaintext">{{ ucfirst($job->type) }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4">Gender:</label>
            <div class="col-lg-8">
                <p class="form-control-plaintext">{{ ucfirst($job->gender) }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4">Status:</label>
            <div class="col-lg-8">
                <span class="badge badge-{{ $job->status ? 'success' : 'danger' }}">
                    {{ $job->status ? 'Published' : 'Unpublished' }}
                </span>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4">Description:</label>
            <div class="col-lg-8">
                <div class="border p-2">
                    {!! $job->description !!}
                </div>
            </div>
        </div>

    </div>

    {{-- Footer actions --}}
    <div class="card-footer">
        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning mr-2">
            Edit
        </a>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary mr-2">
            Back to List
        </a>
        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
              style="display:inline-block"
              onsubmit="return confirm('Are you sure you want to delete this job?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        $('.knob').knob();
    });
</script>
@endsection
