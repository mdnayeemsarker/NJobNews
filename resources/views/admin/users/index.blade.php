@extends('admin.layouts.app')

@section('title', 'User')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'User', 'third' => 'Index'])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', ['title' => 'User', 'pTitle' => 'User Management'])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users List</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="5%">Status</th>
                        <th width="5%"><i class="fas fa-eye"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                        <tr>
                            <td>{{ '#' . ($key + 1 + ($users->currentPage() - 1) * $users->perPage()) }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->pluck('name')->join(', ') }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $user->id }}"
                                        {{ $user->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <span>No data found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">{{ $users->links() }}</div>
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
                    const userId = this.getAttribute('data-id');
                    const newStatus = this.checked ? 1 : 0;
                    const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfTokenElement) {
                        console.error('CSRF token meta tag not found!');
                        return;
                    }
                    const csrfToken = csrfTokenElement.getAttribute('content');
                    const toggleStatusUrl = `{{ route('user.update.status', ':id') }}`.replace(
                        ':id', userId);
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
                                    'The user status has been updated successfully.');
                            } else {
                                notifyToastr('error', 'Update Failed',
                                    'Failed to update user status.');
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
