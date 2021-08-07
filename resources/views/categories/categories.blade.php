@extends('layouts.master')
@section('content')
  <!-- Content Header (Page header) -->
<div class="container-fluid">
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registered Categories</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <div class="card">
    <div class="card-header">
    <div class="float-right">
      <a href="#" data-toggle="modal" data-target="#AddNewCategory" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>
    </div>
    <div class="card-body p-0">
      <table class="table table-hover table-striped ">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @if(count($data)>0)
          @foreach ($data as $key => $category)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $category->name }}</td>
         
            <td>
            <div class="flex">
             
            <a href="#" data-toggle="modal" data-target="#EditCategory"  onclick="EditModal({{ $category->id }})"><i class="fa fa-edit"></i></a> | 

              <form action="{{ route('categories.destroy',$category->id) }}" class=" d-inline" method="POST" id="deletecategory{{$category->id}}"> 
                 @csrf
                 @method('DELETE')
              <button type="button"  onclick="ConfirmDelete({{ $category->id }})" class="bg-transparent  border-0" ><i class=" text-danger fa fa-trash" aria-hidden="true"></i></button>  
              </form>
              
            </div>
            </td>
          </tr>
          @endforeach
          @else
        <tr>
          <th colspan="3" class="bg-light"><p class="text-center text-primary mb-0">There is no Registered Categories</p></th>
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

  <div class="modal fade" id="EditCategory" tabindex="-1" aria-labelledby="EditCategory" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"  id="AddNewCategoryLabel">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editcategoryform" action="" method="post">
                    {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name"  id="cat-name" required  placeholder="Enter Category Name" class="form-control" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        
                            <button type="submit"  class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  </div>
  <div class="modal fade" id="AddNewCategory" tabindex="-1" aria-labelledby="AddNewCategoryLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"  id="AddNewCategoryLabel">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addcategoryform" action="{{route('addcategory')}}" method="post">
                    {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name"  required value="{{ old('name') }}"  placeholder="Enter Category Name" class="form-control" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        
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
 function EditModal(id) {
    $('#editcategoryform').attr('action', "{{ url('/categories/update/') }}/"+id);

      $.ajax({
          type: "GET",
          url: "{{ url('/categories/edit/')}}/"+id,
          success: function(data) {
              // console.log(data.name);
              $("#cat-name").val(data.name);
          }
      });

 }

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
          $("#deletecategory"+id).submit();

        }
      })
  }
</script>
@endpush