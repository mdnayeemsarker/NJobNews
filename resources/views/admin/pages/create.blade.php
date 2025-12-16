@extends('admin.layouts.app')
@php
    $selector = true;
    $slug = true;
@endphp
@section('title', 'Pages')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Pages',
        'sRoute' => route('pages.index'),
        'third' => 'Create',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Pages',
        'pTitle' => 'Pages',
        'pSubtitle' => 'Index',
        'pSRoute' => route('pages.index'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Page Create</h3>
        </div>
        <form method="POST" action="{{ route('pages.store') }}">
            @csrf
            <div class="card-body">
                {{-- Page Title --}}
                <div class="form-group row">
                    <label for="title" class="col-lg-3">Title</label>
                    <div class="col-lg-9">
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Enter Page Title"
                            value="{{ old('title') }}">
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
                            value="{{ old('slug') }}">
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
                            placeholder="Enter Page Content">{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>


                {{-- Meta Title --}}
                <div class="form-group row">
                    <label for="meta_title" class="col-lg-3">Meta Title</label>
                    <div class="col-lg-9">
                        <input type="text" name="meta_title"
                            class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"
                            placeholder="Enter Meta Title" value="{{ old('meta_title') }}">
                        @error('meta_title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Meta Tag --}}
                <div class="form-group row">
                    <label for="meta_tag" class="col-lg-3">Meta Tag</label>
                    <div class="col-lg-9">
                        <input type="text" name="meta_tag" class="form-control @error('meta_tag') is-invalid @enderror"
                            id="meta_tag" placeholder="Enter Meta Tag" value="{{ old('meta_tag') }}">
                        @error('meta_tag')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Meta Description --}}
                <div class="form-group row">
                    <label for="meta_description" class="col-lg-3">Meta Description</label>
                    <div class="col-lg-9">
                        <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror"
                            id="meta_description" rows="3" placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
                height: 500,
                placeholder: 'Write job description here...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        })
    </script>
@endsection