@extends('admin.layouts.app')
@php
    $addModal = true;
    $selector = true;
    $slug = true;
@endphp
@section('title', 'Edit Post')
@section('nav_left')@include('admin.layouts.partials._left_nuv_bar', [
    'second' => 'Post',
    'sRoute' => route('posts.index'),
    'third' => 'Edit',
])@endsection
@section('page_header')@include('admin.layouts.partials._page_header', [
    'title' => 'Post',
    'pTitle' => 'Post',
    'pSubtitle' => 'Index',
    'pSRoute' => route('posts.index'),
])@endsection

@section('main_content')
    <form class="row" method="POST" action="{{ route('posts.update', $post->id) }}">
        @csrf
        @method('PUT')
        <div class="col-lg-8">
            <div class="card">
                <h3 class="card-header card-title">Post Details</h3>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="title" class="">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="Enter post Title" value="{{ old('title', $post->title) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="sub_title_1" class="">Post Sub Title 1</label>
                        <input type="text" name="sub_title_1" id="sub_title_1" class="form-control"
                            placeholder="Enter post sub title 1" value="{{ old('sub_title_1', $post->sub_title_1) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="sub_title_2" class="">Post Sub Title 2</label>
                        <input type="text" name="sub_title_2" id="sub_title_2" class="form-control"
                            placeholder="Enter post sub title 2" value="{{ old('sub_title_2', $post->sub_title_2) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="short_content" class="">Post Short Content</label>
                        <textarea name="short_content" id="short_content" class="form-control" rows="1"
                            placeholder="Post Short Content">{{ old('short_content', $post->short_content) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="content" class="">Post Content</label>
                        <textarea name="content" id="content" class="form-control" rows="5">{{ old('content', $post->content) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="slug" class="">Post Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            placeholder="Post Slug" value="{{ old('slug', $post->slug) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="read_more_link" class="">Read More Link</label>
                        <input type="text" name="read_more_link" id="read_more_link" class="form-control"
                            placeholder="Read More Link" value="{{ old('read_more_link', $post->read_more_link) }}">
                    </div>
                </div>
            </div>
            <div class="card">
                <h3 class="card-header card-title">SEO Details</h3>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="tags" class="">Post Tags</label>
                        <input type="text" name="tags" id="tags" class="form-control"
                            placeholder="Post Tags" value="{{ old('tags', $post->tags) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_title" class="">Post Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control"
                            placeholder="Post Meta Title" value="{{ old('meta_title', $post->meta_title) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_keywords" class="">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            placeholder="Meta Keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="meta_description" class="">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" class="form-control" rows="2">{{ old('meta_description', $post->meta_description) }}</textarea>
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
                                <div class="selected-files single-file-names mt-2 text-muted">
                                    {{ $post->thumb ? basename($post->thumb) : 'No image selected' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <div class="input-group">
                            <select name="category_id" class="form-control select" id="category_id" required>
                                <option value="" disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
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

                    <div class="form-group" id="subcategory-container"
                        style="{{ $post->subcategory_id ? '' : 'display:none;' }}">
                        <label for="subcategory_id">Subcategory</label>
                        <select name="subcategory_id" class="form-control select" id="subcategory_id">
                            <option value="" disabled>Select Subcategory</option>
                            @if ($post->category && $post->category->subCategories)
                                @foreach ($post->category->subCategories as $sub)
                                    <option value="{{ $sub->id }}"
                                        {{ old('subcategory_id', $post->subcategory_id) == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->title }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="division_id">Division</label>
                        <select name="division_id" class="form-control select" id="division_id">
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ old('division_id', $post->division_id) == $division->id ? 'selected' : '' }}>
                                    {{ $division->bn_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="district-container"
                        style="{{ $post->district_id ? '' : 'display:none;' }}">
                        <label for="district_id">District</label>
                        <select name="district_id" class="form-control select" id="district_id">
                            <option value="" disabled>Select District</option>
                        </select>
                    </div>

                    <div class="form-group" id="thana-container"
                        style="{{ $post->thana_id ? '' : 'display:none;' }}">
                        <label for="thana_id">Thana</label>
                        <select name="thana_id" class="form-control select" id="thana_id">
                            <option value="" disabled>Select Thana</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_breaking" id="is_breaking" value="1"
                                class="form-check-input"
                                {{ old('is_breaking', $post->is_breaking) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_breaking">Post Breaking</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                class="form-check-input"
                                {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Post Featured</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" name="is_recommended" id="is_recommended" value="1"
                                class="form-check-input"
                                {{ old('is_recommended', $post->is_recommended) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_recommended">Post Recommended</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3 class="card-header card-title">Post Published</h3>
                <div class="card-body">
                    <div class="form-group">
                        <label for="created_at">Select Post Published Date</label>
                        <input type="date" name="created_at" id="created_at" class="form-control"
                            value="{{ old('created_at', $post->created_at ? $post->created_at->format('Y-m-d') : '') }}">
                    </div>
                    <div class="form-group">
                        <select name="status" class="form-control select" id="status" required>
                            <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Published</option>
                            <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Draft</option>
                            <option value="2" {{ old('status', $post->status) == 2 ? 'selected' : '' }}>Scheduled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Post</button>
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
        })
        document.getElementById('title').addEventListener('change', function() {
            generateSlug(this, document.getElementById('slug'));
        });
    </script>
@endsection
