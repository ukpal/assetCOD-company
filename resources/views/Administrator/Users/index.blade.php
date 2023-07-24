@extends('Administrator.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        {{-- <li class="breadcrumb-item active">Setting = {{App\Models\Setting::count();}}</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title"></h3> -->
                            <div class="row mx-0 justify-content-between ">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <a href="{{route('create.user')}}" class="btn btn-primary p-2"><i class="fas fa-plus"></i>&nbsp;Add New User</a>
                                </div>
                                <div class="col-md-5 d-flex align-items-stretch ">
                                    @include('Administrator.notification')
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="user_list" class="table table-bordered table-hover">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count =1; @endphp
                                    @foreach($users as $user)

                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                        {{\App\Models\Role::where('id',$user->role_id)->value('name')}}
                                        </td>
                                        <td><input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}></td>
                                        <td>
                                            &nbsp;
                                            <a href="{{route('edit.user',$user->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            {{-- <a href="{{route('delete.user',$user->id)}}" onclick="checkConfirm(event)" class="btn btn-danger"><i class="fas fa-trash"></i></a> --}}
                                            <form action="{{route('delete.user',$user->id)}}" method="post" class="float-left">
                                                @csrf
                                                <a href="" data-toggle="tooltip" title="delete"
                                                    data-id="{{$user->id}}" class="dltBtn btn btn-danger" data-placement="botton"><i
                                                        class="fas fa-trash"></i></a>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('.toggle-class').change(function() {
            const path = "{{route('users.update.status')}}";
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: path,
                data: {
                    'status': status,
                    'id': id
                },
                success: function(data) {
                    //   console.log(data.success)
                    swal({
                        title: "Status Updated",
                        icon: "success",
                    });

                },
                // error: function(data) {
                //     swal(data.error);
                // }
            });
        })
    })


</script>
@endsection
