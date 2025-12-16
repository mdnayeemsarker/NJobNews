@extends('admin.layouts.app')

@section('title', 'Edit Role')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'Role',
        'sRoute' => route('roles.index'),
        'third' => 'Edit',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Role Management',
        'pTitle' => 'Role',
        'pSubtitle' => 'Index',
        'pSRoute' => route('roles.index'),
    ])
@endsection

@section('main_content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title mb-0">Edit Role</h3>
        </div>

        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            <div class="card-body">
                {{-- Role Name --}}
                <div class="form-group row mb-2">
                    <label for="name" class="col-lg-3 fw-semibold">Role Name</label>
                    <div class="col-lg-9">
                        <input type="text" name="name" id="name" required
                            value="{{ old('name', $role->name) }}"
                            placeholder="Enter role name" class="form-control">
                    </div>
                </div>

                {{-- Permissions --}}
                @foreach ($permission_groups as $group)
                    <div class="bd-example mb-2">
                        <ul class="list-group">
                            <li class="list-group-item bg-light fw-semibold text-uppercase">
                                {{ __(Str::headline($group[0]['section'])) }}
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    @foreach ($group as $permission)
                                        <div class="col-md-3 mb-2">
                                            <div class="form-check custom-option custom-option-icon">

                                                {{-- Pre-check if assigned --}}
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       name="permissions[]"
                                                       value="{{ $permission->id }}"
                                                       id="permission_{{ $permission->id }}"
                                                       {{ in_array($permission->id, $assignedPermissions) ? 'checked' : '' }}>

                                                <label class="form-check-label custom-option-content"
                                                    for="permission_{{ $permission->id }}">
                                                    <span class="custom-option-body">
                                                        <span class="custom-option-title">
                                                            {{ __(Str::title(preg_replace('/[.\-_]+/', ' ', $permission->name))) }}
                                                        </span>
                                                    </span>
                                                </label>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
