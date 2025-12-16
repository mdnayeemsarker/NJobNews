@extends('admin.layouts.app')
@section('title', 'Category')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'Category', 'sRoute' => route('categories.index'), 'third' => 'Show'])
@endsection
@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Category',
        'pTitle' => 'Category',
        'pSubtitle' => 'Create',
        'pSRoute' => route('categories.create'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Category Details</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-lg-4">Name:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $category->title }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="image_url" class="col-lg-4">Image:</label>
                <div class="col-lg-8">
                    @if ($category->image_url)
                        <img src="{{ get_file_url($category->image_url) }}" alt="Category Image" class="img-thumbnail" style="max-width: 100px;">
                    @else
                        <p>No image uploaded.</p>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="in_order" class="col-lg-4">In Order:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $category->in_order }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-lg-4">Status:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $category->status == 1 ? 'Active' : 'Inactive' }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="meta_title" class="col-lg-4">Meta Title:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $category->meta_title ?? 'not set' }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="meta_tag" class="col-lg-4">Meta Tag:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $category->meta_tag ?? 'not set' }}</p>
                </div>
            </div>

            <div class="form-group row">
                <label for="meta_description" class="col-lg-4">Meta Description:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $category->meta_description ?? 'not set' }}</p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
