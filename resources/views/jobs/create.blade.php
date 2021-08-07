@extends('layouts.master')
@push('links')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush
@section('content')
<div class="container-fluid">
    <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add job</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Add job</li>
                </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="card card-primary p-4">
       
        <form action="{{ route('jobs.store') }}" method="POST" >
        @csrf
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="form-group"> 
                    <label class="col-form-label" for="inputName"><i class="fas fa-book"></i> job Name</label> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <input type="text" required name="name" placeholder="job Name" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label class="col-form-label" for="inputEmail"><i class="fas fa-book"></i> job Type</label> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <select  required name="category_id" placeholder="job Category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as  $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group"> 
                    <label class="col-form-label" for="description"><i class="fas fa-book"></i> Description</label>  
                       <textarea name="description" id="description" placeholder="Description" class="textarea"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-control-label" >Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>   
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="float-right mt-4">
                        <button type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Add job</button>
                        <a class="btn btn-danger" href="/users"> Cancel</a>    
                    </div>
                </div>
                
            </div>
            
        </form>

    </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        // Summernote
        $('.textarea').summernote({
            height: 150,
        });
    });
</script>

@endpush