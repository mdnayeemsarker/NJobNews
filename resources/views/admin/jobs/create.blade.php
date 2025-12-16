@extends('admin.layouts.app')

@php
    $slug = true;
@endphp

@section('title', 'Create Job')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Jobs',
        'sRoute' => route('jobs.index'),
        'third' => 'Create',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Create Job',
        'pTitle' => 'Jobs',
        'pSubtitle' => 'Index',
        'pSRoute' => route('jobs.index'),
    ])
@endsection

@section('main_content')
    <form method="POST" action="{{ route('jobs.store') }}" class="row">
        @csrf

        {{-- LEFT --}}
        <div class="col-lg-8">

            {{-- Job Details --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Job Details</h3>
                <div class="card-body">

                    {{-- Title --}}
                    <div class="form-group mb-3">
                        <label for="title">Job Title *</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div class="form-group mb-3">
                        <label for="slug">Slug *</label>
                        <input type="text" name="slug" id="slug"
                            class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Company --}}
                    <div class="form-group mb-3">
                        <label for="company">Company</label>
                        <input type="text" name="company" id="company"
                            class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}">
                        @error('company')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Salary & Vacancy --}}
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="salary">Salary</label>
                            <input type="text" name="salary" id="salary"
                                class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}">
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="vacancy">Vacancy</label>
                            <input type="text" name="vacancy" id="vacancy"
                                class="form-control @error('vacancy') is-invalid @enderror" value="{{ old('vacancy') }}">
                            @error('vacancy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Type & Gender --}}
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="type">Job Type</label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full Time
                                </option>
                                <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part Time
                                </option>
                                <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract
                                </option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender"
                                class="form-control @error('gender') is-invalid @enderror">
                                <option value="both" {{ old('gender') == 'both' ? 'selected' : '' }}>Both</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Education --}}
                    <div class="form-group mb-3">
                        <label for="educational">Educational Requirement</label>
                        <input type="text" name="educational" id="educational"
                            class="form-control @error('educational') is-invalid @enderror"
                            value="{{ old('educational') }}">
                        @error('educational')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Experience --}}
                    <div class="form-group mb-3">
                        <label for="experience">Experience</label>
                        <input type="text" name="experience" id="experience"
                            class="form-control @error('experience') is-invalid @enderror" value="{{ old('experience') }}">
                        @error('experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Additional --}}
                    <div class="form-group mb-3">
                        <label for="additional">Additional Requirement</label>
                        <input type="text" name="additional" id="additional"
                            class="form-control @error('additional') is-invalid @enderror" value="{{ old('additional') }}">
                        @error('additional')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group mb-3">
                        <label for="description">Job Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">
                        {{ old('description') }}
                    </textarea>
                        @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Apply Info --}}
            <div class="card">
                <h3 class="card-header card-title">Apply Information</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="apply">Apply Method *</label>
                        <select name="apply" id="apply" class="form-control @error('apply') is-invalid @enderror"
                            required>
                            <option value="">Select Method</option>
                            <option value="url" {{ old('apply') == 'url' ? 'selected' : '' }}>URL</option>
                            <option value="email" {{ old('apply') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="in-person" {{ old('apply') == 'in-person' ? 'selected' : '' }}>In Person
                            </option>
                            <option value="address" {{ old('apply') == 'address' ? 'selected' : '' }}>Address</option>
                        </select>
                        @error('apply')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="apply_value">Apply Value *</label>
                        <input type="text" name="apply_value" id="apply_value"
                            class="form-control @error('apply_value') is-invalid @enderror"
                            value="{{ old('apply_value') }}" required>
                        @error('apply_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="source_link">Source Link</label>
                        <input type="text" name="source_link" id="source_link"
                            class="form-control @error('source_link') is-invalid @enderror"
                            value="{{ old('source_link') }}">
                        @error('source_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="col-lg-4">

            {{-- Category --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Category</h3>
                <div class="card-body">
                    <select name="category_id" class="form-control select @error('category_id') is-invalid @enderror">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Location --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Location</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <select name="division_id" id="division_id"
                            class="form-control select @error('division_id') is-invalid @enderror">
                            <option value="">Select Division</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('division_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3" id="district-container" style="display:none">
                        <select name="district_id" id="district_id"
                            class="form-control select @error('district_id') is-invalid @enderror"></select>
                        @error('district_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3" id="thana-container" style="display:none">
                        <select name="thana_id" id="thana_id"
                            class="form-control select @error('thana_id') is-invalid @enderror"></select>
                        @error('thana_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Location (Text)</label>
                        <input type="text" name="location"
                            class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Submit --}}
            <div class="card">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary w-100">
                        Publish Job
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

        document.getElementById('division_id').addEventListener('change', function() {
            fetch("{{ route('get.districts', ':id') }}".replace(':id', this.value))
                .then(res => res.json())
                .then(data => {
                    let d = document.getElementById('district_id');
                    d.innerHTML = '<option value="">Select District</option>';
                    data.districts.forEach(i => d.innerHTML += `<option value="${i.id}">${i.name}</option>`);
                    document.getElementById('district-container').style.display = 'block';
                });
        });

        document.getElementById('district_id').addEventListener('change', function() {
            fetch("{{ route('get.thanas', ':id') }}".replace(':id', this.value))
                .then(res => res.json())
                .then(data => {
                    let t = document.getElementById('thana_id');
                    t.innerHTML = '<option value="">Select Thana</option>';
                    data.thanas.forEach(i => t.innerHTML += `<option value="${i.id}">${i.name}</option>`);
                    document.getElementById('thana-container').style.display = 'block';
                });
        });
    </script>
@endsection
