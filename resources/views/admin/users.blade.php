@extends('templates.layout_admin')
@section('coupons')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Catalogues</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Coupons</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top:10px;">
                    {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <div class="card-body">
                    <table id="users" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Basic Information</th>
                                <th>Contact Information</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle"> 
                                    <span class="text-uppercase">#{{ substr($user['_id'], 20, 4) }}</span></td>
                                    <td class="align-middle">
                                        
                                       <span class="text-secondary font-weight-bold">Name:</span> {{ $user['name'] }} <br>
                                        @if (isset($user['gender']) && $user['gender'] != "")
                                            <?= $user['gender'] == 1 ? '<span class="text-secondary font-weight-bold">Gender: </span> Male' : '<span class="text-secondary font-weight-bold">Gender: </span> Female' ?>
                                        @else
                                        <span class="text-secondary font-weight-bold">Gender: </span>  <i class="text-danger"> Doesn't have </i> 
                                        @endif <br>
                                        @if (isset($user['birthdate']) && $user['birthdate'] != "")
                                        <span class="text-secondary font-weight-bold">Birth date:</span> {{ $user['birthdate'] }}
                                        @else
                                        <span class="text-secondary font-weight-bold">Birth date:</span> <i class="text-danger"> Doesn't have </i> 
                                        @endif
                                    </td>
                                    <td class="align-middle"> 
                                        <span class="text-secondary font-weight-bold">Mobile:</span>  {{ $user['mobile'] }} <br> 
                                        <span class="text-secondary font-weight-bold">Email:</span>  {{ $user['email'] }}
                                    </td>
                                    <td class="align-middle">
                                        @if($user['address'] != "" | $user['city'] != "" | $user['state'] != "" ) 
                                       <span class="text-secondary font-weight-bold">Address:</span>  {{ $user['address'] }} <br>
                                       <span class="text-secondary font-weight-bold">City:</span>  {{ $user['city'] }} <br>
                                       <span class="text-secondary font-weight-bold">State:</span>  {{ $user['state'] }} <br>
                                       <span class="text-secondary font-weight-bold">Country:</span>  {{ $user['country'] }}
                                        @else
                                        <span class="text-secondary font-weight-bold">Address:</span>  <i class="text-danger">Doesn't have </i> <br>
                                       <span class="text-secondary font-weight-bold">City:</span>  <i class="text-danger">Doesn't have </i> <br>
                                       <span class="text-secondary font-weight-bold">State:</span>  <i class="text-danger">Doesn't have </i> <br>
                                       <span class="text-secondary font-weight-bold">Country:</span>  <i class="text-danger">Doesn't have </i>
                                        @endif
                                    </td>
                                    <td class="user_data align-middle">
                                        <input type="hidden" value="{{ $user['_id'] }}" class="idUser">
                                        @if ($user['status'] == 1)
                                            <a class="update-user-status" id="user-{{ $user['_id'] }}" href="#"><i
                                                    status="0" class="fa fa-toggle-on"></i></a>
                                        @else

                                            <a class="update-user-status" id="user-{{ $user['_id'] }}" href="#"><i
                                                    status="1" class="fa fa-toggle-off"></i></a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection
