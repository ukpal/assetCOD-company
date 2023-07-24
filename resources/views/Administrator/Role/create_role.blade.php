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
                        <li class="breadcrumb-item active">Create Role</li>
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
                                    <a href="{{route('roles')}}" class="btn btn-primary p-2"><i class="fas fa-backward"></i> Back</a>
                                </div>
                                <div class="col-md-5 d-flex align-items-stretch ">
                                    @include('Administrator.notification')
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="{{route('store.role')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Role Title <span class="text-danger">*</span></label>
                                    <input type="text" name="name" maxlength="35" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"  placeholder="Enter Role Title">
                                    @error('name')
                                        <small class="text-danger" data-error='name'>{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Role Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="Enter Role Description" ></textarea>
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
<script type="text/javascript">
    $(function () {
        $("[name='name']").on("focus",function(){
            $(this).alpha();
            $("[data-error='name']").html("");
            $(this).removeClass("is-invalid");
        });
    });
</script>
@endsection
