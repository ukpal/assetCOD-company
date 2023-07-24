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
                    <h1>Modules available</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Modules</li>
                        {{-- <li class="breadcrumb-item active">Modules = {{App\Models\Module::count();}}</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h3 class="card-title"></h3> -->
                            <div class="row mx-0 justify-content-between ">
                                <div class="col-md-2 d-flex align-items-stretch">
                                </div>
                                <div class="col-md-5 d-flex align-items-stretch ">
                                    @include('Administrator.notification')
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="modules" class="table table-bordered table-hover">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th style="width: 46px">Sl. No.</th>
                                        <th>Module Name</th>
                                        <th>View</th>
                                        <th>Add</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count =1; @endphp
                                    @foreach($modules as $module)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{$module->name}}</td>
                                        <td>
                                            <input id="a{{$module->m_id}}" type="checkbox" onclick="return false"
                                                {{($module->view==-1) ? 'disabled': 'checked'}}>
                                            <label for="a{{$module->m_id}}"></label>
                                        </td>
                                        <td>
                                            <input id="b{{$module->m_id}}" type="checkbox" onclick="return false"
                                                {{($module->add==-1) ? 'disabled': 'checked'}}>
                                            <label for="b{{$module->m_id}}"></label>
                                        </td>
                                        <td>
                                            <input id="c{{$module->m_id}}" type="checkbox" onclick="return false"
                                                {{($module->edit==-1) ? 'disabled': 'checked'}}>
                                            <label for="c{{$module->m_id}}"></label>
                                        </td>
                                        <td>
                                            <input id="d{{$module->m_id}}" type="checkbox" onclick="return false"
                                                {{($module->delete==-1) ? 'disabled': 'checked'}}>
                                            <label for="d{{$module->m_id}}"></label>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection