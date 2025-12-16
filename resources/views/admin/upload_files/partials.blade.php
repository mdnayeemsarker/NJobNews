@foreach ($uploads as $upload)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-1 file-card" data-id="{{ $upload['id'] }}">
        <div class="shadow-sm p-1 rounded position-relative">
            <div class="position-absolute top-0 end-0 p-1">
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                        id="fileMenu{{ $upload['id'] }}" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="fileMenu{{ $upload['id'] }}">
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('upload.edit', $upload['id']) }}">
                                <i class="fas fa-edit me-1"></i> {{ __('Edit') }}
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('upload.delete', $upload['id']) }}"
                                method="POST"
                                onsubmit="return confirm('{{ __('Are you sure you want to delete this file?') }}');">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item text-danger" type="submit">
                                    <i class="fas fa-trash-alt me-1"></i> {{ __('Delete') }}
                                </button>
                            </form>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ $upload['file_url'] }}" target="_blank">
                                <i class="fas fa-eye me-1"></i> {{ __('View') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" download href="{{ $upload['file_url'] }}">
                                <i class="fas fa-download me-1"></i> {{ __('Download') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="file-preview text-center mb-2"
                style="height: 120px; background-color: #f5f5f5; border: 1px solid #ddd;">
                @if (Str::startsWith($upload['mime_type'], 'image/'))
                    <img src="{{ $upload['file_url'] }}" class="img-fluid rounded mb-2" style="height: 120px; object-fit: cover;">
                @elseif (Str::startsWith($upload['mime_type'], 'video/'))
                    <video class="img-fluid rounded mb-2" style="height: 120px;" controls>
                        <source src="{{ $upload['file_url'] }}" type="{{ $upload['mime_type'] }}">
                    </video>
                @elseif ($upload['mime_type'] === 'application/pdf')
                    <div class="pdf-preview text-center mb-2"
                        style="height: 120px; background-color: #f5f5f5; border: 1px solid #ddd;">
                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                    </div>
                @else
                    <div class="file-preview text-center mb-2"
                        style="height: 120px; background-color: #f5f5f5; border: 1px solid #ddd;">
                        <i class="fas fa-file fa-3x text-primary"></i>
                    </div>
                @endif
            </div>
            <h6 class="text-truncate">{{ $upload['original_name'] }}</h6>
            <div class="d-flex justify-content-between mt-2">
                <small class="text-muted">{{ $upload['uploaded_at'] }}</small>
                @if ($upload['is_your'])
                    <span class="badge bg-success">{{ __('Private') }}</span>
                @else
                    <span class="badge bg-info">{{ __('Public') }}</span>
                @endif
            </div>
        </div>
    </div>
@endforeach