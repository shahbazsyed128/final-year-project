@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Job Applications</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Job</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @forelse ($applications as $application)
            @foreach ($application['user_application'] as $user)
                <div class="card">
                    <div class="card-header">
                        {{ $application['category']['name'] }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $application['name'] }}</h5>
                        <h5 class="card-title">Applicant: <a href="{{ route('company.user.view', $user['id']) }}"
                                data-toggle="tooltip" title="View Profile">{{ $user['name'] }}</a></h5>
                        <p>Applied on: <span
                                class="badge badge-warning">{{ date('d-M-Y H:i:s a', strtotime($user['pivot']['created_at'])) }}</span>
                            </br>
                            Status:
                            @if ($user['pivot']['status'] == 'Applied')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($user['pivot']['status'] == 'Hired')
                                <span class="badge badge-success">Hired</span>
                                <br>
                                Hired on: <span
                                    class="badge badge-warning">{{ date('d-M-Y H:i:s a', strtotime($user['pivot']['updated_at'])) }}</span>
                            @elseif($user['pivot']['status'] == 'Rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </p>
                    </div>
                    <div class="card-footer text-right">
                        @if ($user['pivot']['status'] == 'Applied')
                            <a href="{{ route('company.user.reject', [$user['id'], $application['id']]) }}" class="btn btn-danger btn-flat btn-sm">Reject</a>
                            <a href="{{ route('company.user.hire', [$user['id'], $application['id']]) }}"
                                class="btn btn-success btn-flat btn-sm">Hire</a>
                        @endif
                    </div>
                </div>
            @endforeach
        @empty
            <div class="card">
                <div class="card-body">
                    <p class="card-text">Post your first job.</p>
                </div>
            </div>
        @endforelse
    </div>
@endsection
@push('scripts')

@endpush
