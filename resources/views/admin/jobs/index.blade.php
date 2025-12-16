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
                                        {{-- Status toggle --}}
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item job-status-update"
                                                data-id="{{ $job->id }}" data-type="status"
                                                data-status="{{ $job->status ? 0 : 1 }}">
                                                <i
                                                    class="fas fa-{{ $job->status ? 'times' : 'check' }} me-1 text-warning"></i>
                                                {{ $job->status ? 'Unpublish' : 'Publish' }}
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
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.job-status-update').forEach(button => {
                button.addEventListener('click', function() {
                    const jobId = this.getAttribute('data-id');
                    const type = this.getAttribute('data-type');
                    const status = this.getAttribute('data-status');
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');

                    fetch(`{{ route('jobs.update.status', ':id') }}`.replace(':id', jobId), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                type: type,
                                status: status
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                notifyToastr('success', 'Updated', data.message);
                                setTimeout(() => location.reload(), 2000);
                            } else {
                                notifyToastr('error', 'Failed', 'Update failed.');
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
