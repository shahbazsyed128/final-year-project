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
            <div class="card">
                <div class="card-header">
                    {{ $job['category']['name'] }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $job['name'] }}</h5>
                    <p class="card-text">{{ $job['description'] }}</p>
                    <p>Applied on: <span
                            class="badge badge-warning">{{ date('d-M-Y', strtotime($job['pivot']['created_at'])) }}</span>
                    </p>
                    <p>Status:
                        @if ($job['pivot']['status'] == 'Applied')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($job['pivot']['status'] == 'Hired')
                            <span class="badge badge-success">Hired</span>
                            <br>
                            Hired on: <span
                                class="badge badge-warning">{{ date('d-M-Y H:i:s a', strtotime($job['pivot']['updated_at'])) }}</span>
                        @elseif($job['pivot']['status'] == 'Rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </p>

                </div>
            </div>
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
