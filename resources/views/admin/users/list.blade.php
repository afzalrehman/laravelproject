@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    @include('_message')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users List</li>
        </ol>

        <div class="d-flex align-items-center">
            <a href="javascript:valid(0)" class="btn btn-info">{{$TotalAdmin}} Admin</a>&nbsp;&nbsp;
            <a href="javascript:valid(0)" class="btn btn-warning">{{$TotalAgent}} Agent</a>&nbsp;&nbsp;
            <a href="javascript:valid(0)" class="btn btn-secondary">{{$TotalUser}} User</a>&nbsp;&nbsp;
            <a href="javascript:valid(0)" class="btn btn-primary">{{$TotalActive}} Active</a>&nbsp;&nbsp;
            <a href="javascript:valid(0)" class="btn btn-danger">{{$TotalInactive}} In Active</a>&nbsp;&nbsp;
            <a href="javascript:valid(0)" class="btn btn-success">{{$Total}} Total</a>&nbsp;&nbsp;
        </div>
    </nav>
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        Search Users
                    </h6>
                    <form action="" method="get">
                        <div class="row">

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="">ID</label>
                                    <input type="text" class="form-control" name="id" value="{{Request()->id}}" placeholder="Enter ID">
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" value="{{Request()->name}}" name="name" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" value="{{Request()->username}}" name="username" placeholder="Enter Username">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="">Email Id</label>
                                    <input type="email" class="form-control" value="{{Request()->email}}" name="email" placeholder="Enter Email ID">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="">Phone</label>
                                    <input type="email" class="form-control" value="{{Request()->phone}}" name="phone" placeholder="Enter Phone">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="">Website</label>
                                    <input type="email" class="form-control" value="{{Request()->website}}" name="website" placeholder="Enter Website">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="">Role</label>
                                    <select name="role" class="form-control" id="">
                                        <option value="">Select Role</option>
                                        <option {{(Request()->role == 'admin' ? 'selected' :'')}} value="admin">Admin</option>
                                        <option {{(Request()->role == 'agent' ? 'selected' :'')}} value="agent">Agent</option>
                                        <option {{(Request()->role == 'user' ? 'selected' :'')}} value="user">User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="">Select Status</option>
                                        <option {{(Request()->status == 'active' ? 'selected' :'')}} value="active">Active</option>
                                        <option {{(Request()->status == 'inactive' ? 'selected' :'')}} value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="">Start Date</label>
                                    <input type="date" class="form-control" value="{{Request()->start_Date}}" name="start_Date" placeholder="Enter Start Date">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="">End Date</label>
                                    <input type="date" class="form-control" value="{{Request()->end_Date}}" name="end_Date" placeholder="Enter End Date">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Search</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">User List</h4>
                        <div class="d-flex align-items-center">
                            <a href="{{url('admin/user/add')}}" class="btn btn-primary">User Add</a>
                        </div>
                    </div>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Webstie</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecords as $values)
                                <form class="a_form{{$values->id}}" method="post">
                                    @csrf

                                    <tr class="table-info text-dark">
                                        <td>{{$values->id}}</td>

                                        <td style="min-width: 150px;">
                                            <input type="hidden" class="" name="edit_id" value="{{$values->id}}">
                                            <input type="text" class="form-control" name="edit_name" value="{{old('name' , $values->name)}}">
                                            <button type="button" class="btn btn-success submitfform my-2" id="{{$values->id}}">Save</button>
                                        </td>

                                        <td>{{$values->username}}</td>
                                        <td>{{$values->email}}</td>

                                        <td>
                                            @if (!empty($values->photo))
                                            <img src="{{asset('upload/'.$values->photo)}}" style="width: 100%; height:100%;" alt="">
                                            @endif
                                        </td>

                                        <td>{{$values->phone}}</td>
                                        <td>{{$values->website}}</td>
                                        <td>{{$values->address}}</td>
                                        <td>
                                            @if ($values->role == 'admin')
                                            <span class="badge bg-info">Admin</span>
                                            @elseif($values->role == 'agent')
                                            <span class="badge bg-primary">Agent</span>
                                            @elseif($values->role == 'user')
                                            <span class="badge bg-success">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- @if ($values->status == 'active')
                                            <span class="badge bg-primary">Active</span>
                                            @elseif($values->status == 'inactive')
                                            <span class="badge bg-danger">Inactive</span>
                                            @endif -->

                                            <select name="status" style="min-width: 80px;" class="form-control changeStatus" id="{{$values->id}}">
                                                <option {{ ($values->status == 'active' ?'selected' :'')}} value="active">Active</option>
                                                <option {{ ($values->status == 'inactive' ?'selected' :'')}} value="inactive">Inactive</option>
                                            </select>
                                        </td>
                                        <td>{{date('d-m-Y' , strtotime($values->created_at))}}</td>
                                        <td><a class="dropdown-item d-flex align-items-center" href="{{url('admin/user/view/' .$values->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye icon-sm me-2">
                                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg> <span class="">View</span></a>

                                            <a class="dropdown-item d-flex align-items-center" href="{{url('admin/user/edit/' .$values->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm me-2">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                </svg> <span class="">Edit</span></a>

                                            <a class="dropdown-item d-flex align-items-center" href="{{url('admin/user/delete/' .$values->id)}}" onclick="return confirm('Are You Sure you Want to Delete?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm me-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg> <span class="">Delete</span></a>
                                        </td>
                                    </tr>
                                </form>
                                @empty
                                <tr>
                                    <td colspan="10">No Record Found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div style="padding: 20px; float: right;">
                            {{$getRecords->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $('table').delegate('.submitfform', 'click', function() {
        var id = $(this).attr('id');
        $.ajax({
            url: "{{ url('admin/user/updated/') }}",
            method: "POST",
            data: $('.a_form' + id).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.success);
            }
        });
    });

    $('.changeStatus').change(function() {
        var status_id = $(this).val();
        var order_id = $(this).attr('id');


        $.ajax({
            type: "GET",
            url: "{{ url('admin/user/ChangeStatus/') }}",
            data: {
                status_id: status_id,
                order_id: order_id
            },
            dataType: 'json',
           
            success: function(data) {
                // alert(response.success);
                alert('Status Successfuly Change');
                window.location.href = ""
            }
        });
    });
</script>

@endsection