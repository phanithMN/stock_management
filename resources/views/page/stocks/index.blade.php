@extends('layout.app')
@section('title') {{'Stock'}} @endsection
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
              <h4 class="card-title">Add New Stock</h4>
              <a href="{{route('insert-stock')}}" class="btn btn-primary btn-round ms-auto">
                <i class="fa fa-plus"></i> Add New </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="add-row_length">
                      <label>
                        Show 
                        <select id="add_row_length" name="add_row_length" aria-controls="add-row" class="form-control form-control-sm">
                          <option value="10" {{ request('row_length') == 10 ? 'selected' : '' }}>10</option>
                          <option value="25" {{ request('row_length') == 25 ? 'selected' : '' }}>25</option>
                          <option value="50" {{ request('row_length') == 50 ? 'selected' : '' }}>50</option>
                          <option value="100" {{ request('row_length') == 100 ? 'selected' : '' }}>100</option>
                        </select> entries 
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 d-flex fill-right">
                    <div class="form-controll-fillter">
                      <select class="form-select form-select-sm" id="category"  name="category">
                        <option value="">Chosse Category</option>
                        @foreach ($categories as $category )
                        <option value="{{$category->name}}" {{ request('category') == $category->name ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-controll-fillter">
                      <select class="form-select form-select-sm" id="status_name"  name="status_name">
                        <option value="">Chosse Status</option>
                        @foreach ($status as $status_item )
                        <option value="{{$status_item->name}}" {{ request('status_name') == $status_item->name ? 'selected' : '' }}>{{$status_item->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div id="add-row_filter" class="dataTables_filter">
                      <label>
                        <form action="{{ route('stock') }}" method="GET">
                          @csrf
                          <input 
                          type="search" 
                          name="search" 
                          class="form-control form-control-sm" 
                          placeholder="Search..." 
                          aria-label="Search..." 
                          value="{{$search_value}}"
                          />
                        </form>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                      <thead>
                        <tr role="row">
                          <th>Name</th>
                          <th>Category</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($stocks as $stock)
                          <tr role="row" class="odd">
                            <td>{{$stock->name}}</td>
                            <td>{{$stock->category_name}}</td>
                            <td><span class="{{$stock->status_name == "Income" ? "color-income" : "color-return" }} status">{{$stock->status_name}}</span></td>
                            <td>
                              <div class="form-button-action">
                                <a  href="{{ route('update-stock', $stock->id) }} type="button" title="Edit Item" class="btn btn-link btn-primary btn-lg">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('delete-stock', $stock->id) }}" onclick="return confirmation(event)" type="button" title="Remove Item" class="btn btn-link btn-danger">
                                  <i class="fas fa-trash-alt"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="10" class="pagination-table">
                            {{$stocks->onEachSide(1)->links()}}
                          </td>
                        </tr>
                      </tfoot>
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