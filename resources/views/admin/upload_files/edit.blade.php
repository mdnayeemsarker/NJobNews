@extends('layouts.app')
@section('title', 'All Uploaded Files')
@section('main')
    <div class="d-xl-flex">
        <div class="w-100">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('upload.update') }}" method="POST" class="ajax-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $upload->id }}">
                        <div class="row mb-2">
                            <div class="row gy-3">
                                <div class="col-lg-4">
                                    <label class="fw-semibold" for="type_select">{{ __('Select File Type') }}</label>
                                    <select class="form-select" name="type_select" id="type_select">
                                        <option value="not">{{ __('Select') }}</option>
                                        @php
                                            $fileTypes = json_decode(get_setting('file_type_names'), true);
                                        @endphp
                                        @foreach ($fileTypes as $fileType)
                                            <option @selected($upload->type === $fileType) value="{{ $fileType }}">
                                                {{ ucfirst(str_replace('_', ' ', $fileType)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="col-lg-4">
                                    <label class="fw-semibold" for="type_input">{{ __('File Type') }}</label>
                                    <input type="text" id="type_input" name="type_input" class="form-control"
                                        value="{{ ucfirst(str_replace('_', ' ', $upload->type)) }}" />
                                </div>
                                
                                <div class="form-group col-lg-4">
                                    <label class="fw-semibold" for="mode">{{ __('File Mode') }}</label>
                                    <select class="form-select" name="mode" id="mode">
                                        <option @selected($upload->type === '1') value="1">Public</option>
                                        <option @selected($upload->type === '0') value="0">Private</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row col-lg-12 gy-3">
                                <div class="col-lg-6">
                                    <img src="{{ get_file_url($upload->id) }}" class="img-fluid rounded mb-2" style="height: 120px; object-fit: cover;">
                                </div>
                                <div class="col-lg-6">
                                    <label for="file-upload" class="custom-file-upload btn btn-primary">
                                        Choose File
                                    </label>
                                    <input type="file" name="file" id="file-upload" accept=".jpg,.jpeg,.png,.pdf,.mp4" style="display: none;" onchange="displayFileDetails()">
                                    <span id="file-name" class="file-name"></span>
                                    <div id="image-preview" class="image-preview" style="margin-top: 10px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0"></h5>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-upload me-1"></i> {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('.ajax-form').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    alert('File uploaded successfully.');
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while uploading the file.');
                }
            });
        });
    });
    function displayFileDetails() {
        const fileInput = document.getElementById('file-upload');
        const fileNameDisplay = document.getElementById('file-name');
        const imagePreview = document.getElementById('image-preview');
        const file = fileInput.files[0];
        fileNameDisplay.textContent = file ? file.name : 'No file chosen';
        imagePreview.innerHTML = '';
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Image Preview';
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
                imagePreview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
@section('css')
<style>
    .custom-file-upload {
        display: inline-block;
        padding: 8px 12px;
        cursor: pointer;
    }
    .file-name {
        display: inline-block;
        margin-left: 10px;
        font-style: italic;
    }
    .image-preview img {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        padding: 5px;
        margin-top: 5px;
    }
</style>
@endsection