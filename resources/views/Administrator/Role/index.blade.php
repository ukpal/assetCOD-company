@extends('Administrator.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                        {{-- <li class="breadcrumb-item active">Role = {{App\Models\Role::count();}}</li> --}}
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
                                    <a href="{{route('create.role')}}" class="btn btn-primary p-2"><i class="fas fa-plus"></i> Add New Role</a>
                                </div>
                                <div class="col-md-5 d-flex align-items-stretch ">
                                    @include('Administrator.notification')
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="role_list" class="table table-bordered table-hover">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th style="width: 46px">Sl. No.</th>
                                        <th style="width: 25%">Role Title</th>
                                        <th>Role Description</th>
                                        <!-- <th style="width: 80px"> Status</th> -->
                                        <th style="width: 100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count =1; @endphp
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{!! Str::limit($role->description, 40, ' ...') !!}</td>
                                        <td>
                                            <a href="{{route('edit.role',$role->id)}}" title="edit" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('role.permission',$role->id)}}" title="set permission" class="btn btn-primary"><i class="fas fa-tasks"></i></a>
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
            const path = "{{route('update.status')}}";
            var status = $(this).prop('checked') == true ? 1 : 0;
            var module_id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: path,
                data: {
                    'status': status,
                    'module_id': module_id
                },
                success: function(data) {
                    //   console.log(data.success)
                    swal(data.success);

                },
                error: function(data) {
                    swal(data.error);
                }
            });
        })
    })
</script>
@endsection
