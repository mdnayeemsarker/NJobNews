@extends('admin.layouts.app')
@section('title', 'Post')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'post', 'sRoute' => route('posts.index'), 'third' => 'Show'])
@endsection
@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Post',
        'pTitle' => 'Post',
        'pSubtitle' => 'Index',
        'pSRoute' => route('posts.index'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Post Details</h3>
        </div>
        <div class="card bg-gradient-info">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-th mr-1"></i>
                    Post View Statistics, Total View {{ $totalView }}
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
                        <input type="text" class="knob" data-readonly="true" value="{{ $todayPercent }}"
                            data-width="100" data-height="100" data-fgColor="#39CCCC">

                        <div class="text-white">Today's {{ $todayView }}</div>
                    </div>
                    <!-- Last 7 Days View Knob -->
                    <div class="col-4 text-center">
                        <input type="text" class="knob" data-readonly="true" value="{{ $last7DaysPercent }}"
                            data-width="100" data-height="100" data-fgColor="#39CCCC">

                        <div class="text-white">Last 7 Days {{ $last7DaysView }}</div>
                    </div>
                    <!-- Last 15 Days View Knob -->
                    <div class="col-4 text-center">
                        <input type="text" class="knob" data-readonly="true" value="{{ $last15DaysPercent }}"
                            data-width="100" data-height="100" data-fgColor="#39CCCC">

                        <div class="text-white">Last 15 Days {{ $last15DaysView }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="title" class="col-lg-4">Title:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{!! $post->combineTitle() !!}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-lg-4">Category:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $post->category->title }}</p>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-lg-4">Status:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $post->status == 1 ? 'Active' : 'Inactive' }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning mr-2">Edit</a>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary mr-2">Back to List</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
@endsection