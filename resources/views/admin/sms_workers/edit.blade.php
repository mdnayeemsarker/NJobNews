@extends('admin.layouts.app')

@php
    $selector = true;
@endphp

@section('title', 'Edit SMS')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'SMS',
        'sRoute' => route('sms-workers.index'),
        'third' => 'Edit',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'SMS',
        'pTitle' => 'SMS',
        'pSubtitle' => 'Edit',
        'pSRoute' => route('sms-workers.index'),
    ])
@endsection

@section('main_content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit SMS</h3>
    </div>

    <form method="POST" action="{{ route('sms-workers.update', $sms->id) }}">
        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- Receiver --}}
            <div class="form-group row">
                <label class="col-lg-3">Receiver Number</label>
                <div class="col-lg-9">
                    <input @readonly(true) type="text"
                           name="receiver"
                           class="form-control @error('receiver') is-invalid @enderror"
                           value="{{ old('receiver', $sms->receiver) }}">
                    @error('receiver')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Message --}}
            <div class="form-group row">
                <label class="col-lg-3">Message</label>
                <div class="col-lg-9">
                    <textarea @readonly(true) name="body"
                              rows="4"
                              class="form-control @error('body') is-invalid @enderror">{{ old('body', $sms->body) }}</textarea>
                    @error('body')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            {{-- Message --}}
            <div class="form-group row">
                <label class="col-lg-3">Second Message</label>
                <div class="col-lg-9">
                    <textarea @readonly(true) name="body_second"
                              rows="4"
                              class="form-control @error('body_second') is-invalid @enderror">{{ old('body_second', $sms->body_second) }}</textarea>
                    @error('body_second')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Sender --}}
            <div class="form-group row">
                <label class="col-lg-3">Sender</label>
                <div class="col-lg-9">
                    <input @readonly(true) type="text"
                           name="sender"
                           class="form-control @error('sender') is-invalid @enderror"
                           value="{{ old('sender', $sms->sender) }}">
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
                        <option value="create" {{ old('status', $sms->status) == 'create' ? 'selected' : '' }}>Create</option>
                        <option value="sent" {{ old('status', $sms->status) == 'sent' ? 'selected' : '' }}>Sent</option>
                        <option value="paid" {{ old('status', $sms->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="complete" {{ old('status', $sms->status) == 'complete' ? 'selected' : '' }}>Complete</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
