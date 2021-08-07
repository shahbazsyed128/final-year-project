@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Job Data</h1>
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
        @forelse ($jobs as $job)
            @if (!isset($job['user_application'][0]['pivot']['status']))
                <div class="card">
                    <div class="card-header">
                        {{ $job['category']['name'] }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $job['name'] }}</h5>
                        <p class="card-text">{{ $job['description'] }}</p>
                        @if ($job['user_application_count'])
                            <p>Applied on: <span
                                    class="badge badge-warning">{{ date('d-M-Y', strtotime($job['user_application'][0]['pivot']['created_at'])) }}</span>
                            </p>
                            <p>Status: <span
                                    class="badge badge-primary">{{ $job['user_application'][0]['pivot']['status'] ?? '' }}</span>
                            </p>
                        @else
                            <a href="{{ route('job.apply', $job['id']) }}" class="btn btn-primary">Apply for this job</a>
                        @endif
                    </div>
                </div>
            @endif
        @empty
            <div class="card">
                <div class="card-body">
                    <p class="card-text">There are no jobs available at the moment.</p>
                </div>
            </div>
        @endforelse
    </div>
@endsection
@push('scripts')

@endpush
