@extends('admin.layouts.app')

@section('title', 'Ads')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Ads',
        'third' => 'Index',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Ads',
        'pTitle' => 'Ads',
        'pSubtitle' => 'Index',
        'pSRoute' => '#',
    ])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ads List</h3>
            <div class="card-tools {{ hasPermission('ads.create') ? '' : 'd-none' }}">
                <a href="{{ route('ads.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Ad
                </a>
            </div>
        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Location</th>
                        <th>Thumbnail</th>
                        <th>Link</th>
                        <th>Size</th>
                        <th width="8%">Status</th>
                        <th width="10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ads as $key => $ad)
                        <tr>
                            <td>{{ '#' . ($key + 1 + ($ads->currentPage() - 1) * $ads->perPage()) }}</td>
                            <td>{{ $ad->location }}</td>
                            <td>
                                @if ($ad->thumb)
                                    <img src="{{ get_file_url($ad->thumb) }}" alt="Ad Image"
                                        class="img-thumbnail" style="width: 50px; height: 50px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                @if ($ad->link)
                                    <a href="{{ $ad->link }}" target="_blank" class="text-primary">
                                        {{ Str::limit($ad->link, 30) }}
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $ad->width && $ad->height ? "{$ad->width} × {$ad->height}" : '—' }}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-id="{{ $ad->id }}"
                                        {{ $ad->status ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-info btn-sm {{ hasPermission('ads.show') ? '' : 'd-none' }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-warning btn-sm {{ hasPermission('ads.edit') ? '' : 'd-none' }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No ads found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">{{ $ads->links() }}</div>
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
                    const adId = this.getAttribute('data-id');
                    const newStatus = this.checked ? 1 : 0;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const toggleStatusUrl = `{{ route('ad.update.status', ':id') }}`.replace(':id', adId);

                    fetch(toggleStatusUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ status: newStatus })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            notifyToastr('success', 'Status Updated', 'Ad status updated successfully.');
                        } else {
                            notifyToastr('error', 'Update Failed', 'Failed to update ad status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        notifyToastr('error', 'Request Failed', 'Error updating ad status.');
                    });
                });
            });
        });
    </script>
@endsection
