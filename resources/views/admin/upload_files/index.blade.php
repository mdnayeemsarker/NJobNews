@extends('admin.layouts.app')
@section('title', 'All Uploaded Files')
@section('main_content')
    <div class="d-xl-flex">
        <div class="w-100">
            <div class="card">
                <div class="card-body">
                    <form class="p-1 rounded shadow-sm bg-light" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="fileInput" class="mb-1">Select File:</label>
                            <div id="fileDropzone" class="dropzone mb-2">
                                <div class="dz-message">Drag & Drop files here or click to select</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-1 d-flex justify-content-between align-items-center">
                        <h5>{{ __('All Uploaded Files') }}</h5>
                        <div>
                            <div id="pagination-links"></div>
                        </div>
                    </div>
                    <div id="uploads-container" class="row"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* Hover effects */
        .file-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .file-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Smooth file previews */
        .file-preview img,
        .file-preview video {
            transition: transform 0.3s ease-in-out;
        }
        
        /* Dropdown animations */
        .dropdown-menu {
            transition: opacity 0.2s ease-in-out;
        }

        .file-item .card {
            cursor: pointer;
        }

        .file-item img {
            width: 100%;
            border-radius: 5px;
        }

        .file-item .card-title {
            font-size: 0.85rem;
            margin-bottom: 5px;
        }

        .file-selector-item:active {
            background-color: #e7f1ff;
        }

        .file-image-label {
            cursor: pointer;
        }

        .file-image-label img {
            transition: transform 0.3s ease;
        }

        .file-image-label:hover img {
            transform: scale(1.05);
        }

        .file-selector-container {
            display: flex;
            gap: 15px;
        }

        .file-selector-item {
            position: relative;
            width: 100%;
            cursor: pointer;
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            background-color: #f8f9fa;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .file-selector-item:hover {
            background-color: #e9ecef;
            border-color: #007bff;
        }

        .file-selector-item i {
            font-size: 25px;
            margin-bottom: 5px;
            color: #007bff;
        }

        .file-selector-item span {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        #fileDropzone {
            border: 2px dashed #007bff;
            border-radius: 10px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .dz-message {
            font-size: 16px;
            color: #007bff;
        }

        .dz-error-message {
            color: red;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.css" />
@endsection
    
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const maxFileSize = {{ $maxFileSizeInMB ?? 50 }};
        const fileUploadRoute = "{{ route('uploads.store.ajax') }}";

        const myDropzone = new Dropzone("#fileDropzone", {
            url: fileUploadRoute,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            paramName: "file",
            maxFilesize: maxFileSize,
            addRemoveLinks: true,
            acceptedFiles: "image/*,application/pdf",
            dictDefaultMessage: "Drag & Drop files here or click to select",
            dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
            dictInvalidFileType: "This file type is not allowed.",

            dictCancelUpload: "Cancel upload",
            dictRemoveFile: "Remove file",
            init: function() {
                this.on("addedfile", function(file) {});

                this.on("success", function(file, response) {
                    fetchFiles(1);
                    notifyToastr('success', 'File Upload', 'File uploaded successfully.');
                    this.removeAllFiles();
                });

                this.on("error", function(file, errorMessage) {
                    console.error("Error uploading file: " + errorMessage);
                });
            }
        });

        async function fetchFiles(page = 1) {
            try {
                const response = await fetch(`{{ route('uploads.index.ajax') }}?page=${page}`);

                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }

                const data = await response.json();
                const files = data.data;
                const fileGrid = document.getElementById('uploads-container');
                const paginationContainer = document.getElementById('pagination-links');

                fileGrid.innerHTML = '';
                paginationContainer.innerHTML = '';

                files.forEach(file => {
                    const fileCard = document.createElement('div');
                    fileCard.classList.add('col-xl-3', 'col-lg-4', 'col-md-6', 'col-sm-12', 'mb-3',
                        'file-card');
                    fileCard.dataset.id = file.id;
                    fileCard.innerHTML = `
                        <div class="position-absolute top-0 end-0 p-1">
                            <div class="dropdown">
                                <a href="#" class="btn btn-sm btn-light dropdown" type="button"
                                    id="fileMenu${file.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="fileMenu${file.id}">
                                    <li>
                                        <button class="dropdown-item text-danger delete-file" data-id="${file.id}">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </button>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="${file.file_url}" target="_blank">
                                            <i class="fas fa-eye me-1"></i> View
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" download href="${file.file_url}">
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="file-preview text-center mb-2" style="height: 120px; background-color: #f5f5f5; border: 1px solid #ddd;">
                            ${file.mime_type.startsWith('image/') ? 
                                `<img src="${file.file_url}" class="img-fluid rounded mb-2" style="height: 120px; width: 100%; object-fit: cover;">` :
                                file.mime_type.startsWith('video/') ? 
                                `<video class="img-fluid rounded mb-2" style="height: 120px;" controls>
                                            <source src="${file.file_url}" type="${file.mime_type}">
                                        </video>` :
                                file.mime_type === 'application/pdf' ? 
                                `<div class="pdf-preview text-center mb-2" style="height: 120px; width: 100%; background-color: #f5f5f5; border: 1px solid #ddd;">
                                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                            </div>` : 
                                `<div class="file-preview text-center mb-2" style="height: 120px; width: 100%; background-color: #f5f5f5; border: 1px solid #ddd;">
                                                <i class="fas fa-file fa-3x text-primary"></i>
                                            </div>`
                            }
                        </div>
                        <h6 class="text-truncate">${file.original_name.length > 25 ? file.original_name.slice(0, 25) + '…' : file.original_name}</h6>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="text-muted">${file.uploaded_at}</small>
                            <span class="badge ${file.is_your ? 'bg-success' : 'bg-info'}">
                                ${file.is_your ? 'Private' : 'Public'}
                            </span>
                        </div>
                `;

                    fileGrid.appendChild(fileCard);
                });

                if (data.links) {
                    paginationContainer.innerHTML = '';
                    const paginationWrapper = document.createElement('div');
                    paginationWrapper.classList.add('d-flex', 'justify-content-center', 'flex-wrap',
                        'gap-1');
                    data.links.forEach(link => {
                        const pageLink = document.createElement('button');
                        pageLink.classList.add('btn', 'btn-outline-primary', 'page-link', 'mx-1');
                        pageLink.innerHTML = link.label;
                        pageLink.disabled = !link.url;
                        pageLink.style.minWidth = '40px';

                        if (link.active) {
                            pageLink.classList.add('active');
                        }

                        if (link.url) {
                            pageLink.addEventListener('click', () => {
                                fetchFiles(link.url.split('page=')[1]);
                            });
                        }

                        paginationWrapper.appendChild(pageLink);
                    });

                    paginationContainer.appendChild(paginationWrapper);
                }
            } catch (error) {
                console.log('Error: ' + error);
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            fetchFiles(1);
            document.addEventListener("click", function (event) {
                if (event.target.closest(".delete-file")) {
                    event.preventDefault();
                    
                    let button = event.target.closest(".delete-file");
                    let fileId = button.getAttribute("data-id");
                    
                    if (!confirm("Are you sure you want to delete this file?")) {
                        return;
                    }

                    fetch("{{ route('upload.delete') }}", {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id: fileId })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) { // Changed from data.success to data.status
                            notifyToastr('success', 'File Delete', data.message);
                            fetchFiles(1); // Refresh the file list
                        } else {
                            notifyToastr('error', 'File Delete', data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Error deleting file:", error);
                        notifyToastr('error', 'File Delete', 'An error occurred.');
                    });
                }
            });
        });
    </script>
@endsection
