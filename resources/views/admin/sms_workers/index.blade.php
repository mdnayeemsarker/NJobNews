@extends('admin.layouts.app')

@section('title', 'SMS Workers')

@section('nav_left')
    @include('admin.layouts.partials._left_nuv_bar', [
        'second' => 'SMS',
        'third' => 'Workers',
    ])
@endsection

@section('page_header')
    @include('admin.layouts.partials._page_header', [
        'title' => 'SMS Workers',
        'pTitle' => 'SMS',
        'pSubtitle' => 'Worker List',
        'pSRoute' => '#',
    ])
@endsection

@section('main_content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SMS Worker List</h3>
            <div class="card-tools {{ hasPermission('sms-workers.create') ? '' : 'd-none' }}">
                <a href="{{ route('sms-workers.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add SMS
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Receiver</th>
                        <th>Message</th>
                        <th>Sender</th>
                        <th>Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($smsWorkers as $key => $sms)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $sms->receiver }}</td>

                            <td>
                                <span title="{{ $sms->body }}">
                                    {{ \Illuminate\Support\Str::limit($sms->body, 40) }}
                                </span>
                            </td>

                            <td>{{ $sms->sender ?? '—' }}</td>

                            <td>
                                <span
                                    class="badge 
                                    @if ($sms->status == 'create') badge-secondary
                                    @elseif($sms->status == 'sent') badge-info
                                    @elseif($sms->status == 'paid') badge-warning
                                    @elseif($sms->status == 'complete') badge-success @endif">
                                    {{ ucfirst($sms->status) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('sms-workers.show', $sms->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('sms-workers.edit', $sms->id) }}" @disabled($sms->status != 'wait')
                                    class="btn btn-sm btn-warning @if ($sms->status != 'wait') disabled btn-secondary @endif">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('sms-workers.destroy', $sms->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No SMS records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $smsWorkers->links() }}
            </div>
        </div>
    </div>
@endsection
