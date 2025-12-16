<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<!-- Ionicons -->
{{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
<!-- iCheck -->
{{-- <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

@isset($selector)
    <style>
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
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>
@endisset
