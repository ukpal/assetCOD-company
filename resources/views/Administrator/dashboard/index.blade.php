@extends('Administrator.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    {{-- {{Session::get('newDB')}} --}}
    {{-- {{Session::get('defaultTimeZone') }} --}}
    {{Session::get('companyStatus')}}
<section class="content">
      <div class="container-fluid">
        
      </div>
    </section>
</div>
 @endsection