@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">My Courses</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">My Courses</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <h3>My courses</h3>
            </div>
            <div class="card-body p-0">
                <div class="row card-deck p-2">
                    @foreach ($courses as $course)
                        <div class="card col-md-4">
                            <div class="card-body">
                                <img src="{{ asset('img/course-cover.jpg') }}" class="card-img-top" alt="...">
                                <h4 class="card-title font-weight-bold mt-2"><a href="{{ route('user.view-course', $course->id) }}">{{ $course->name }}</a></h4>
                                <p class="card-text">{{ \illuminate\Support\Str::limit($course->description, 50, '...') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{-- {{ $courses->links() }} --}}
                </ul>
            </div>
        </div>



    @endsection
    @push('scripts')
        <script>

        </script>
    @endpush
