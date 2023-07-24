@extends('Administrator.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subscription Plans</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Subscription Plans</li>
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
                <div class="col-md-3 d-flex align-items-stretch">
                  <!-- <a href="{{url('admin/subscription/new')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Subscription</a> -->
                </div>
                <div class="col-md-5 d-flex align-items-stretch ">
                    @include('Administrator.notification')
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-hover">
                <thead class="bg-secondary">
                  <tr>
                    <th>Sl. No.</th>
                    <th>Plan Name</th>
                    <th>Start</th>
                    <th>End</th>
                  </tr>
                </thead>
                <tbody>
                  @php $count =1; @endphp
                  @foreach($datas as $data)
                  <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{$data->title}}</td>
                    <td>{{$data->tenure_from}}</td>

                    <td>{{$data->tenure_to}}</td>

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
