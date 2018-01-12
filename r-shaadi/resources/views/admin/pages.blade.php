@extends('layouts.admin')

{{-- Web site Title --}}

@section('title') {!! $title !!} :: @parent @endsection



{{-- Content --}}

@section('content')

    <style>

        .form-group.required .control-label:after {

            content:"*";

            color:#d40000;

        }

    </style>

    <!-- Content Wrapper. Contains page content -->

    <?php //$SETTINGS = (object) $SETTINGS; ?>

    <?php $pages = ""; ?>
    <?php $contact_setting = ""; ?>
    @if(Session::has('pages'))
        <?php $pages = " active"; ?>
    @elseif(Session::has('contact_setting'))
        <?php $contact_setting = " active"; ?>
    @endif

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>

                Manage Pages

            </h1>



            <ol class="breadcrumb">

                <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                <li class="active">Manage Pages</li>

            </ol>

        </section>

        <!-- Main content -->

        <section class="content">



            <div class="row">

                <div class="col-md-12">

                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs">

                            <li class="{{ $pages }}"><a href="#manage_pages" data-toggle="tab">Manage  Pages</a></li>

                            <li class="{{ $contact_setting }}"><a href="#contact_setting" data-toggle="tab">Contact Page Settings</a></li>

                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane {{ $pages }}" id="manage_pages">

                                @if (session('pages_error'))

                                    <div class="alert alert-danger">

                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                        {{ session('pages_error') }}
                                    </div>

                                @endif



                                @if (session('pages_success'))

                                    <div class="alert alert-success">

                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                        {{ session('pages_success') }}

                                    </div>

                                @endif

                                <table id="pages" class="table table-striped table-hover table-bordered">

                                    <thead>

                                        <tr>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Published</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </div>

                            <!-- /.tab-pane -->

                            <div class="tab-pane {{ $contact_setting }}" id="contact_setting">
                                @if (session('contact_setting_error'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session('contact_setting_error') }}
                                    </div>
                                @endif

                                @if (session('contact_setting_success'))
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session('contact_setting_success') }}
                                    </div>
                                @endif

                                <form class="form-horizontal" id="contact-setting-form" role="form" method="POST" action="{{ route('contact_setting.store') }}">
                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('contact_email') ? ' has-error' : '' }} required">
                                    <label for="contact_email" class="col-sm-2 control-label">Contact Email</label>
                                    <div class="col-sm-10">
                                        <input id="contact_email" type="text" value="{{ old('contact_email')? old('contact_email'): isset($SETTINGS->contact_email) ? $SETTINGS->contact_email : '' }}" class="form-control" name="contact_email" placeholder="Enter Contact Email">
                                        @if ($errors->has('contact_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('contact_location') ? ' has-error' : '' }} required">
                                    <label for="contact_location" class="col-sm-2 control-label">Contact Address</label>
                                    <div class="col-sm-10">
                                        <input id="contact_location" value="{{ old('contact_location')? old('contact_location'): isset($SETTINGS->contact_location) ? $SETTINGS->contact_location : '' }}" type="text" class="form-control" name="contact_location" placeholder="Contact Address">
                                        @if ($errors->has('contact_location'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_location') }}</strong>
                                            </span>
                                        @endif
                                        <input type="hidden" name="contact_lat" id="contact_lat" value="{{ old('contact_lat')? old('contact_lat'): isset($SETTINGS->contact_lat) ? $SETTINGS->contact_lat : '' }}">
                                        <input type="hidden" name="contact_long" id="contact_long" value="{{ old('contact_long')? old('contact_long'): isset($SETTINGS->contact_long) ? $SETTINGS->contact_long : '' }}">
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                                    <label for="contact_phone" class="col-sm-2 control-label">Contact Phone Number</label>
                                    <div class="col-sm-10">
                                        <input id="contact_phone" value="{{ old('contact_phone')? old('contact_phone'): isset($SETTINGS->contact_phone) ? $SETTINGS->contact_phone : '' }}" type="text" class="form-control" name="contact_phone" placeholder="Enter Contact Phone Number">
                                        @if ($errors->has('contact_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="edit-profile btn btn-primary"> &nbsp; &nbsp;  Save Contact Settings &nbsp; &nbsp; </button>
                                </div>
                            </form>
                        </div>

                        </div>

                        <!-- /.tab-content -->

                    </div>

                    <!-- /.nav-tabs-custom -->

                </div>

                <!-- /.col -->

            </div>

            <!-- /.row -->



        </section>

        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->

@endsection