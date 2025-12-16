@extends('admin.layouts.app')

@section('title', 'Role Management')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'Role', 'sRoute' => route('roles.index'), 'third' => 'Index'])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Role Management',
        'pTitle' => 'Role ',
        'pSubtitle' => 'Create',
        'pSRoute' => route('roles.create'),
    ])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Role Management</h3>
            <div class="card-tools">
                <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create Role</a>
            </div>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Name</th>
                        <th width="5%"><i class="fas fa-eye"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $key => $role)
                        <tr>
                            <td>{{ '#' . ($role->id) }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <span>No data found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
