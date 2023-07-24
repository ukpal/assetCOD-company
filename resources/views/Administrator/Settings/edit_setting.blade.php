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
                        <li class="breadcrumb-item active">Create Setting</li>
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
                                    <a href="{{route('settings')}}" class="btn btn-primary p-2"><i class="fas fa-backward"></i> Back</a>
                                </div>
                                <div class="col-md-5 d-flex align-items-stretch ">
                                    @include('Administrator.notification')
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->
                        <form action="{{route('update.setting')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <label for="logo">Logo <small class="font-weight-bold text-info">( Image Dimention should be 215x215 )</small></label>
                                    <input type="file" name="logo" class="form-control" class="form-control @error('logo') is-invalid @enderror" value="{{ old('logo') }}">
                                       
                                    @error('logo')
                                    <small class="text-danger" data-error='name'>{{ $message }}</small>
                                    @enderror
                                </div>

                                <style>
                                    .select2-container .select2-selection--single {
                                        height: 37px;
                                    }
                                </style>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Timezone</label>
                                            <select class="form-control select2bs4" name="timezone" style="width: 100%;">
                                                {{-- <option selected="selected">--Select--</option> --}}
                                                @foreach (GeneralHelper::getTimeZone() as $key=>$value)
                                                <optgroup label={{$key}}>
                                                    @foreach ($value as $city)
                                                    <option value="{{$city}}" {{$timezone==$city ? 'selected':''}}>{{$city}}</option>                                               
                                                    @endforeach
                                                </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select class="form-control select2bs4" name="currency" style="width: 100%;">
                                                @foreach (GeneralHelper::getCurrencyList() as $item)
                                                    <option value="{{$item['name'].'-'.$item['code'].'-'.$item['symbol']}}" {{$item['code']==$currency_code ? 'selected':''}}>
                                                        {{$item['symbol'].' ('.$item['code'].')'}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}

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
<script type="text/javascript">
    $(function() {
        $("[name='logo']").on("focus", function() {
            $(this).alpha();
            $("[data-error='logo']").html("");
            $(this).removeClass("is-invalid");
        });
    });
</script>
@endsection
