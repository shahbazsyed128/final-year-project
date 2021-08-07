@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Quizzes</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Quiz</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <div class="float-right">

                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped ">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Title</th>
                            <th>Course</th>
                            <th>Duration</th>
                            <th>Questions</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quizzes as $key => $quiz)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $quiz['title'] }}</td>
                                <td>{{ $quiz['course']['name'] }}</td>
                                <td>{{ $quiz['duration'] . ' minutes' }}</td>
                                <td>{{ $quiz['total_questions'] }}</td>
                                <td>{{ $quiz['status']['title'] }}</td>
                                <td>
                                    <div class="flex">
                                        <a href="{{ route('quiz.edit', $quiz['id']) }}"><i class="fa fa-edit"></i></a> |
                                        <a href="{{ route('quiz.view', $quiz['id']) }}"><i class="fa fa-eye text-success"
                                                aria-hidden="true"></i></a> |
                                        <button type="button" data-id="{{ $quiz['id'] }}"
                                            class="bg-transparent  border-0 delete-quiz"><i class=" text-danger fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">

                <ul class="pagination pagination-sm m-0 float-right">

                </ul>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            $(".delete-quiz").click(function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('quiz/delete') }}/" + id;
                    }
                })
            });
        </script>
    @endpush
