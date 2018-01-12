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
        Why you should sign up
        </h1>

        <ol class="breadcrumb">
            <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Why you should sign up</li>
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
                        @if (session('home_section4_success'))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('home_section4_success') }}
                            </div>
                        @endif

                         @if (session('home_section4_error'))
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('home_section4_error') }}
                            </div>
                        @endif

                        {!! Form::open(array('url' => route('home_section4.store'), 'method' => 'post', 'class' => 'form-horizontal','id'=>'home_section4_form')) !!}
                            <div class="form-group {{ $errors->has('home_section4_inbox_text') ? ' has-error' : '' }} required">
                                <label for="home_section4_inbox_text" class="col-sm-2 control-label">Inbox Text</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="home_section4_inbox_text" name="home_section4_inbox_text" placeholder="Inbox Text">{{ old('home_section4_inbox_text')? old('home_section4_inbox_text'): isset($SETTINGS->home_section4_inbox_text) ? $SETTINGS->home_section4_inbox_text : '' }}</textarea>
                                    @if ($errors->has('home_section4_inbox_text'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_section4_inbox_text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('home_section4_collaborate_text') ? ' has-error' : '' }} required">
                                <label for="home_section4_collaborate_text" class="col-sm-2 control-label">Collaborate Text</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="home_section4_collaborate_text" name="home_section4_collaborate_text" placeholder="Collaborate Text">{{ old('home_section4_collaborate_text')? old('home_section4_collaborate_text'): isset($SETTINGS->home_section4_collaborate_text) ? $SETTINGS->home_section4_collaborate_text : '' }}</textarea>
                                    @if ($errors->has('home_section4_collaborate_text'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_section4_collaborate_text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('home_section4_finalize_vendors_text') ? ' has-error' : '' }} required">
                                <label for="home_section4_finalize_vendors_text" class="col-sm-2 control-label">Shortlist and Finalize Vendors Text</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="home_section4_finalize_vendors_text" name="home_section4_finalize_vendors_text" placeholder="Shortlist and Finalize Vendors Text">{{ old('home_section4_finalize_vendors_text')? old('home_section4_finalize_vendors_text'): isset($SETTINGS->home_section4_finalize_vendors_text) ? $SETTINGS->home_section4_finalize_vendors_text : '' }}</textarea>
                                    @if ($errors->has('home_section4_finalize_vendors_text'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_section4_finalize_vendors_text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('home_section4_checklist_text') ? ' has-error' : '' }} required">
                                <label for="home_section4_checklist_text" class="col-sm-2 control-label">Checklist Text</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="home_section4_checklist_text" name="home_section4_checklist_text" placeholder="Checklist Text">{{ old('home_section4_checklist_text')? old('home_section4_checklist_text'): isset($SETTINGS->home_section4_checklist_text) ? $SETTINGS->home_section4_checklist_text : '' }}</textarea>
                                    @if ($errors->has('home_section4_checklist_text'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('home_section4_checklist_text') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary"> &nbsp; &nbsp;  Submit &nbsp; &nbsp; </button>
                                </div>
                            </div>
                         {!! Form::close() !!}
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