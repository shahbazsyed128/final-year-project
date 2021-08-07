@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hired Applicants</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Hired Applicants</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card">
            <div class="card-header">
                <h5>Hired Users</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped ">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Hired On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td></td>
                            <td>{{$user['name']}}</td>
                            <td>{{$user['email']}}</td>
                            <td>{{ date('d-M-Y H:i:s a', strtotime($user['pivot']['created_at'])) }}</td>
                        </tr>
                        @empty
                            <tr>
                                <td>Empty</td>
                            </tr>
                        @endforelse
                      
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">

                <ul class="pagination pagination-sm m-0 float-right">
                    {{-- {{ $data->links() }} --}}
                </ul>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')

@endpush
