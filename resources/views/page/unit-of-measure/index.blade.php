@extends('layout.app')
@section('title') {{'Unit Of Measure'}} @endsection
@section('content')

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3"> @yield('title')</h3>
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
          <a href="{{route('dashboad')}}">Dashboard</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#"> @yield('title')</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <h4 class="card-title">Add New Unit Of Measure</h4>
              <a href="{{route('insert-unit-of-measure')}}" class="btn btn-primary btn-round ms-auto">
                <i class="fa fa-plus"></i> Add New </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                      <thead>
                        <tr role="row">
                          <th>Unit</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($unit_of_measures as $unit_of_measure)
                          <tr role="row" class="odd">
                            <td>{{$unit_of_measure->unit}}</td>
                            <td>
                              <div class="form-button-action">
                                <a  href="{{ route('update-unit-of-measure', $unit_of_measure->id) }} type="button" title="Edit Item" class="btn btn-link btn-primary btn-lg">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('delete-unit-of-measure', $unit_of_measure->id) }}" onclick="return confirmation(event)" type="button" title="Remove Item" class="btn btn-link btn-danger">
                                  <i class="fas fa-trash-alt"></i>
                                </a>
                              </div>
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
        </div>
      </div>
    </div>
  </div>
</div>

@endsection