@extends('admin.layouts.app')

@section('title', 'Unique Visitors')
@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', ['second' => 'visitor', 'third' => 'Unique Visitors'])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'Unique Visitors',
        'pTitle' => 'Unique Visitors',
    ])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Unique Visitors List</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="11%">Date</th>
                        <th>Unique Users</th>
                        <th>Unique IPs</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visitors as $date => $visitor)
                        <tr>
                            <td>{{ $date }}</td>
                            <td>{{ $visitor['unique_users'] }}</td>
                            <td>{{ $visitor['unique_ips'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                <span>No data found</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-2">
                {{ $visitors->links() }}
            </div>
        </div>
    </div>
@endsection
