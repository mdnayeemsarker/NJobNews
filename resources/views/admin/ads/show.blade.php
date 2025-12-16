@extends('admin.layouts.app')
@section('title', 'Ad Details')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Ads',
        'sRoute' => route('ads.index'),
        'third' => 'Show',
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
            <h3 class="card-title">Ad Details</h3>
        </div>
        <div class="card-body">

            {{-- Location --}}
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold">Location:</label>
                <div class="col-lg-9">
                    <p class="form-control-plaintext">{{ $ad->location }}</p>
                </div>
            </div>

            {{-- Thumbnail --}}
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold">Thumbnail:</label>
                <div class="col-lg-9">
                    @if ($ad->thumb)
                        <img src="{{ get_file_url($ad->thumb) }}" alt="Ad Thumbnail" class="img-fluid" style="max-height:200px;">
                    @else
                        <span class="text-muted">No thumbnail uploaded.</span>
                    @endif
                </div>
            </div>

            {{-- Link --}}
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold">Link:</label>
                <div class="col-lg-9">
                    @if ($ad->link)
                        <a href="{{ $ad->link }}" target="_blank">{{ $ad->link }}</a>
                    @else
                        <span class="text-muted">No link provided.</span>
                    @endif
                </div>
            </div>

            {{-- Height --}}
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold">Height:</label>
                <div class="col-lg-9">
                    <p class="form-control-plaintext">{{ $ad->height ?? '-' }}</p>
                </div>
            </div>

            {{-- Width --}}
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold">Width:</label>
                <div class="col-lg-9">
                    <p class="form-control-plaintext">{{ $ad->width ?? '-' }}</p>
                </div>
            </div>

            {{-- Status --}}
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold">Status:</label>
                <div class="col-lg-9">
                    <span class="badge {{ $ad->status ? 'badge-success' : 'badge-danger' }}">
                        {{ $ad->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            {{-- Created At --}}
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold">Created At:</label>
                <div class="col-lg-9">
                    <p class="form-control-plaintext">{{ $ad->created_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            {{-- Updated At --}}
            <div class="form-group row">
                <label class="col-lg-3 font-weight-bold">Updated At:</label>
                <div class="col-lg-9">
                    <p class="form-control-plaintext">{{ $ad->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <a href="{{ route('ads.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-primary {{ hasPermission('ads.edit') ? '' : 'd-none' }}">Edit</a>
        </div>
    </div>
@endsection
