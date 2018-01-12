@extends('layouts.admin')

<meta charset="utf-8">

@section('content')

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>

                Manage Vendors

            </h1>

            <ol class="breadcrumb">

                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>

                <li class="active">Manage Vendors</li>

            </ol>

        </section>



        <!-- Main content -->

        <section class="content">

            <div class="row">

                <div class="col-xs-12">

                    <div class="box">

                        <div class="box-header">

                            <h3 class="box-title"></h3>

                        </div>

                        <!-- /.box-header -->

                        <div class="box-body">

                            <table id="manage_vendors" class="table table-striped table-hover table-bordered">

                                <thead>

                                <tr>

                                    <th>Name</th>

                                    <th>Email</th>

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

@endsection