@extends('admin.layouts.app')

@section('title', 'SMS Details')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'SMS Worker',
        'sRoute' => route('sms-workers.index'),
        'third' => 'Details',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'SMS Worker',
        'pTitle' => 'SMS Worker',
        'pSubtitle' => 'Details',
        'pSRoute' => route('sms-workers.index'),
    ])
@endsection

@section('main_content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">SMS Details</h3>
    </div>

    <div class="card-body">

        {{-- Receiver --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">Receiver Number</label>
            <div class="col-lg-9">
                <p class="form-control-plaintext">{{ $smsWorker->receiver }}</p>
            </div>
        </div>

        {{-- Sender --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">Sender</label>
            <div class="col-lg-9">
                <p class="form-control-plaintext">{{ $smsWorker->sender }}</p>
            </div>
        </div>

        {{-- Main Message --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">Message Body</label>
            <div class="col-lg-9">
                <textarea class="form-control" rows="3" readonly>{{ $smsWorker->body }}</textarea>
            </div>
        </div>

        {{-- First SMS --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">First SMS</label>
            <div class="col-lg-9">
                <textarea class="form-control" rows="2" readonly>{{ $smsWorker->first_sms ?? 'Waiting' }}</textarea>
            </div>
        </div>

        {{-- Second SMS --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">Second SMS</label>
            <div class="col-lg-9">
                <textarea class="form-control" rows="2" readonly>{{ $smsWorker->second_sms ?? 'Waiting' }}</textarea>
            </div>
        </div>

        {{-- Third SMS --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">Third SMS</label>
            <div class="col-lg-9">
                <textarea class="form-control" rows="2" readonly>{{ $smsWorker->third_sms ?? 'Waiting' }}</textarea>
            </div>
        </div>

        {{-- Status --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">Status</label>
            <div class="col-lg-9">
                @php
                    $statusColors = [
                        'create' => 'secondary',
                        'sent' => 'info',
                        'paid' => 'primary',
                        'complete' => 'success'
                    ];
                @endphp
                <span class="badge badge-{{ $statusColors[$smsWorker->status] ?? 'secondary' }}">
                    {{ strtoupper($smsWorker->status) }}
                </span>
            </div>
        </div>

        {{-- Created At --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">Created At</label>
            <div class="col-lg-9">
                <p class="form-control-plaintext">
                    {{ $smsWorker->created_at->format('d M Y, h:i A') }}
                </p>
            </div>
        </div>

        {{-- Updated At --}}
        <div class="form-group row">
            <label class="col-lg-3 font-weight-bold">Updated At</label>
            <div class="col-lg-9">
                <p class="form-control-plaintext">
                    {{ $smsWorker->updated_at->format('d M Y, h:i A') }}
                </p>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <a href="{{ route('sms-workers.paid', $smsWorker->id) }}" class="btn btn-primary">
            Paid
        </a>
        <a href="{{ route('sms-workers.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>
</div>
@endsection
