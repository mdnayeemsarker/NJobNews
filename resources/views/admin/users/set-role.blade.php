@extends('admin.layouts.app')

@section('title', 'Set User Role')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'User Management',
        'sRoute' => route('user.manage'),
        'third'  => 'Set Role',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Set Role',
        'pTitle' => 'Users',
        'pSubtitle' => 'Set Role',
        'pSRoute' => route('user.manage'),
    ])
@endsection

@section('main_content')
<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">Set Role for {{ $user->name }}</h3>
        <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary btn-sm float-right">Back</a>
    </div>

    <form action="{{ route('user.update.role', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            {{-- User Name --}}
            <div class="form-group row">
                <label class="col-lg-4">Name:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $user->name }}</p>
                </div>
            </div>

            {{-- User Email --}}
            <div class="form-group row">
                <label class="col-lg-4">Email:</label>
                <div class="col-lg-8">
                    <p class="form-control-plaintext">{{ $user->email }}</p>
                </div>
            </div>

            {{-- Select Role --}}
            <div class="form-group row">
                <label class="col-lg-4">Role:</label>
                <div class="col-lg-8">
                    <select name="role_id" class="form-control" required>
                        <option value="">-- Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $user->role->contains($role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Update Role</button>
            <a href="{{ route('user.show', $user->id) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

</div>
@endsection
