@extends('admin.layouts.app')
@php
    $addModal = true;
    $selector = true;
    $slug = true;
@endphp
@section('title', 'Post')
@section('nav_left')@include('admin.layouts.partials._left_nuv_bar', [
    'second' => 'Post',
    'sRoute' => route('posts.index'),
    'third' => 'Create',
])@endsection
@section('page_header')@include('admin.layouts.partials._page_header', [
    'title' => 'Post',
    'pTitle' => 'Post',
    'pSubtitle' => 'Index',
    'pSRoute' => route('posts.index'),
])@endsection

@section('main_content')
    <form class="row" method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="col-lg-8">
            <div class="card">
                <h3 class="card-header card-title">Post Details</h3>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="title" class="">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="Enter post Title" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="sub_title_1" class="">Post Sub Title 1</label>
                        <input type="text" name="sub_title_1" id="sub_title_1" class="form-control"
                            placeholder="Enter post sub title 1">
                    </div>

                    <div class="form-group mb-3">
                        <label for="sub_title_2" class="">Post Sub Title 2</label>
                        <input type="text" name="sub_title_2" id="sub_title_2" class="form-control"
                            placeholder="Enter post sub title 2">
                    </div>

                    <div class="form-group mb-3">
                        <label for="short_content" class="">Post Short Content</label>
                        <textarea name="short_content" id="short_content" class="form-control" rows="1" placeholder="Post Short Content"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="content" class="">Post Content</label>
                        <textarea name="content" id="content" class="form-control" rows="5">নিউজ ডেস্ক:</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="slug" class="">Post Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            placeholder="Post Slug">
                    </div>

                    <div class="form-group mb-3">
                        <label for="read_more_link" class="">Read More Link</label>
                        <input type="text" name="read_more_link" id="read_more_link" class="form-control"
                            placeholder="Read More Link">
                    </div>

                    <div class="form-group mb-3">
                        <label for="read_more_link" class="">Read More Link</label>
                        <input type="text" name="read_more_link" id="read_more_link" class="form-control"
                            placeholder="Read More Link">
                    </div>
                </div>
            </div>
            <div class="card">
                <h3 class="card-header card-title">SEO Details</h3>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="tags" class="">Post Tags</label>
                        <input type="text" name="tags" id="tags" class="form-control"
                            placeholder="Post Tags">
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_title" class="">Post Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control"
                            placeholder="Post Meta Title">
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_keywords" class="">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            placeholder="Meta Keywords">
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_description" class="">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control" rows="2">নিউজ ডেস্ক:</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <h3 class="card-header card-title">Post Features</h3>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="file-selector-container col-lg-12">
                            <div class="file-selector-item single-selector col-lg-12" data-toggle="modal"
                                data-target="#fileSelectorModal" data-selection-type="single" data-input-name="thumb"
                                data-title="Select Thumbnail Image">
                                <i class="fa fa-file"></i>
                                <span>Select Thumbnail Image</span>
                                <div class="selected-files single-file-names mt-2 text-muted"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <select name="category_id" class="form-control select" id="category_id" required>
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select
                                    Category
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="input-group-append btn btn-info" data-toggle="modal"
                                data-url="{{ route('ajax.category.store') }}" data-target="#addModal"
                                data-type="category">Add New
                            </button>
                        </div>
                    </div>
                    <div class="form-group" id="subcategory-container" style="display: none;">
                        <div class="input-group">
                            <select name="subcategory_id" class="form-control select" id="subcategory_id">
                                <option value="" disabled selected>Select Subcategory</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="division_id" class="form-control select" id="division_id">
                            <option value="" disabled {{ old('division_id') ? '' : 'selected' }}>Select
                                Division
                            </option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                    {{ $division->bn_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="district-container" style="display: none;">
                        <select name="district_id" class="form-control select" id="district_id">
                            <option value="" disabled selected>Select District</option>
                        </select>
                    </div>
                    <div class="form-group" id="thana-container" style="display: none;">
                        <select name="thana_id" class="form-control select" id="thana_id">
                            <option value="" disabled selected>Select Thana</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_breaking" id="is_breaking" value="1"
                                class="form-check-input" {{ old('is_breaking') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_breaking">Post Breaking</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                class="form-check-input" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Post Featured</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_recommended" id="is_recommended" value="1"
                                class="form-check-input" {{ old('is_recommended') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_recommended">Post Recommended</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <h3 class="card-header card-title">Post Published</h3>
                <div class="card-body">
                    <div class="form-group">
                        <Label for="created_at">Select Post Published Date</Label>
                        <input type="date" name="created_at" id="created_at" class="form-control">
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control select" id="status" required>
                            <option value="1">Published</option>
                            <option value="0">Draft</option>
                            <option value="2">Scheduled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Published Now</button>
                    </div>
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
            $('#content').summernote()
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
        document.getElementById('title').addEventListener('change', function() {
            generateSlug(this, document.getElementById('slug'));
        });
        document.getElementById('category_id').addEventListener('change', function() {
            var categoryId = this.value;

            if (categoryId) {
                document.getElementById('subcategory-container').style.display = 'block';

                var route = "{{ route('get.subCategories', ':categoryId') }}";
                route = route.replace(':categoryId', categoryId);

                fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        if (data.subCategories) {
                            var subcategorySelect = document.getElementById('subcategory_id');
                            subcategorySelect.innerHTML =
                                '<option value="" disabled selected>Select Subcategory</option>';

                            data.subCategories.forEach(subcategory => {
                                var option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.title;
                                subcategorySelect.appendChild(option);
                            });
                        } else {
                            // If no subcategories, hide the subcategory container and show a message
                            document.getElementById('subcategory-container').style.display = 'none';
                            alert('No subcategories found for the selected category.');
                        }
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            } else {
                document.getElementById('subcategory-container').style.display = 'none';
            }
        });
        document.getElementById('divisition_id').addEventListener('change', function() {
            var divisionId = this.value;

            if (divisionId) {
                document.getElementById('district-container').style.display = 'block';
                var route = "{{ route('get.districts', ':divisionId') }}";
                route = route.replace(':divisionId', divisionId);
                fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        var districtSelect = document.getElementById('district_id');
                        districtSelect.innerHTML =
                            '<option value="" disabled selected>Select District</option>';
                        data.districts.forEach(district => {
                            var option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.bn_name;
                            districtSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching districts:', error));
            } else {
                document.getElementById('district-container').style.display = 'none';
            }
        });
        document.getElementById('district_id').addEventListener('change', function() {
            var districtId = this.value;

            if (districtId) {
                document.getElementById('thana-container').style.display = 'block';
                var route = "{{ route('get.thanas', ':districtId') }}";
                route = route.replace(':districtId', districtId);
                fetch(route)
                    .then(response => response.json())
                    .then(data => {
                        var thanaSelect = document.getElementById('thana_id');
                        thanaSelect.innerHTML = '<option value="" disabled selected>Select Thana</option>';
                        data.thanas.forEach(thana => {
                            var option = document.createElement('option');
                            option.value = thana.id;
                            option.textContent = thana.bn_name;
                            thanaSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching thanas:', error));
            } else {
                document.getElementById('thana-container').style.display = 'none';
            }
        });
    </script>
@endsection
