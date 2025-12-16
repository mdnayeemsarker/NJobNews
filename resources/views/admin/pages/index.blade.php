@extends('admin.layouts.app')

@section('title', 'Pages')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'Pages', 'third' => 'Index'])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Pages',
        'pTitle' => 'Pages',
        'pSubtitle' => 'Create',
        'pSRoute' => route('pages.create'),
    ])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pages List</h3>
            <div class="card-tools">
                <a href="{{ route('pages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Page
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th width="5%">Status</th>
                        <th width="5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $key => $page)
                        <tr>
                            <td>{{ '#' . ($key + 1 + ($pages->currentPage() - 1) * $pages->perPage()) }}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $page->id }}"
                                        {{ $page->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('pages.show', $page->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <span>No pages found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">{{ $pages->links() }}</div>
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
            document.querySelectorAll('.toggle-status').forEach(button => {
                button.addEventListener('click', function() {
                    const pageId = this.getAttribute('data-id');
                    const newStatus = this.checked ? 1 : 0;
                    const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfTokenElement) {
                        console.error('CSRF token meta tag not found!');
                        return;
                    }
                    const csrfToken = csrfTokenElement.getAttribute('content');
                    const toggleStatusUrl = `{{ route('page.update.status', ':id') }}`.replace(':id', pageId);
                    fetch(toggleStatusUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            notifyToastr('success', 'Status Updated',
                                'The page status has been updated successfully.');
                        } else {
                            notifyToastr('error', 'Update Failed',
                                'Failed to update page status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        notifyToastr('error', 'Request Failed',
                            'An error occurred while updating the status.');
                    });
                });
            });
        });
    </script>
@endsection
