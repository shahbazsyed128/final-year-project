@extends('layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
<div class="container-fluid">
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registered Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
                </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="card">
    <div class="card-header">
      <div class="float-right">
      
        <a href="#" data-toggle="modal" data-target="#AddNewUser" class="btn btn-primary"><i class="fas fa-user-plus"></i></a>
      </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-hover table-striped ">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Email</th>
            <th style="width: 40px">Role</th>
            <th>Status</th>
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
            <td><span class="badge badge-info">{{ $user->role }}</span></td>
            <td> @if ($user->status) <span class="badge badge-success">Active</span> @else  <span class="badge badge-danger">Inactive</span>  @endif</td>
            <td>
            <div class="flex">
            <a href="{{ route('users.edit',$user->id) }}"><i class="fa fa-user-edit"></i></a> | 
              <a  href="{{ route('users.show',$user->id) }}"><i class="fa fa-eye text-success" aria-hidden="true"></i></a> |

              <form action="{{ route('users.destroy',$user->id) }}"  class="d-inline" id="deleteuser{{$user->id}}" method="POST"> 
                 @csrf
                @method('DELETE')
              <button type="button" onclick="ConfirmDelete({{ $user->id }})" class="bg-transparent  border-0" ><i class=" text-danger fa fa-trash" aria-hidden="true"></i></button>  
              </form>
            </div>

            </td>
          </tr>
          @endforeach
          @else
        <tr>
          <th colspan="6" class="bg-light"><p class="text-center text-primary mb-0">There is no Registered Users</p></th>
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
  <div class="modal fade" id="AddNewUser" tabindex="-1" aria-labelledby="AddNewUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <h5 class="modal-title"  v-show="editmode"  id="AddNewUserLabel">Update User's Info</h5> -->
                        <h5 class="modal-title"  id="AddNewUserLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="adduserform" action="/adduser" method="post">
                    {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name"  required  placeholder="Enter Name" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input  type="email" name="email" required  placeholder="Email Address" class="form-control">
                            </div>
                            <div class="form-group">
                                <select   name="role" class="form-control" required >
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="company">Company</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input  type="password" name="password" required placeholder="Enter Password"
                                    class="form-control" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <!-- <button type="submit" v-show="editmode" class="btn btn-success">Update</button> -->
                            <button type="submit"  class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
@push('scripts')

<script>

function ConfirmDelete(id) {
  // event.preventDefault();
  var url=event.currentTarget.getAttribute('href');
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
          )
          // window.location.href=url;
          $("#deleteuser"+id).submit();

        }
      })
  }
</script>
@endpush