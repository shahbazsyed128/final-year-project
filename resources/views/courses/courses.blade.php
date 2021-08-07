@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Courses</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Courses</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    @can('isUser')
                        <a href="{{ route('courses.create') }}" class="btn btn-primary btn-flat">Start Course</a>
                    @endcan
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped ">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th style="width: 40px">Subject</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key => $course)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->category->name }}</td>
                                <td><span class="badge badge-info">{{ $course->subject }}</span></td>
                                <td><span class="badge badge-info">{{ $course->price }}</span></td>
                                <td>
                                    @if ($course->status) <span
                                            class="badge badge-success">Active</span>
                                    @else <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex">
                                        <a href="{{ route('courses.edit', $course->id) }}"><i
                                                class="fa fa-user-edit"></i></a> |
                                        <a href="{{ route('courses.show', $course->id) }}"><i
                                                class="fa fa-eye text-success" aria-hidden="true"></i></a> |

                                        <form action="{{ route('courses.destroy', $course->id) }}" class=" d-inline"
                                            method="POST" id="deletecourse{{ $course->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="ConfirmDelete({{ $course->id }})"
                                                class="bg-transparent  border-0"><i class=" text-danger fa fa-trash"
                                                    aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="7" class="bg-light">
                                    <p class="text-center mb-0">
                                        <a class="text-primary" href="{{ route('courses.create') }}">Start your first
                                            course</a>
                                    </p>
                                </th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $data->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function ConfirmDelete(id) {
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
                    Swal.fire(
                        'Deleted!',
                        'Your Record has been deleted.',
                        'success'
                    );
                    $("#deletecourse" + id).submit();

                }
            })
        }
    </script>
@endpush
