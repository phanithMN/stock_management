@extends('layout.app')
@section('title') {{'Update Permission'}} @endsection
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">@yield('title')</h3>
            <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{route('permission')}}">Permission</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">@yield('title')</a>
            </li>
            </ul>
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@yield('title')</div>
                    </div>
                    <div class="card-body">
                        <form method="post" class="form-group" action="{{ route('edit-data-permission', $permission->id)}}" enctype="multipart/form-data">
                            @csrf  
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="Name"
                                        name="name"
                                        placeholder="Enter Name"
                                        value="{{$permission->name}}"
                                        />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">Submit</button>
                                <button class="btn btn-danger" onclick="history.back(); return false;">Cancel</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection