@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left ml-2">
            <h2>EDIT User</h2>
        </div>
        <div class="pull-right">
            
        </div>
    </div>
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
       
        <form action="{{ route('users.update',$user->id) }}" method="POST" >
        @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group"> 
                    <label class="col-form-label" for="inputName"><i class="fas fa-user"></i> Name</label> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label class="col-form-label" for="inputEmail"><i class="fas fa-envelope"></i> Email</label> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" placeholder="Email" value="{{ $user->email }}" class="form-control">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group"> 
                    <label class="col-form-label" for="password"><i class="fas fa-lock"></i> Password</label>  
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" autocomplete="false" name="password" class="form-control" id="password" placeholder="Password" value="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label" for="confrim-password"><i class="fas fa-check"></i> Confirm Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-control-label" >Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" @if($user->status != 1 ) {{ 'selected="true"' }} @endif >  Inactive</option>
                            <option value="1" @if($user->status == 1 ) {{ 'selected="true"' }} @endif >  Active</option>
                           
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label class="form-control-label" >Role</label>
                        <select   name="role" class="form-control" required >
                            <option value="user" @if($user->role == 'user' ) {{ 'selected="true"' }} @endif >User</option>
                            <option value="admin" @if($user->role == 'admin' ) {{ 'selected="true"' }} @endif>Admin</option>
                            <option value="company" @if($user->role == 'company' ) {{ 'selected="true"' }}@endif>Company</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="float-right mt-4">
                        <button type="submit" class="btn btn-info"> <i class="fa fa-save"></i> Update User</button>
                        <a class="btn btn-danger" href="/users"> Cancel</a>    
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</div>

@endsection