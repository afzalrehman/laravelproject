@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin/user')}}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Update</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Add Users </h6>

                    <form class="forms-sample" method="post" action="{{url('admin/user/update/'. $user->id)}}">
                        @csrf  
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Username <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" value="{{$user->username}}" placeholder="Username">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Email <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" autocomplete="off" placeholder="Email">
                                <span style="color: red;">{{$errors->first('email')}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Phone <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone" value="{{$user->phone}}" placeholder="Phone number">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Role <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <select name="role" class="form-control">
                                    <option value="">Select Role</option>
                                    <option {{($user->role == 'admin' ? 'selected' :'')}} value="admin">Admin</option>
                                    <option {{($user->role == 'agent' ? 'selected' :'')}} value="agent">Agent</option>
                                    <option {{($user->role == 'user' ? 'selected' :'')}} value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option {{($user->status == 'active' ? 'selected' :'')}} value="active">Active</option>
                                    <option {{($user->status == 'inactive' ? 'selected' :'')}} value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <a href="{{url('admin/user')}}" class="btn btn-secondary">Back</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>


</div>
@endsection