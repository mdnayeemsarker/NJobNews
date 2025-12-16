@extends('admin.layouts.app')
@php
    $selector = true;
    $slug = true;
@endphp

@section('title', 'Edit Page')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Pages',
        'sRoute' => route('pages.index'),
        'third' => 'Edit',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Pages',
        'pTitle' => 'Pages',
        'pSubtitle' => 'Edit',
        'pSRoute' => route('pages.index'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Page</h3>
        </div>

        <form method="POST" action="{{ route('pages.update', $page->id) }}">
            @csrf
            @method('PUT')

            <div class="card-body">
                {{-- Page Title --}}
                <div class="form-group row">
                    <label for="title" class="col-lg-3">Title</label>
                    <div class="col-lg-9">
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Enter Page Title"
                            value="{{ old('title', $page->title) }}">
                        @error('title')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Page Slug --}}
                <div class="form-group row">
                    <label for="slug" class="col-lg-3">Slug</label>
                    <div class="col-lg-9">
                        <input type="text" name="slug"
                            class="form-control @error('slug') is-invalid @enderror"
                            id="slug" placeholder="Enter Page Slug"
                            value="{{ old('slug', $page->slug) }}">
                        @error('slug')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Page Content --}}
                <div class="form-group row">
                    <label for="content" class="col-lg-3">Content</label>
                    <div class="col-lg-9">
                        <textarea name="content" id="content"
                            class="form-control @error('content') is-invalid @enderror"
                            rows="6"
                            placeholder="Enter Page Content">{{ old('content', $page->content) }}</textarea>
                        @error('content')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="form-group row">
                    <label for="status" class="col-lg-3">Status</label>
                    <div class="col-lg-9">
                        <select name="status"
                            class="form-control @error('status') is-invalid @enderror"
                            id="status">
                            <option value="1" {{ old('status', $page->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $page->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('pages.index') }}" class="btn btn-secondary float-right">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script>
        $(function() {
            $('#title').on('keyup change', function() {
                generateSlug(this, document.getElementById('slug'));
            });
            $('#content').summernote()
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai",
                height: 250,
                placeholder: 'Write job description here...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endsection
