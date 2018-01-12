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

            Dashboard

            <small>Control panel</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Dashboard</li>

        </ol>

    </section>



    <!-- Main content -->

    <section class="content">

        <!-- Small boxes (Stat box) -->

        <div class="row">

            <div class="col-lg-3 col-xs-6">

                <!-- small box -->

                <div class="small-box bg-yellow">

                    <div class="inner">

                        <h3>{{ $users }}</h3>



                        <p>Total Users</p>

                    </div>

                    <div class="icon">

                        <i class="ion ion-person-stalker"></i>

                    </div>

                    <a href="{{ url('admin/manage_users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                </div>

            </div>

            <!-- ./col -->



            <div class="col-lg-3 col-xs-6">

                <!-- small box -->

                <div class="small-box bg-red">

                    <div class="inner">

                        <h3>{{ $vendors }}</h3>



                        <p>Total Vendors</p>

                    </div>

                    <div class="icon">

                        <i class="ion ion-ios-people"></i>

                    </div>

                    <a href="{{ url('admin/manage_vendors') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                </div>

            </div>

            <!-- ./col -->



            <div class="col-lg-3 col-xs-6">

                <!-- small box -->

                <div class="small-box bg-aqua">

                    <div class="inner">

                        <h3>{{ $reviews }}</h3>



                        <p>Total Reviews</p>

                    </div>

                    <div class="icon">

                        <i class="fa fa-signal"></i>

                    </div>

                    <a href="{{ url('admin/dashboard') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                </div>

            </div>

            <!-- ./col -->



            <div class="col-lg-3 col-xs-6">

                <!-- small box -->

                <div class="small-box bg-green">

                    <div class="inner">

                        <h3>{{ $albums }}</sup></h3>



                        <p>Total Albums</p>

                    </div>

                    <div class="icon">

                        <i class="ion ion-images"></i>

                    </div>

                    <a href="{{ url('admin/dashboard') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

                </div>

            </div>

            <!-- ./col -->

        </div>

        <!-- /.row -->

        <!-- Main row -->

        <div class="row">

            <!-- Left col -->

            <section class="col-lg-7 connectedSortable">

                <!-- Map box -->

                <div class="box box-solid bg-light-blue-gradient">

                    <div class="box-header">

                        <!-- tools box -->

                        <div class="pull-right box-tools">

                            <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">

                                <i class="fa fa-calendar"></i></button>

                            <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">

                                <i class="fa fa-minus"></i></button>

                        </div>

                        <!-- /. tools -->



                        <i class="fa fa-map-marker"></i>



                        <h3 class="box-title">

                            Visitors

                        </h3>

                    </div>

                    <div class="box-body">

                        <div id="world-map" style="height: 250px; width: 100%;"></div>

                    </div>

                    <!-- /.box-body-->

                    <div class="box-footer no-border">

                        <div class="row">

                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">

                                <div id="sparkline-1"></div>

                                <div class="knob-label">Visitors</div>

                            </div>

                            <!-- ./col -->

                            <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">

                                <div id="sparkline-2"></div>

                                <div class="knob-label">Online</div>

                            </div>

                            <!-- ./col -->

                            <div class="col-xs-4 text-center">

                                <div id="sparkline-3"></div>

                                <div class="knob-label">Exists</div>

                            </div>

                            <!-- ./col -->

                        </div>

                        <!-- /.row -->

                    </div>

                </div>

                <!-- /.box -->

            </section>

            <!-- /.Left col -->

            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <section class="col-lg-5 connectedSortable">



                <!-- Custom tabs (Charts with tabs)-->

                <!-- Donut chart -->

                <div class="box box-primary">

                    <div class="box-header with-border">

                        <i class="fa fa-bar-chart-o"></i>



                        <h3 class="box-title">Donut Chart</h3>



                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

                            </button>

                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

                        </div>

                    </div>

                    <div class="box-body">

                        <div id="donut-chart" style="height: 300px;"></div>

                    </div>

                    <!-- /.box-body-->

                </div>

                <!-- /.box -->

                <!-- /.nav-tabs-custom -->

            </section>

            <!-- right col -->

        </div>

        <!-- /.row (main row) -->



    </section>

    <!-- /.content -->

</div>

<!-- /.content-wrapper -->

@endsection