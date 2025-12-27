@extends('admin.layouts.app')

@php
    $selector = true;
@endphp

@section('title', 'Create SMS')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'SMS',
        'sRoute' => route('sms-workers.index'),
        'third' => 'Create',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'SMS Worker',
        'pTitle' => 'SMS',
        'pSubtitle' => 'Create',
        'pSRoute' => route('sms-workers.index'),
    ])
@endsection

@section('main_content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create SMS</h3>
    </div>

    <form method="POST" action="{{ route('sms-workers.store') }}">
        @csrf

        <div class="card-body">

            {{-- Receiver --}}
            <div class="form-group row">
                <label class="col-lg-3">Receiver Number</label>
                <div class="col-lg-9">
                    <input type="text"
                           name="receiver"
                           class="form-control @error('receiver') is-invalid @enderror"
                           placeholder="01XXXXXXXXX"
                           value="{{ old('receiver') }}">
                    @error('receiver')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Message Body --}}
            <div class="form-group row">
                <label class="col-lg-3">Message</label>
                <div class="col-lg-9">
                    <textarea name="body"
                              rows="4"
                              class="form-control @error('body') is-invalid @enderror"
                              placeholder="Enter SMS content">{{ old('body') }}</textarea>
                    @error('body')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Sender --}}
            <div class="form-group row">
                <label class="col-lg-3">Sender</label>
                <div class="col-lg-9">
                    <input type="text"
                           name="sender"
                           class="form-control @error('sender') is-invalid @enderror"
                           value="{{ old('sender', '01517851911') }}">
                    @error('sender')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Status --}}
            <div class="form-group row">
                <label class="col-lg-3">Status</label>
                <div class="col-lg-9">
                    <select name="status"
                            class="form-control @error('status') is-invalid @enderror">
                        <option value="create">Create</option>
                        <option value="sent">Sent</option>
                        <option value="paid">Paid</option>
                        <option value="complete">Complete</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Save SMS
            </button>
        </div>
    </form>
</div>
@endsection
