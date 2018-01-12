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
                Manage Local Vendors
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage Local Vendors </li>
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
                                <a href="{!! url('admin/local_vendors/create') !!}" class="btn btn-sm  btn-primary cboxElement"><span class="glyphicon glyphicon-plus-sign"></span> Add Local Vendors</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('status') }}
                                </div>
                            @endif
                            <table id="local_vendors" class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th class="min-desktop">Title</th>
                                    <th class="min-desktop">Description</th>
                                    <th class="min-desktop">Image</th>
                                    <th class="min-desktop">Redirect Url</th>
                                    <th class="min-desktop">Action</th>
                                </tr>
                                </thead>
                                <tbody id="sortable">

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
@endsection