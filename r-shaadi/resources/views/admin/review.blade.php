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

                Manage Review & Rating

            </h1>

            <ol class="breadcrumb">

                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>

                <li class="active">Manage Review & Rating </li>

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



                            </div>

                        </div>

                        <!-- /.box-header -->

                        <div class="box-body">

                            <table id="reviews" class="table table-striped table-hover table-bordered">

                                <thead>

                                <tr>

                                    <th class="min-desktop">Review By</th>

                                    <th class="min-desktop">Vendor</th>

                                    <th class="min-desktop">Anonymous</th>

                                    <th class="min-desktop">Review</th>

                                    <th class="min-desktop">Rating</th>

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