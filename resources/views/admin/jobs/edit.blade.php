@extends('admin.layouts.app')

@php
    $selector = true;
    $slug = true;
@endphp

@section('title', 'Edit Job')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Jobs',
        'sRoute' => route('jobs.index'),
        'third' => 'Edit',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Edit Job',
        'pTitle' => 'Jobs',
        'pSubtitle' => 'Index',
        'pSRoute' => route('jobs.index'),
    ])
@endsection

@section('main_content')
    <form method="POST" action="{{ route('jobs.update', $job->id) }}" class="row">
        @csrf
        @method('PUT')

        {{-- LEFT --}}
        <div class="col-lg-8">

            {{-- Job Details --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Job Details</h3>
                <div class="card-body">

                    {{-- Title --}}
                    <div class="form-group mb-3">
                        <label>Job Title *</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $job->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="form-group mb-3">
                        <label>Slug *</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $job->slug) }}"
                            required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Company --}}
                    <div class="form-group mb-3">
                        <label>Company</label>
                        <input type="text" name="company" class="form-control @error('company') is-invalid @enderror"
                            value="{{ old('company', $job->company) }}">
                        @error('company')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Salary & Vacancy --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control @error('salary') is-invalid @enderror"
                                value="{{ old('salary', $job->salary) }}">
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Vacancy</label>
                            <input type="text" name="vacancy" class="form-control @error('vacancy') is-invalid @enderror"
                                value="{{ old('vacancy', $job->vacancy) }}">
                            @error('vacancy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Type & Gender --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Job Type</label>
                            <select name="type" class="form-control">
                                @foreach (['full-time', 'part-time', 'contract'] as $t)
                                    <option value="{{ $t }}"
                                        {{ old('type', $job->type) == $t ? 'selected' : '' }}>
                                        {{ ucfirst($t) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                @foreach (['both', 'male', 'female', 'other'] as $g)
                                    <option value="{{ $g }}"
                                        {{ old('gender', $job->gender) == $g ? 'selected' : '' }}>
                                        {{ ucfirst($g) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Education --}}
                    <div class="form-group mb-3">
                        <label>Educational Requirement</label>
                        <input type="text" name="educational" class="form-control"
                            value="{{ old('educational', $job->educational) }}">
                    </div>

                    {{-- Experience --}}
                    <div class="form-group mb-3">
                        <label>Experience</label>
                        <input type="text" name="experience" class="form-control"
                            value="{{ old('experience', $job->experience) }}">
                    </div>

                    {{-- Additional --}}
                    <div class="form-group mb-3">
                        <label>Additional Requirement</label>
                        <input type="text" name="additional" class="form-control"
                            value="{{ old('additional', $job->additional) }}">
                    </div>

                    {{-- Description --}}
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control">
                        {{ old('description', $job->description) }}
                    </textarea>
                    </div>

                </div>
            </div>

            {{-- Job Meta Data --}}
            <div class="card">
                <h3 class="card-header card-title">SEO Meta</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title"
                            class="form-control @error('meta_title') is-invalid @enderror"
                            value="{{ old('meta_title', $job->meta_title) }}">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords"
                            class="form-control @error('meta_keywords') is-invalid @enderror"
                            value="{{ old('meta_keywords', $job->meta_keywords) }}">
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="5"
                            class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $job->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">

            {{-- Apply Info --}}
            <div class="card">
                <h3 class="card-header card-title">Apply Information</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label>Apply Method *</label>
                        <select name="apply" class="form-control" required>
                            @foreach (['url', 'email', 'in-person', 'address'] as $a)
                                <option value="{{ $a }}"
                                    {{ old('apply', $job->apply) == $a ? 'selected' : '' }}>
                                    {{ ucfirst($a) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Apply Value *</label>
                        <input type="text" name="apply_value" class="form-control"
                            value="{{ old('apply_value', $job->apply_value) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Source Link</label>
                        <input type="text" name="source_link" class="form-control"
                            value="{{ old('source_link', $job->source_link) }}">
                    </div>

                </div>
            </div>

            {{-- Category --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Category</h3>
                <div class="card-body">
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Location --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Location</h3>
                <div class="card-body">

                    <select name="division_id" id="division_id" class="form-control mb-3">
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ old('division_id', $job->division_id) == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="form-group mb-3">
                        <input type="text" name="location" class="form-control"
                            value="{{ old('location', $job->location) }}">
                    </div>

                </div>
            </div>

            {{-- Gallery --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Gallery</h3>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="file-selector-container col-lg-12">
                            <div class="file-selector-item single-selector col-lg-12" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single" data-input-name="thumb"
                                data-title="Select Thumbnail">
                                <i class="fa fa-file"></i>
                                <span>Select Thumbnail</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            @if ($job->thumb)
                                <img src="{{ get_file_url($job->thumb) }}" alt="Current Image" class="img-thumbnail"
                                    style="max-width: 100px;">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="file-selector-container col-lg-12">
                            <div class="file-selector-item single-selector col-lg-12" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single"
                                data-input-name="attachment" data-title="Select Attachment">
                                <i class="fa fa-file"></i>
                                <span>Select Attachment</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            @if ($job->attachment)
                                <a href="{{ get_file_url($job->attachment) }}" target="_blank"
                                    rel="noopener noreferrer">View Attachment</a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- Status --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Status</h3>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="status">Job Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                            required>
                            <option value="1" {{ old('status', $job->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $job->status) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="card">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary w-100">
                        Update Job
                    </button>
                </div>
            </div>

        </div>
    </form>
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
            $('#description').summernote()
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
