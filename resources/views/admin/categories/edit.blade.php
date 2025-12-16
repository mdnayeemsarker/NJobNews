@extends('admin.layouts.app')
@php
    $selector = true;
    $slug = true;
@endphp
@section('title', 'Category')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Category',
        'sRoute' => route('categories.index'),
        'third' => 'Edit',
    ])
@endsection
@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Category',
        'pTitle' => 'Category',
        'pSubtitle' => 'Index',
        'pSRoute' => route('categories.index'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <form id="quickForm" method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                {{-- Category Name --}}
                <div class="form-group row">
                    <label for="title" class="col-lg-3">Title</label>
                    <div class="col-lg-9">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            id="title" placeholder="Enter Category Title" value="{{ old('title', $category->title) }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Category Image --}}
                <div class="form-group row">
                    <label for="image_url" class="col-lg-3">Select Image</label>
                    <div class="file-selector-container col-lg-9">
                        <div class="file-selector-item single-selector col-lg-6" data-toggle="modal"
                            data-target="#fileSelectorModal" data-selection-type="single" data-input-name="image_url"
                            data-title="Select Category Image">
                            <i class="fa fa-file"></i>
                            <span>Select Category Image</span>
                            <div class="selected-files single-file-names mt-2 text-muted"></div>
                        </div>
                        @if ($category->image_url)
                            <img src="{{ get_file_url($category->image_url) }}" alt="Current Image" class="img-thumbnail"
                                style="max-width: 100px;">
                        @endif
                    </div>
                </div>

                {{-- Category In Order --}}
                <div class="form-group row">
                    <label for="in_order" class="col-lg-3">In Order</label>
                    <div class="col-lg-9">
                        <input type="number" name="in_order" class="form-control @error('in_order') is-invalid @enderror"
                            id="in_order" placeholder="Enter Category In Order" value="{{ old('in_order', $category->in_order) }}">
                        @error('in_order')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Category Slug --}}
                <div class="form-group row">
                    <label for="slug" class="col-lg-3">Slug</label>
                    <div class="col-lg-9">
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                            id="slug" placeholder="Enter Category Slug" value="{{ old('slug', $category->slug) }}">
                        @error('slug')
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
                        <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                            <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Meta Title --}}
                <div class="form-group row">
                    <label for="meta_title" class="col-lg-3">Meta Title</label>
                    <div class="col-lg-9">
                        <input type="text" name="meta_title"
                            class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"
                            placeholder="Enter Meta Title" value="{{ old('meta_title', $category->meta_title) }}">
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
                            id="meta_tag" placeholder="Enter Meta Tag" value="{{ old('meta_tag', $category->meta_tag) }}">
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
                            id="meta_description" rows="3" placeholder="Enter Meta Description">{{ old('meta_description', $category->meta_description) }}</textarea>
                        @error('meta_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#title').on('keyup change', function() {
                generateSlug(this, document.getElementById('slug'));
            });
        })
    </script>
@endsection
