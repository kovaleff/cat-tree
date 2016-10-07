@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="row page-title-row">
        <div class="col-md-6">
            <h3>Category <small>&raquo; Listing ({{session('lang')}})</small></h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="/admin/category/create" class="btn btn-success btn-md">
                <i class="fa fa-plus-circle"></i> New Category
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('admin.partials.errors')
            @include('admin.partials.success')
            <table id="tags-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Slug</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th data-sortable="false">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            @if (Auth::user()->can('manage-category'))
                                <a href="/admin/category/{{ $category->id }}/edit"
                                   class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script>
    $(function () {
        $("#tags-table").DataTable({
        });
    });
</script>
@stop
