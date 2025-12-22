@extends('admin.layouts.app')

@section('title', 'Jobs')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'Jobs', 'third' => 'Index'])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Jobs',
        'pTitle' => 'Job',
        'pSubtitle' => 'Create',
        'pSRoute' => route('jobs.create'),
    ])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Job List</h3>
            <div class="card-tools">
                <a href="{{ route('jobs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Job
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Post By</th>
                        <th>View</th>
                        <th>Status</th>
                        <th width="5%" class="text-center"><i class="fas fa-eye"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $key => $job)
                        <tr>
                            <td>{{ '#' . ($key + 1 + ($jobs->currentPage() - 1) * $jobs->perPage()) }}</td>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->category->title }}</td>
                            <td>{{ $job->user->name }}</td>
                            <td>{{ $job->views }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $job->id }}" data-type="status"
                                        {{ $job->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" style="">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('jobs.show', $job->id) }}">
                                                <i class="fas fa-eye me-1 text-info"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('jobs.edit', $job->id) }}">
                                                <i class="fas fa-edit me-1 text-primary"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this job?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <span>No data found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">{{ $jobs->links() }}</div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #4caf50;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }
    </style>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-status').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const jobId = this.getAttribute('data-id');
                const type = this.getAttribute('data-type');
                const newStatus = this.checked ? 1 : 0;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const toggleUrl = `{{ route('jobs.update.status', ':id') }}`.replace(':id', jobId);
                
                fetch(toggleUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        status: newStatus,
                        type: type
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        notifyToastr('success', 'Updated', data.message);
                    } else {
                        notifyToastr('error', 'Failed', data.message || 'Update failed.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    notifyToastr('error', 'Error', 'Something went wrong.');
                });
            });
        });
    });
</script>
@endsection