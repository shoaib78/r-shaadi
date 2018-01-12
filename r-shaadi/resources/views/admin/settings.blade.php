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

    <?php $footer_setting = ""; ?>

    <?php $social_setting = ""; ?>
    @if(Session::has('footer_setting'))
        <?php $footer_setting = " active"; ?>
    @elseif(Session::has('social_setting'))
        <?php $social_setting = " active"; ?>
    @endif

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

            <h1>

                Website Settings

            </h1>



            <ol class="breadcrumb">

                <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

                <li class="active">Website Settings</li>

            </ol>

        </section>

        <!-- Main content -->

        <section class="content">



            <div class="row">

                <div class="col-md-12">

                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs">

                            <li class="{{ $footer_setting }}"><a href="#footer_setting" data-toggle="tab">Footer  Settings</a></li>

                            <li class="{{ $social_setting }}"><a href="#social_setting" data-toggle="tab">Social Settings</a></li>

                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane {{ $footer_setting }}" id="footer_setting">

                                @if (session('general_setting_error'))

                                    <div class="alert alert-danger">

                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                        {{ session('general_setting_error') }}

                                    </div>

                                @endif



                                @if (session('general_setting_success'))

                                    <div class="alert alert-success">

                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                        {{ session('general_setting_success') }}

                                    </div>

                                @endif

                                {!! Form::open(array('url' => route('settings.store'), 'method' => 'post', 'class' => 'form-horizontal','id'=>'general_setting_form', 'enctype'=>'multipart/form-data')) !!}
                                    <div class="form-group">
                                        <label for="site_footer_text" class="col-sm-2 control-label">Footter bottom left text</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="site_footer_text" name="site_footer_text" placeholder="Footter Text">{{ old('site_footer_text')? old('site_footer_text'): isset($SETTINGS->site_footer_text) ? $SETTINGS->site_footer_text : '' }}</textarea>
                                            @if ($errors->has('site_footer_text'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('site_footer_text') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('copyright') ? ' has-error' : '' }}">
                                        <label for="copyright" class="col-sm-2 control-label">Copy Right</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" placeholder="Enter Copyright" type="text" name="copyright" id="copyright" value="{{ old('copyright')? old('copyright'): isset($SETTINGS->copyright) ? $SETTINGS->copyright : '' }}">
                                            @if ($errors->has('copyright'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('copyright') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"> &nbsp; &nbsp;  Save General Settings &nbsp; &nbsp; </button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>

                            <!-- /.tab-pane -->

                            <div class="tab-pane {{ $social_setting }}" id="social_setting">

                                @if (session('social_setting_error'))

                                    <div class="alert alert-danger">

                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                        {{ session('social_setting_error') }}

                                    </div>

                                @endif



                                @if (session('social_setting_success'))

                                    <div class="alert alert-success">

                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                        {{ session('social_setting_success') }}

                                    </div>

                                @endif

                                <form class="form-horizontal" id="social-setting-form" role="form" method="POST" action="{{ route('social_url.store') }}">

                                    {{ csrf_field() }}

                                    <div class="form-group {{ $errors->has('fb_url') ? ' has-error' : '' }}">

                                        <label for="fb_url" class="col-sm-2 control-label">Facebook Page Url</label>



                                        <div class="col-sm-10">

                                            <input id="fb_url" type="text" value="{{ old('fb_url')? old('fb_url'): isset($SETTINGS->fb_url) ? $SETTINGS->fb_url : '' }}" class="form-control" name="fb_url" placeholder="Enter Facebook Page Url">



                                            @if ($errors->has('fb_url'))

                                                <span class="help-block">

                                            <strong>{{ $errors->first('fb_url') }}</strong>

                                        </span>

                                            @endif

                                        </div>

                                    </div>



                                    <div class="form-group {{ $errors->has('twitter_url') ? ' has-error' : '' }}">

                                        <label for="twitter_url" class="col-sm-2 control-label">Twitter Page Url</label>



                                        <div class="col-sm-10">

                                            <input id="twitter_url" value="{{ old('twitter_url')? old('twitter_url'): isset($SETTINGS->twitter_url) ? $SETTINGS->twitter_url : '' }}" type="text" class="form-control" name="twitter_url" placeholder="Enter Twitter Page Url">



                                            @if ($errors->has('twitter_url'))

                                                <span class="help-block">

                                            <strong>{{ $errors->first('twitter_url') }}</strong>

                                        </span>

                                            @endif

                                        </div>

                                    </div>



                                    <div class="form-group {{ $errors->has('instagram_url') ? ' has-error' : '' }}">

                                        <label for="fb_url" class="col-sm-2 control-label">Instagram Url</label>



                                        <div class="col-sm-10">

                                            <input id="instagram_url" value="{{ old('instagram_url')? old('instagram_url'): isset($SETTINGS->instagram_url) ? $SETTINGS->instagram_url : '' }}" type="text" class="form-control" name="instagram_url" placeholder="Enter Instagram Url">



                                            @if ($errors->has('instagram_url'))

                                                <span class="help-block">

                                            <strong>{{ $errors->first('instagram_url') }}</strong>

                                        </span>

                                            @endif

                                        </div>

                                    </div>



                                    <div class="form-group {{ $errors->has('gplus_url') ? ' has-error' : '' }}">

                                        <label for="gplus_url" class="col-sm-2 control-label">Google Plus Page Url</label>



                                        <div class="col-sm-10">

                                            <input id="gplus_url" value="{{ old('gplus_url')? old('gplus_url'): isset($SETTINGS->gplus_url) ? $SETTINGS->gplus_url : '' }}" type="text" class="form-control" name="gplus_url" placeholder="Enter Google Plus Page Url">



                                            @if ($errors->has('gplus_url'))

                                                <span class="help-block">

                                            <strong>{{ $errors->first('gplus_url') }}</strong>

                                        </span>

                                            @endif

                                        </div>

                                    </div>



                                    <div class="form-group {{ $errors->has('snapchat_url') ? ' has-error' : '' }}">

                                        <label for="snapchat_url" class="col-sm-2 control-label">Snapchat Page Url</label>



                                        <div class="col-sm-10">

                                            <input id="snapchat_url" value="{{ old('snapchat_url')? old('snapchat_url'): isset($SETTINGS->snapchat_url) ? $SETTINGS->snapchat_url : '' }}" type="text" class="form-control" name="snapchat_url" placeholder="Enter Snapchat Page Url">



                                            @if ($errors->has('snapchat_url'))

                                                <span class="help-block">

                                            <strong>{{ $errors->first('snapchat_url') }}</strong>

                                        </span>

                                            @endif

                                        </div>

                                    </div>

                                    <div class="form-group text-center">

                                        <button type="submit" class="edit-profile btn btn-primary"> &nbsp; &nbsp;  Save Social Settings &nbsp; &nbsp; </button>

                                    </div>

                                </form>

                            </div>
                            <!-- /.tab-pane -->
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