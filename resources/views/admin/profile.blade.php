@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('admin/user')}}">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Update Profile</h6>

                    <form class="forms-sample" method="post" action="{{url('admin/user/add')}}">
                        @csrf  
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" placeholder="Name">
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Email <span style="color: red;">*</span></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="{{$user->email}}"  placeholder="Email">
                                <span style="color: red;">{{$errors->first('email')}}</span>
                            </div>
                        </div>
                       
                       
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Profile Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="profile"  >
                                <img class="wd-80 ht-80 rounded-circle" src="{{asset('upload/' . Auth::user()->photo )}}" alt="">
                                <span style="color: red;">{{$errors->first('profile')}}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password"  >
                                <span style="color: red;">{{$errors->first('password')}}</span>
                                (Leave blank if you are not changing the password)
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


</div>
@endsection