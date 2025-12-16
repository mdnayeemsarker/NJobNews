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
        'pSubtitle' => 'Create',
        'pSRoute' => route('jobs.index'),
    ])
@endsection

@section('main_content')
    <form method="POST" action="{{ route('jobs.store') }}" class="row">
        @csrf

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">

            {{-- Job Details --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Job Details</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label>Job Title *</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Slug *</label>
                        <input type="text" name="slug" id="slug" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Company</label>
                        <input type="text" name="company" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control">
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label>Vacancy</label>
                            <input type="text" name="vacancy" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Job Type</label>
                            <select name="type" class="form-control">
                                <option value="full-time">Full Time</option>
                                <option value="part-time">Part Time</option>
                                <option value="contract">Contract</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="both">Both</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label>Educational Requirement</label>
                        <input type="text" name="educational" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Experience</label>
                        <input type="text" name="experience" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Additional Requirement</label>
                        <input type="text" name="additional" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Job Description</label>
                        <textarea name="description" id="description" class="form-control" rows="6"></textarea>
                    </div>

                </div>
            </div>

            {{-- Apply Information --}}
            <div class="card">
                <h3 class="card-header card-title">Apply Information</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label>Apply Method *</label>
                        <select name="apply" class="form-control" required>
                            <option value="url">Apply URL</option>
                            <option value="email">Apply Email</option>
                            <option value="in-person">In Person</option>
                            <option value="address">Address</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Apply Value *</label>
                        <input type="text" name="apply_value" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Source Link</label>
                        <input type="text" name="source_link" class="form-control">
                    </div>

                </div>
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">

            {{-- Category --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Category</h3>
                <div class="card-body">
                    <select name="category_id" class="form-control select">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Location --}}
            <div class="card mb-3">
                <h3 class="card-header card-title">Location</h3>
                <div class="card-body">

                    <div class="form-group mb-3">
                        <select name="division_id" id="division_id" class="form-control select">
                            <option value="">Select Division</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->bn_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3" id="district-container" style="display:none">
                        <select name="district_id" id="district_id" class="form-control select"></select>
                    </div>

                    <div class="form-group mb-3" id="thana-container" style="display:none">
                        <select name="thana_id" id="thana_id" class="form-control select"></select>
                    </div>

                    <div class="form-group">
                        <label>Location (Text)</label>
                        <input type="text" name="location" class="form-control">
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
            $('#description').summernote({
                height: 250,
                placeholder: 'Write job description here...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
            // Auto slug
            $('#title').on('keyup change', function() {
                generateSlug(this, document.getElementById('slug'));
            });
        });
        document.getElementById('title').addEventListener('change', function() {
            generateSlug(this, document.getElementById('slug'));
        });

        document.getElementById('division_id').addEventListener('change', function() {
            let divisionId = this.value;
            if (!divisionId) return;

            fetch("{{ route('get.districts', ':id') }}".replace(':id', divisionId))
                .then(res => res.json())
                .then(data => {
                    let district = document.getElementById('district_id');
                    district.innerHTML = '<option value="">Select District</option>';
                    data.districts.forEach(d => {
                        district.innerHTML += `<option value="${d.id}">${d.bn_name}</option>`;
                    });
                    document.getElementById('district-container').style.display = 'block';
                });
        });

        document.getElementById('district_id').addEventListener('change', function() {
            let districtId = this.value;
            if (!districtId) return;

            fetch("{{ route('get.thanas', ':id') }}".replace(':id', districtId))
                .then(res => res.json())
                .then(data => {
                    let thana = document.getElementById('thana_id');
                    thana.innerHTML = '<option value="">Select Thana</option>';
                    data.thanas.forEach(t => {
                        thana.innerHTML += `<option value="${t.id}">${t.bn_name}</option>`;
                    });
                    document.getElementById('thana-container').style.display = 'block';
                });
        });
    </script>
@endsection
