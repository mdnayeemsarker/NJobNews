@extends('admin.layouts.app')
@section('title', 'Pages')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Pages',
        'sRoute' => route('pages.index'),
        'third' => 'Show',
    ])
@endsection
@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Pages',
        'pTitle' => 'Pages',
        'pSubtitle' => 'Create',
        'pSRoute' => route('pages.create'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Page Details</h3>
        </div>
        <div class="card-body">
            {{-- Title --}}
            <div class="form-group row">
                <label class="col-lg-4">Title:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $page->title }}</p>
                </div>
            </div>

            {{-- Slug --}}
            <div class="form-group row">
                <label class="col-lg-4">Slug:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $page->slug }}</p>
                </div>
            </div>

            {{-- Content --}}
            <div class="form-group row">
                <label class="col-lg-4">Content:</label>
                <div class="col-lg-8">
                    <div class="border p-2 rounded bg-light">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="form-group row">
                <label class="col-lg-4">Status:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">
                        {{ $page->status ? 'Active' : 'Inactive' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('pages.index') }}" class="btn btn-secondary">Back to List</a>
            <form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display: inline-block;"
                onsubmit="return confirm('Are you sure you want to delete this page?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
