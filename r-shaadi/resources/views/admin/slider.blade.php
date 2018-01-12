@extends('layouts.admin')

{{-- Web site Title --}}

@section('title') {!! $title !!} :: @parent @endsection



{{-- Content --}}

@section('content')
<style type="text/css">
    .modal-dialog {width:768px;}
</style>
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>

                Manage Slider Images

            </h1>

            <ol class="breadcrumb">

                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>

                <li class="active">Manage Slider Images </li>

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

                                <a href="{!! url('admin/slider/create') !!}" class="btn btn-sm  btn-primary cboxElement"><span class="glyphicon glyphicon-plus-sign"></span> Add Slider Image</a>

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

                            <table id="slider" class="table table-striped table-hover table-bordered">

                                <thead>

                                <tr>

                                    <th class="min-desktop">Title</th>

                                    <th class="min-desktop">Image</th>

                                    <th class="min-desktop">Order</th>

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
<!-- Modal -->
<div tabindex="-1" class="modal fade" id="slider-img-model" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">×</button>
        <h3 class="modal-title">Slider Image</h3>
    </div>
    <div class="modal-body">
        
    </div>
    <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </div>
</div>
@endsection