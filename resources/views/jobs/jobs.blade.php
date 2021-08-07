@extends('layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
<div class="container-fluid">
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registered Jobs</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Jobs</li>
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
            <th>Name</th>
            <th>Type</th>
            <!-- <th style="width: 40px">Subject</th> -->
            <!-- <th>Price</th> -->
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @if(count($data)>0)
          @foreach ($data as $key => $job)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $job->name }}</td>
            <td>{{ $job->category->name }}</td>
            <!-- <td><span class="badge badge-info">{{ $job->subject }}</span></td> -->
            <!-- <td><span class="badge badge-info">{{ $job->price }}</span></td> -->
            <td> @if ($job->status) <span class="badge badge-success">Active</span> @else  <span class="badge badge-danger">Inactive</span>  @endif</td>
            <td>
            <div class="flex">
            <a href="{{ route('jobs.edit',$job->id) }}"><i class="fa fa-user-edit"></i></a> | 
              <a  href="{{ route('jobs.show',$job->id) }}"><i class="fa fa-eye text-success" aria-hidden="true"></i></a> |

              <form action="{{ route('jobs.destroy',$job->id) }}" class=" d-inline"method="POST" id="deletejob{{$job->id}}"> 
                 @csrf
                @method('DELETE')
              <button type="button"  onclick="ConfirmDelete({{ $job->id }})" class="bg-transparent  border-0" ><i class=" text-danger fa fa-trash" aria-hidden="true"></i></button>  
              </form>
            </div>
            </td>
          </tr>
          @endforeach
          @else
        <tr>
          <th colspan="5" class="bg-light"><p class="text-center text-primary mb-0">There is no Registered jobs</p></th>
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
          $("#deletejob"+id).submit();

        }
      })
  }
</script>
@endpush