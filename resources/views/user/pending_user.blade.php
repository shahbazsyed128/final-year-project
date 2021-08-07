@extends('layouts.master')
@section('content')
     <!-- Content Header (Page header) -->
     <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0">Pending Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Pending Users</li>
              </ol>
          </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
<div class="card">
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Name</th>
          <th>Email</th>
          <th style="width: 40px">Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @if(count($data)>0)
        @foreach ($data as $key => $user)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
                <label class="badge badge-success"></label>
            
          </td>
          <td>
            <a  href="{{ route('users.destroy',$user->id) }}"  onclick="ConfirmDelete(event)" data-toggle="tooltip" title="Reject & Delete" ><i class="fas fa-window-close text-danger"></i></a> | 
            <a  href="{{ route('users.approve',$user->id) }}" data-toggle="tooltip" title="Approve" ><i class="fa fa-check text-success" aria-hidden="true"></i></a> 
          </td>
        </tr>
        @endforeach
        @else
        <tr>
          <th colspan="5" class="bg-light"><p class="text-center text-primary mb-0">There is no Remaining pending Users</p></th>
        </tr>
        @endif
       
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
@endsection