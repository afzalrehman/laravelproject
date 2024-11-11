@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin/user')}}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Add</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Add Users </h6>

                    <form class="forms-sample" method="post" action="{{url('admin/user/add')}}">
                        @csrf  
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Username <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="username" value="{{old('username')}}" placeholder="Username">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Email <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="{{old('email')}}" autocomplete="off" placeholder="Email">
                                <span style="color: red;">{{$errors->first('email')}}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Phone <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Phone number">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Role <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <select name="role" class="form-control">
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="agent">Agent</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Status <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <select name="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{url('admin/user')}}" class="btn btn-secondary">Back</a>
                    </form>

                </div>
            </div>
        </div>
    </div>


</div>
@endsection