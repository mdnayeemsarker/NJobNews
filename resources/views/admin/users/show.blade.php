@extends('admin.layouts.app')

@section('title', 'User')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Users',
        'sRoute' => route('user.manage'),
        'third' => 'Show',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Users',
        'pTitle' => 'Users',
        'pSubtitle' => 'Show',
        'pSRoute' => route('user.manage'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">User Details</h3>
        </div>

        <div class="card-body">

            {{-- Name --}}
            <div class="form-group row">
                <label class="col-lg-4">Name:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $user->name }}</p>
                </div>
            </div>

            {{-- Email --}}
            <div class="form-group row">
                <label class="col-lg-4">Email:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $user->email }}</p>
                </div>
            </div>
            {{-- Role --}}
            <div class="form-group row">
                <label class="col-lg-4">Role:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">
                        {{ $user->role->pluck('name')->join(', ') }}
                    </p>
                </div>
            </div>
            {{-- Status --}}
            <div class="form-group row">
                <label class="col-lg-4">Status:</label>
                <div class="col-lg-8">
                    <label class="switch">
                        <input type="checkbox" class="toggle-status" data-id="{{ $user->id }}"
                            {{ $user->status ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <a href="{{ route('user.set.role', $user->id) }}" class="btn btn-primary">Set Role</a>
        </div>

    </div>
@endsection
