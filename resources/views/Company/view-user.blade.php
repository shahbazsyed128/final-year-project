@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/logo.jpg') }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"> {{ $user->name }}</h3>

                                <p class="text-muted text-uppercase text-center"> {{ $user->role }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Cource Enrolled</b> <a class="float-right">{{ $courses_enrolled ?? 0 }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Course Completed</b> <a class="float-right">{{ $courses_completed ?? 0 }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Course Published</b> <a class="float-right">{{ $courses_published ?? 0 }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Course Sold</b> <a class="float-right">{{ $courses_sold ?? 0 }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                               <h5>User Details</h5>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-pane">
                                    <!-- The timeline -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="text-primary"><i class="fas fa-school"></i> Matriculation
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <p><span class="font-weight-bold">{{ $user->school ?? '' }}</span>
                                                        <br />
                                                        Group: {{ $user->ssc_group ?? '' }}
                                                        <br />
                                                        Passing Year: {{ $user->ssc_year ?? '' }}
                                                        <br />
                                                        Percentage: {{ $user->ssc_percentage ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="text-primary"><i class="fas fa-university"></i> Intermediate
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <p><span class="font-weight-bold">{{ $user->collage ?? '' }}</span>
                                                        <br />
                                                        Group: {{ $user->hsc_group ?? '' }}
                                                        <br />
                                                        Passing Year: {{ $user->hsc_year ?? '' }}
                                                        <br />
                                                        Percentage: {{ $user->hsc_percentage ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="text-primary"><i class="fas fa-user-graduate"></i> Graduation
                                                    / Masters</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <p><span class="font-weight-bold">{{ $user->grad_uni ?? '' }}</span>
                                                        <br />
                                                        Degree: {{ $user->grad_degree ?? '' }}
                                                        <br />
                                                        Passing Year: {{ $user->grad_year ?? '' }}
                                                        <br />
                                                        Percentage: {{ $user->grad_percentage ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h3 class="text-primary"><i class="fas fa-user-graduate"></i> Experience
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div id="exp-div">
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @if ($user->experiences)
                                                        @if (count($user->experiences) >= 1)
                                                            @foreach ($user->experiences as $key => $expereicne)
                                                                <div class="row" id="exp-row{{ $key }}">
                                                                    <div class="col-sm-12">
                                                                        <p>
                                                                            <span class="font-weight-bold">{{ $expereicne['company_name'] ?? '' }}</span>
                                                                            <br>
                                                                            <span class="">Postion: {{ $expereicne['position'] ?? '' }}</span>
                                                                            <br>
                                                                            <span class="">Duration: {{ $expereicne['exp_month']??0 }} Months</span>
                                                                        </p>
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $i = $i + 1;
                                                                @endphp
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
@push('scripts')

@endpush
