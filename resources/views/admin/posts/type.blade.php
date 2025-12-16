@extends('admin.layouts.app')

@section('title', 'Slider Post')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'Post', 'third' => 'Slider'])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Post',
        'pTitle' => 'Post',
        'pSubtitle' => 'Create',
        'pSRoute' => route('posts.create'),
    ])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ Str::title($type) }} Posts List</h3>
            <div class="card-tools">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add post
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Post</th>
                        <th>Category</th>
                        <th>Post By</th>
                        <th>View</th>
                        <th>Visibility</th>
                        <th width="5%">Status</th>
                        <th width="5%" class="text-center"><i class="fas fa-eye"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $key => $post)
                        <tr>
                            <td>{{ '#' . ($key + 1 + ($posts->currentPage() - 1) * $posts->perPage()) }}</td>
                            <td>
                                @if ($post->thumb)
                                    <img src="{{ get_file_url($post->thumb) }}" alt="post Image"
                                        class="img-thumbnail" style="max-width: 50px;">
                                    {!! $post->combineTitle() !!}
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $post->category->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->view }}</td>
                            <td>
                                <span class="badge text-bg-primary {{ $post->is_slider ? '' : 'd-none' }}">Slider</span> <br>
                                <span class="badge text-bg-secondary {{ $post->is_breaking ? '' : 'd-none' }}">Breaking</span> <br>
                                <span class="badge text-bg-success {{ $post->is_featured ? '' : 'd-none' }}">Featured</span> <br>
                                <span class="badge text-bg-danger {{ $post->is_recommended ? '' : 'd-none' }}">Recommended</span>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $post->id }}" data-type="{{ $type }}"
                                        {{ $post->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <span>No data found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">{{ $posts->links() }}</div>
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
                    const postId = this.getAttribute('data-id');
                    const postType = this.getAttribute('data-type');
                    const newStatus = this.checked ? 1 : 0;
                    const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfTokenElement) {
                        console.error('CSRF token meta tag not found!');
                        return;
                    }
                    const csrfToken = csrfTokenElement.getAttribute('content');
                    const toggleStatusUrl = `{{ route('posts.update.status', ':id') }}`.replace(
                        ':id', postId);
                    fetch(toggleStatusUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'appli ion/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                status: newStatus,
                                type: postType
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                notifyToastr('success', 'Updated', data.message);
                            } else {
                                notifyToastr('error', 'Update Failed',
                                    'Failed to update post status.');
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
