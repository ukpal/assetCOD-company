@extends('Administrator.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                                    <a href="{{route('edit.setting')}}" class="btn btn-primary p-2"><i class="fas fa-plus"></i>&nbsp;Update Setting</a>
                                </div>
                                <div class="col-md-5 d-flex align-items-stretch ">
                                    @include('Administrator.notification')
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p> Company Logo</p>
                                        <td>
                                            @if(!empty($company_logo))
                                            <img src="{{URL::asset('public/Administrator/images/logo/'.$company_logo)}}" alt="" width="80px;" height="80px;">
                                            @else
                                            <p>No Logo Found</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p> Timezone</p>
                                        <td>
                                           {{$timezone}}
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td>
                                            <p> Currency</p>
                                        <td>
                                           {{$currency_symbol}} ({{$currency_code}})
                                        </td>
                                    </tr> --}}
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
        });
        if(true){
            $.ajax({
              type: "GET",
              dataType: "json",
              url: "{{route('get-general-setting')}}",
              success: function (data) {
                  if(data){
                        localStorage.setItem('company_logo', data)
                        $('#default-brand-image').addClass('d-none');
                        $('.brand-image').attr("src", "{{url('')}}"+"/public/Administrator/images/logo/" + localStorage.getItem('company_logo'));
                    }
              },
              error: function (data) {
                console.log(data);
              }
            });
        }
    })
</script>
@endsection
