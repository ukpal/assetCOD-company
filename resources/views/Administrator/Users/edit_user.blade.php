@extends('Administrator.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>General Form</h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <!-- left column -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row mx-0 justify-content-between ">
                                <div class="col-md-2 d-flex align-items-stretch">
                                    <a href="{{route('users')}}" class="btn btn-primary p-2"><i
                                            class="fas fa-backward"></i> Back</a>
                                </div>
                                <div class="col-md-5 d-flex align-items-stretch ">
                                    @include('Administrator.notification')
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="{{route('update.user',$user->id)}}" method="POST">
                            @csrf
                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" maxlength="35"
                                        class="form-control @error('first_name') is-invalid @enderror" value="{{$user->first_name}}"
                                        placeholder="Enter First Name">
                                    @error('first_name')
                                    <small class="text-danger" data-error='first_name'>{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="last_name">Last Name<span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" maxlength="35"
                                        class="form-control @error('last_name') is-invalid @enderror" value="{{$user->last_name}}"
                                        placeholder="Enter Last Name">
                                    @error('last_name')
                                    <small class="text-danger" data-error='last_name'>{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{$user->email}}" placeholder="Enter email">
                                    @error('email')
                                    <small class="text-danger" data-error='email'>{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- <div class="form-group">
                                    <label for="password">Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Enter password">
                                    @error('password')
                                    <small class="text-danger" data-error='password'>{{ $message }}</small>
                                    @enderror
                                </div> -->

                                <div class="form-group">
                                    <label for="role">Role<span class="text-danger">*</span></label>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value=""> --Select Role-- </option>
                                        @foreach(App\Models\Role::orderBy('name','asc')->get() as $role)
                                        <option value="{{$role->id}}" {{$role->id == $user->role_id ? 'selected' :
                                            ''}}>{{$role->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('role')
                                    <small class="text-danger" data-error='role'>{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- <div class="form-group">
                                    <label for="exampleInputPassword1">Module Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="Enter Module description" ></textarea>
                                </div> -->
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

@endsection

@section('scripts')
@parent
<script type="text/javascript">
    $(function() {
        $("[name='first_name']").on("focus", function() {
            $(this).alpha();
            $("[data-error='first_name']").html("");
            $(this).removeClass("is-invalid");
        });

        $("[name='last_name']").on("focus", function() {
            $(this).alpha();
            $("[data-error='last_name']").html("");
            $(this).removeClass("is-invalid");
        });

        $("[name='email']").on("focus", function() {
            // $(this).alpha();
            $("[data-error='email']").html("");
            $(this).removeClass("is-invalid");
        });
        $("[name='role']").on("focus", function() {
            // $(this).alpha();
            $("[data-error='role']").html("");
            $(this).removeClass("is-invalid");
        });
    });
</script>
@endsection
