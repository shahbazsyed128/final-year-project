@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Courses</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Courses</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <h3>View All courses</h3>
            </div>
            <div class="card-body p-0">
                <div class="row card-deck p-2">
                    @foreach ($courses as $course)
                        <div class="col-md-4">
                            <div class="card-body">
                                <img src="{{ asset('img/course-cover.jpg') }}" class="card-img-top" alt="...">
                                <h4 class="card-title font-weight-bold mt-2">{{ $course->name }}</h4>
                                <p class="card-text">{{ \illuminate\Support\Str::limit($course->summary, 50, '...') }}
                                </p>
                                @if (!$course['registered_course_count'])
                                    <h6><strong> {{ number_format($course->price) }}</strong></h6>
                                    <a href="{{ route('user.checkout', $course->id) }}"
                                        class="btn btn-block btn-outline-primary btn-sm float-right">Buy Now</a>
                                @else
                                    <span class="badge badge-warning rounded-0">
                                        Purchased
                                    </span>
                                    <h6>
                                        <a class="btn btn-block btn-outline-primary btn-sm" href="{{ route('user.view-course', $course->id) }}">Go to course now</a>
                                    </h6>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $courses->links() }}
                </ul>
            </div>
        </div>



    @endsection
    @push('scripts')
        <script>

        </script>
    @endpush
