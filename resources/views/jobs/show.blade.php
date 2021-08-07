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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Job</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-primary">{{ $job->name }}</h3>
                <h6 class="text-secondary">{{ $job->category->name }}</h6>
                <div class="card p-4">
                    <p>{!! $job->description !!}</p>
                </div>
            </div>

            <!-- /.card-body -->
            <div class="">

            </div>
        </div>
    @endsection
    @push('scripts')

    @endpush
