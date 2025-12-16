@extends('admin.layouts.app')

@section('title', 'Category')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'Category', 'third' => 'Index'])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Category',
        'pTitle' => 'Category',
        'pSubtitle' => 'Create',
        'pSRoute' => route('categories.create'),
    ])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories List</h3>
            <div class="card-tools">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Category
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th width="5%">Order</th>
                        <th width="5%">Home</th>
                        <th width="5%">Menu</th>
                        <th width="5%">Status</th>
                        <th width="5%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $key => $category)
                        <tr>
                            <td>{{ '#' . ($key + 1 + ($categories->currentPage() - 1) * $categories->perPage()) }}</td>
                            <td>{{ $category->title }}</td>
                            <td>
                                @if ($category->image_url)
                                    <img src="{{ get_file_url($category->image_url) }}" alt="Category Image"
                                        class="img-thumbnail" style="max-width: 50px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $category->in_order }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-home" data-id="{{ $category->id }}" data-type="home"
                                        {{ $category->is_home ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-menu" data-id="{{ $category->id }}" data-type="menu"
                                        {{ $category->is_menu ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $category->id }}" data-type="status"
                                        {{ $category->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
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
            <div class="mt-2">{{ $categories->links() }}</div>
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
        document.querySelectorAll('.toggle-home, .toggle-menu, .toggle-status').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const type = this.getAttribute('data-type');
                const newStatus = this.checked ? 1 : 0;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const toggleUrl = `{{ route('category.update.status', ':id') }}`.replace(':id', categoryId);
                
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
