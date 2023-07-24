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
                                    <a href="{{route('users')}}" class="btn btn-primary p-2"><i class="fas fa-backward"></i> Back</a>
                                </div>
                                <div class="col-md-5 d-flex align-items-stretch ">
                                    @include('Administrator.notification')
                                </div>
                            </div>

                        </div>

                        <form action="{{route('store.user')}}" method="POST">
                            @csrf
                            <div class="card-body col-md-12">
                                
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                    <label for="first_name">First Name<span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" maxlength="35" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="Enter First Name">
                                    @error('first_name')
                                    <small class="text-danger" data-error='first_name'>{{ $message }}</small>
                                    @enderror
                                </div>

                                 <div class="form-group col-md-6">
                                    <label for="name">Last Name<span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" maxlength="35" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Enter Last Name">
                                    @error('last_name')
                                    <small class="text-danger" data-error='last_name'>{{ $message }}</small>
                                    @enderror
                                </div>

                                </div>
                                  <div class="row">
                                      <div class="form-group col-md-6">
                                    <label for="email">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter email">
                                    @error('email')
                                    <small class="text-danger" data-error='email'>{{ $message }}</small>
                                    @enderror
                                </div>

                                 <div class="form-group col-md-6">
                                    <label for="role">Role<span class="text-danger">*</span></label>
                                    <select name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}">
                                        <option value=""> --Select Role-- </option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <small class="text-danger" data-error='role'>{{ $message }}</small>
                                    @enderror
                                </div> 
                                  </div>
                              
                                
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
