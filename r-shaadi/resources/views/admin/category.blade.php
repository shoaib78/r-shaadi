@extends('layouts.admin')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Vendors Categories
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage Vendors Categories </li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                           {{-- <h3 class="box-title">Vendors Categories</h3>--}}
                            <div class="pull-right">
                                <a href="javascript:void(0);" onclick="show_pospup(this)" class="btn btn-sm  btn-primary cboxElement"><span class="glyphicon glyphicon-plus-sign"></span> Add New Category</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="category" class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!--View Category Bootstrap Modal-->
    <!--===================================================-->
    <div class="modal fade" id="category-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">

                    <h4 class="modal-title">Add Category</h4>
                </div>

                <!--Modal body-->
                <form action="{{ url('admin/category/store') }}" method = "post" id="add_category" class="form-horizontal">
                    <div class="modal-body">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Category</label>

                                    <div class="col-sm-10">
                                        <input id="category_name" name="category_name" placeholder="Category" class="form-control input-md" type="text" required>
                                        <span class="help-block"><small></small></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--Modal footer-->
                    <!--Modal footer-->
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-info">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--===================================================-->
    <!--End Default Bootstrap Modal-->
@endsection