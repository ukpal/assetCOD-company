@extends('Administrator.master')
@section('content')

<style>
    input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
    }

    label {
        position: relative;
        cursor: pointer;
    }

    label:before {
        content: '';
        -webkit-appearance: none;
        background-color: #fff;
        border: 2px solid #838383;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        padding: 8px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-right: 5px;
    }

    input:checked+label:after {
        content: '';
        display: block;
        position: absolute;
        top: 6px;
        left: 8px;
        width: 6px;
        height: 10px;
        border: solid #0079bf;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    input:checked+label:before {
        border: 2px solid #838383;
        background-color: #fff;
    }

    input:disabled+label:before {
        border: 2px solid #c3c3c3;
        background-color: #c3c3c3;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Set Role Permissions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Set Role Permission</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Bordered Table</h3> --}}
                            <a href="{{route('create.role')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
                                New Role</a>
                            <a href="{{route('roles')}}" class="btn btn-primary float-right"><i
                                    class="fas fa-backward"></i> Back</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th style="width: 71px">Sl. No.</th>
                                        <th>Module Name</th>
                                        <th>View</th>
                                        <th>Add</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        <!-- <th style="width: 40px">Label</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count =1; @endphp
                                    @foreach($modules as $module)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{$module->name}}</td>
                                        <td>
                                            {{-- {{$module->view}} --}}
                                            <input id="a{{$module->m_id}}" type="checkbox" name="view"
                                                module="{{$module->m_id}}" value="{{$module->view}}"
                                                {{($module->view==-1) ? 'disabled': ($module->view ? 'checked':'')}}>
                                            <label for="a{{$module->m_id}}"></label>
                                        </td>
                                        <td>
                                            {{-- {{$module->add}} --}}
                                            <input id="b{{$module->m_id}}" type="checkbox" name="add"
                                                module="{{$module->m_id}}" value="{{$module->add}}" {{($module->add==-1)
                                            ? 'disabled': ($module->add ? 'checked':'')}}>
                                            <label for="b{{$module->m_id}}"></label>
                                        </td>
                                        <td>
                                            {{-- {{$module->edit}} --}}
                                            <input id="c{{$module->m_id}}" type="checkbox" name="edit"
                                                module="{{$module->m_id}}" value="{{$module->edit}}"
                                                {{($module->edit==-1) ? 'disabled':($module->edit ? 'checked':'')}}>
                                            <label for="c{{$module->m_id}}"></label>
                                        </td>
                                        <td>
                                            {{-- {{$module->delete}} --}}
                                            <input id="d{{$module->m_id}}" type="checkbox" name="delete"
                                                module="{{$module->m_id}}" value="{{$module->delete}}"
                                                {{($module->delete==-1) ? 'disabled':($module->delete ? 'checked':'')}}>
                                            <label for="d{{$module->m_id}}"></label>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- <tr>
                                        <td>2.</td>
                                        <td>Clean database</td>
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">70%</span></td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Cron job running</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar bg-primary" style="width: 30%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">30%</span></td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Fix and squish bugs</td>
                                        <td>
                                            <div class="progress progress-xs progress-striped active">
                                                <div class="progress-bar bg-success" style="width: 90%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">90%</span></td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{-- <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('input[type="checkbox"]').click(function () {
            const module_id = $(this).attr('module');
            const name = $(this).attr('name');
            var value = $(this).val();
            // alert(value);
            value = (value == 0 || value == '') ? 1 : 0;
            var role_id = "{{ Request::segment(3) }}";
            const path = "{{url('/admin/set-role-permission/')}}";
            // const path ="{{url('/admin/set-modulepermission/')}}"+"/"+ module_id+ "/"+ name+"/"+value ;
            $(this).val(value);
            // console.log(value);
            // window.location = path;
            $.ajax({
                type: "POST",
                url: path, // Route
                data: {
                    checkbox_val: value,
                    module_id: module_id,
                    check_name: name,
                    role_id: role_id
                },
            })
                .done(function (resp) {
                    // swal.close();
                    // console.log(resp);

                    swal({
                        title: "Permission Updated",
                        //   text: "You clicked the button!",
                        icon: "success",
                    });
                });
        });
    })
</script>
@endsection