@extends('admin.layouts.app')
@php
    $selector = true;
@endphp
@section('title', 'Ads')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Ads',
        'sRoute' => route('ads.index'),
        'third' => 'Create',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Ads',
        'pTitle' => 'Ads',
        'pSubtitle' => 'Index',
        'pSRoute' => route('ads.index'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ad Create</h3>
        </div>
        <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                {{-- Location --}}
                <div class="form-group row">
                    <label for="location" class="col-lg-3">Location</label>
                    <div class="col-lg-9">
                        <input type="text" name="location"
                            class="form-control @error('location') is-invalid @enderror"
                            id="location" placeholder="Enter Ad Location"
                            value="{{ old('location') }}">
                        @error('location')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Thumbnail --}}
                <div class="form-group row">
                    <label for="thumb" class="col-lg-3">Thumbnail</label>
                    <div class="file-selector-container col-lg-9">
                        <div class="file-selector-item single-selector col-lg-6"
                            data-toggle="modal"
                            data-target="#fileSelectorModal"
                            data-selection-type="single"
                            data-input-name="thumb"
                            data-title="Select Ad Thumbnail">
                            <i class="fa fa-file"></i>
                            <span>Select Thumbnail</span>
                            <div class="selected-files single-file-names mt-2 text-muted"></div>
                        </div>
                    </div>
                </div>

                {{-- Link --}}
                <div class="form-group row">
                    <label for="link" class="col-lg-3">Link</label>
                    <div class="col-lg-9">
                        <input type="url" name="link"
                            class="form-control @error('link') is-invalid @enderror"
                            id="link" placeholder="Enter Ad Link"
                            value="{{ old('link') }}">
                        @error('link')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Height --}}
                <div class="form-group row">
                    <label for="height" class="col-lg-3">Height</label>
                    <div class="col-lg-9">
                        <input type="text" name="height"
                            class="form-control @error('height') is-invalid @enderror"
                            id="height" placeholder="Enter Ad Height"
                            value="{{ old('height') }}">
                        @error('height')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- Width --}}
                <div class="form-group row">
                    <label for="width" class="col-lg-3">Width</label>
                    <div class="col-lg-9">
                        <input type="text" name="width"
                            class="form-control @error('width') is-invalid @enderror"
                            id="width" placeholder="Enter Ad Width"
                            value="{{ old('width') }}">
                        @error('width')
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
