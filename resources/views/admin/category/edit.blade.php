@extends('admin.layout')

@section('content')
  <div class="container-fluid">
    <div class="row page-title-row">
      <div class="col-md-12">
        <h3>Categories <small>&raquo; Edit Category</small></h3>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Category Edit Form</h3>
          </div>
          <div class="panel-body">

            @include('admin.partials.errors')
            @include('admin.partials.success')

            <form class="form-horizontal" role="form" method="POST"
                  action="/admin/category/{{ $id }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="id" value="{{ $id }}">


              @include('admin.category._form')

              <div class="form-group">
                <div class="col-md-7 col-md-offset-3">
                  <button type="submit" class="btn btn-primary btn-md">
                    <i class="fa fa-save"></i>
                    &nbsp; Save Changes
                  </button>
                  <button type="button" class="btn btn-danger btn-md"
                          data-toggle="modal" data-target="#modal-delete">
                    <i class="fa fa-times-circle"></i>
                    Delete With
                  </button>
                  <button type="button" class="btn btn-warning btn-md"
                          data-toggle="modal" data-target="#modal-delete-without">
                    <i class="fa fa-times-circle"></i>
                    Delete Without
                  </button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Confirm Delete with --}}
  <div class="modal fade" id="modal-delete" tabIndex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title">Please Confirm</h4>
        </div>
        <div class="modal-body">
          <p class="lead">
            <i class="fa fa-question-circle fa-lg"></i> &nbsp;
            Are you sure you want to delete this Category?
          </p>
        </div>
        <div class="modal-footer">
          <form method="POST" action="/admin/category/{{ $id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="full" value="1">
            <button type="button" class="btn btn-default"
                    data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">
              <i class="fa fa-times-circle"></i> Yes
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- Confirm Delete without --}}
  <div class="modal fade" id="modal-delete-without" tabIndex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title">Please Confirm</h4>
        </div>
        <div class="modal-body">
          <p class="lead">
            <i class="fa fa-question-circle fa-lg"></i> &nbsp;
            Are you sure you want to delete this Category?
          </p>
        </div>
        <div class="modal-footer">
          <form method="POST" action="/admin/category/{{ $id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="full" value="0">
            <button type="button" class="btn btn-default"
                    data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">
              <i class="fa fa-times-circle"></i> Yes
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

@stop