@extends('admin.layouts.app')

@section('title', 'Post')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'Post', 'third' => 'Index'])
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
            <h3 class="card-title">Posts List</h3>
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
                        <th width="5%" class="text-center"><i class="fas fa-eye"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $key => $post)
                        <tr>
                            <td>{{ '#' . ($key + 1 + ($posts->currentPage() - 1) * $posts->perPage()) }}</td>
                            <td>
                                @if ($post->thumb)
                                    <div>
                                        <img src="{{ get_file_url($post->thumb) }}" alt="post Image"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        {!! $post->combineTitle() !!}
                                    </div>
                                    <span
                                        class="text-muted {{ $post->thumb_caption ? '' : 'd-none' }}">{{ $post->thumb_caption }}</span>
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $post->category->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->view }}</td>
                            <td>
                                <span class="badge text-bg-primary {{ $post->is_slider ? '' : 'd-none' }}">Slider, </span>
                                <span
                                    class="badge text-bg-secondary {{ $post->is_breaking ? '' : 'd-none' }}">Breaking, </span>
                                <span
                                    class="badge text-bg-success {{ $post->is_featured ? '' : 'd-none' }}">Featured, </span>
                                <span
                                    class="badge text-bg-danger {{ $post->is_recommended ? '' : 'd-none' }}">Recommended</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fas fa-wrench"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" style="">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('posts.show', $post->id) }}">
                                                <i class="fas fa-eye me-1 text-info"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">
                                                <i class="fas fa-edit me-1 text-primary"></i> Edit
                                            </a>
                                        </li>
                                        {{-- Status toggle --}}
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item post-status-update"
                                                data-id="{{ $post->id }}" data-type="status"
                                                data-status="{{ $post->status ? 0 : 1 }}">
                                                <i
                                                    class="fas fa-{{ $post->status ? 'times' : 'check' }} me-1 text-warning"></i>
                                                {{ $post->status ? 'Unpublish' : 'Publish' }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item post-status-update"
                                                data-id="{{ $post->id }}" data-type="slider"
                                                data-status="{{ $post->is_slider ? 0 : 1 }}">
                                                <i
                                                    class="fas fa-{{ $post->is_slider ? 'minus' : 'plus' }} me-1 text-primary"></i>
                                                {{ $post->is_slider ? 'Remove Slider' : 'Add to Slider' }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item post-status-update"
                                                data-id="{{ $post->id }}" data-type="featured"
                                                data-status="{{ $post->is_featured ? 0 : 1 }}">
                                                <i
                                                    class="fas fa-{{ $post->is_featured ? 'minus' : 'plus' }} me-1 text-success"></i>
                                                {{ $post->is_featured ? 'Remove Featured' : 'Add to Featured' }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item post-status-update"
                                                data-id="{{ $post->id }}" data-type="breaking"
                                                data-status="{{ $post->is_breaking ? 0 : 1 }}">
                                                <i
                                                    class="fas fa-{{ $post->is_breaking ? 'minus' : 'plus' }} me-1 text-danger"></i>
                                                {{ $post->is_breaking ? 'Remove Breaking' : 'Add to Breaking' }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item post-status-update"
                                                data-id="{{ $post->id }}" data-type="recommended"
                                                data-status="{{ $post->is_recommended ? 0 : 1 }}">
                                                <i
                                                    class="fas fa-{{ $post->is_recommended ? 'minus' : 'plus' }} me-1 text-info"></i>
                                                {{ $post->is_recommended ? 'Remove Recommended' : 'Add to Recommended' }}
                                            </a>
                                        </li>

                                        <li>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this post?');">
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
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.post-status-update').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');
            const status = this.getAttribute('data-status');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`{{ route('posts.update.status', ':id') }}`.replace(':id', postId), {
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