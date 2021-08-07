@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 p-4">
            <div class="float-left">
                <h2> Show User</h2>
            </div>
            <div class="float-right">
                <button class="btn btn-primary" onclick="goBack()"> Back</button>
            </div>
        </div>
    </div>


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
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

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    {{-- <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            @if ($user->grad_uni && $user->grad_degree && $user->grad_year)
                                <p class="text-muted">
                                    {{ $user->grad_degree }} From {{ $user->grad_uni }}
                                </p>
                            @endif
                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">Location Not Added</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                                enim neque.</p>
                        </div>
                        <!-- /.card-body -->
                    </div> --}}
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings"
                                        data-toggle="tab">Settings</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Academic
                                        Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#experience" data-toggle="tab">Professional
                                        Details</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings">
                                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="inputName"><i
                                                            class="fas fa-user"></i> Name</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-user"></i></span>
                                                        </div>
                                                        <input type="text" name="name" placeholder="Name"
                                                            class="form-control" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="inputEmail"><i
                                                            class="fas fa-envelope"></i> Email</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <input type="email" name="email" placeholder="Email"
                                                            value="{{ $user->email }}" class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="password"><i class="fas fa-lock"></i>
                                                        Password</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-lock"></i></span>
                                                        </div>
                                                        <input type="password" autocomplete="false" name="password"
                                                            class="form-control" id="password" placeholder="Password"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="confrim-password"><i
                                                            class="fas fa-check"></i> Confirm Password</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-lock"></i></span>
                                                        </div>
                                                        <input type="password" name="confirm-password" class="form-control"
                                                            id="confirm-password" placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6">
                                                <div class="float-right mt-4">
                                                    <button type="submit" class="btn btn-info"> <i class="fa fa-save"></i>
                                                        Update User</button>
                                                    <a class="btn btn-danger" href="/users"> Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="container">
                                        <form action="{{ route('userupdate', $user->id) }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="text-primary">Matriculation</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="inputSchool"><i
                                                                class="fas fa-school"></i> School Name</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-school"></i></span>
                                                            </div>
                                                            <input type="text" required id="inputSchool" name="school"
                                                                placeholder="School Name" class="form-control"
                                                                value="@if ($user->school) {{ $user->school }} @endif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="inputMGroup"><i
                                                                class="fas fa-book"></i> Group</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-book"></i></span>
                                                            </div>
                                                            <input type="text" required id="inputMGroup" name="ssc_group"
                                                                placeholder="Science / Arts / Commerce" value="@if ($user->ssc_group) {{ $user->ssc_group }} @endif"
                                                            class="form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="passing-year"><i
                                                                class="fas fa-calendar"></i> Passing Year</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" name="ssc_year"
                                                                value="{{ $user->ssc_year ?? '' }}" id="passing-year"
                                                                class="form-control" placeholder="dd/MM/YYY">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="ssc-percentage"><i
                                                                class="fas fa-percent"></i> Marks in Percentage</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-percent"></i></span>
                                                            </div>
                                                            <input type="number" required min="0" max="100"
                                                                value="{{ $user->ssc_percentage ?? '' }}" step="0.1"
                                                                name="ssc_percentage" class="form-control"
                                                                id="ssc-percentage" placeholder="100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="text-primary">Intermediate</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="inputCollage"><i
                                                                class="fas fa-university"></i> Collage Name</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-university"></i></span>
                                                            </div>
                                                            <input type="text" required id="inputCollage" name="collage"
                                                                placeholder="Collage Name" class="form-control"
                                                                value="{{ $user->collage ?? '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="inputMGroup"><i
                                                                class="fas fa-book"></i> Group</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-book"></i></span>
                                                            </div>
                                                            <input type="text" required id="inputMGroup" name="hsc_group"
                                                                placeholder="Pre-Engr / Pre-Medical / Commerce"
                                                                value="{{ $user->hsc_group ?? '' }}" class="form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="passing-year"><i
                                                                class="fas fa-calendar"></i> Passing Year</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" name="hsc_year"
                                                                value="{{ $user->hsc_year ?? '' }}" id="passing-year"
                                                                class="form-control" placeholder="dd/MM/YYY">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="hsc-percentage"><i
                                                                class="fas fa-percent"></i> Marks in Percentage</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-percent"></i></span>
                                                            </div>
                                                            <input type="number" required min="0" max="100"
                                                                value="{{ $user->hsc_percentage ?? '' }}" step="0.1"
                                                                name="hsc_percentage" class="form-control"
                                                                id="hsc-percentage" placeholder="100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="text-primary">Graduation / Masters</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="inputGrad"><i
                                                                class="fas fa-user-graduate"></i> University Name</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-user-graduate"></i></span>
                                                            </div>
                                                            <input type="text" required id="inputGrad" name="grad_uni"
                                                                placeholder="University Name" class="form-control"
                                                                value="{{ $user->grad_uni ?? '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="inputMGroup"><i
                                                                class="fas fa-book"></i> Degree Title</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-book"></i></span>
                                                            </div>
                                                            <input type="text" required id="inputMGroup" name="grad_degree"
                                                                placeholder="MBA / BBA / MBBS"
                                                                value="{{ $user->grad_degree ?? '' }}"
                                                                class="form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="passing-year"><i
                                                                class="fas fa-calendar"></i> Passing Year</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" name="grad_year"
                                                                value="{{ $user->grad_year ?? '' }}" id="passing-year"
                                                                class="form-control" placeholder="dd/MM/YYY">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="grad-percentage"><i
                                                                class="fas fa-percent"></i> Marks in Percentage</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-percent"></i></span>
                                                            </div>
                                                            <input type="number" required min="0" max="100"
                                                                value="{{ $user->grad_percentage ?? '' }}" step="0.1"
                                                                name="grad_percentage" class="form-control"
                                                                id="grad-percentage" placeholder="100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <div class="float-right mt-4">
                                                        <button type="submit" class="btn btn-info"> <i
                                                                class="fa fa-save"></i> Update User</button>
                                                        <a class="btn btn-danger" href="/users"> Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="experience">
                                    <div class="container">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3>Job Experience</h3>
                                            </div>
                                            <div class="col-sm-6">
                                                <button class="btn btn-primary float-right" onclick="addExp();"><i
                                                        class="fa fa-plus"></i> Add Experience</button>
                                            </div>
                                        </div>
                                        <form action="{{ route('userupdate', $user->id) }}" method="POST">
                                            @csrf
                                            <div id="exp-div">
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @if ($user->experiences)
                                                    @if (count($user->experiences) >= 1)
                                                        @foreach ($user->experiences as $key => $expereicne)
                                                            <div class="row" id="exp-row{{ $key }}">
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label" for="inputGrad"><i
                                                                                class="fas fa-building"></i>Company
                                                                            Name</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i
                                                                                        class="fas fa-building"></i></span>
                                                                            </div>
                                                                            <input type="text" required id="inputGrad"
                                                                                name="company_name[{{ $key }}]"
                                                                                placeholder="Company Name"
                                                                                class="form-control"
                                                                                value="{{ $expereicne['company_name'] ?? '' }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label" for="inputPos"><i
                                                                                class="fas fa-cog"></i>Position</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i
                                                                                        class="fas fa-cog"></i></span>
                                                                            </div>
                                                                            <input type="text" required id="inputPos"
                                                                                name="position[{{ $key }}]"
                                                                                placeholder="Position in Company"
                                                                                class="form-control"
                                                                                value="{{ $expereicne['position'] ?? '' }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label" for="inputExyear"><i
                                                                                class="fas fa-book"></i> Experience in
                                                                            Months</label>
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i
                                                                                        class="fas fa-book"></i></span>
                                                                            </div>
                                                                            <input type="number" required min="0"
                                                                                id="inputExyear"
                                                                                name="exp_month[{{ $key }}]"
                                                                                value="{{ $expereicne['exp_month'] ?? '' }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <button class="bg-transparent  border-0 mt-4"
                                                                        onclick="deleteExp({{ $key }})"><i
                                                                            class="fa fa-trash text-danger"></i></button>
                                                                </div>
                                                            </div>
                                                            @php
                                                                $i = $i + 1;
                                                            @endphp
                                                        @endforeach
                                                    @endif
                                                @else
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="inputGrad"><i
                                                                        class="fas fa-building"></i>Company Name</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-building"></i></span>
                                                                    </div>
                                                                    <input type="text" required id="inputGrad"
                                                                        name="company_name[]" placeholder="Company Name"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="inputPos"><i
                                                                        class="fas fa-cog"></i>Position</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-cog"></i></span>
                                                                    </div>
                                                                    <input type="text" required id="inputPos"
                                                                        name="position[]" placeholder="Position in Company"
                                                                        class="form-control" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label class="col-form-label" for="inputExyear"><i
                                                                        class="fas fa-book"></i> Experience in
                                                                    Months</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-book"></i></span>
                                                                    </div>
                                                                    <input type="number" required min="0" id="inputExyear"
                                                                        name="exp_month[]" value="" class="form-control">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"></div>
                                                <div class="col-sm-6">
                                                    <div class="float-right mt-4">
                                                        <button type="submit" class="btn btn-info"> <i
                                                                class="fa fa-save"></i> Update User</button>
                                                        <a class="btn btn-danger" href="/users"> Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
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
    @push('scripts')
        <script type="text/javascript">
            var exp_row = {{ $i }};

            function addExp() {
                html = '<div class="row" id="exp-row' + exp_row +
                    '"><div class="col-sm-4"><div class="form-group"><label class="col-form-label" for="inputGrad"><i class="fas fa-building"></i>Company Name</label>';
                html +=
                    '<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-building"></i></span></div>';

                html += '<input type="text" required id="inputGrad" name="company_name[' + exp_row +
                    ']" placeholder="Company Name" class="form-control" value=""></div></div></div>';

                html +=
                    '<div class="col-sm-4"><div class="form-group"><label class="col-form-label" for="inputPos"><i class="fas fa-cog"></i>Position</label>';
                html +=
                    '<div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-cog"></i></span></div><input type="text" required id="inputPos" name="position[' +
                    exp_row + ']" placeholder="Position in Company" class="form-control" value="">';
                html += '</div></div></div>';

                html +=
                    '<div class="col-sm-3"><div class="form-group"><label class="col-form-label" for="inputExyear"><i class="fas fa-book"></i> Experience in Months</label><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-book"></i></span></div>';
                html += '<input type="number" required  min="0" id="inputExyear" name="exp_month[' + exp_row +
                    ']" value="" class="form-control"></div></div></div>';

                html += '<div class="col-sm-1"><button class="bg-transparent  border-0" onclick="deleteExp(' + exp_row +
                    ')"><i class="fa fa-trash text-danger mt-4"></i></button></div></div>';

                $('#exp-div').append(html);
                exp_row++;
            }

            function deleteExp(row) {
                $('#exp-row' + row).remove();
            }
        </script>
    @endpush
@endsection
