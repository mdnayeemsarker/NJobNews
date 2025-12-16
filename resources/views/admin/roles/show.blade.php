@extends('admin.layouts.app')

@section('title', 'Show Role')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Role',
        'sRoute' => route('roles.index'),
        'third' => 'Show',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Role Management',
        'pTitle' => 'Role',
        'pSubtitle' => 'Show',
        'pSRoute' => route('roles.index'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-0">Role Details</h3>
        </div>

        <div class="card-body">
            {{-- Role Name --}}
            <div class="form-group row mb-3">
                <label class="col-lg-3 fw-semibold">Role Name</label>
                <div class="col-lg-9">
                    <p class="form-control-plaintext">{{ $role->name }}</p>
                </div>
            </div>

            {{-- Permissions --}}
            @if($role->permissions->count())
                <div class="mb-2">
                    <h5 class="mb-2">Permissions:</h5>

                    @php
                        $permission_groups = $role->permissions->groupBy('section');
                    @endphp

                    @foreach($permission_groups as $section => $permissions)
                        <div class="bd-example mb-2">
                            <ul class="list-group">
                                <li class="list-group-item bg-light fw-semibold text-uppercase">
                                    {{ __(Str::headline($section)) }}
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        @foreach($permissions as $permission)
                                            <div class="col-md-3 mb-2">
                                                <span class="badge bg-primary">{{ Str::title(preg_replace('/[.\-_]+/', ' ', $permission->name)) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No permissions assigned.</p>
            @endif
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline-block"
                onsubmit="return confirm('Are you sure you want to delete this role?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
