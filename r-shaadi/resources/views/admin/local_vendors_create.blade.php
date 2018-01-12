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
                @if (isset($local_vendor))
                    Add Featured Vendors Gallery
                @else
                    Edit Featured Vendors Gallery
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Featured Vendors Gallery</li>
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
                            @if (session('local_vendor_error'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('local_vendor_error') }}
                                </div>
                            @endif

                            @if (session('local_vendor_success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('local_vendor_success') }}
                                </div>
                            @endif

                            @if (isset($local_vendor))
                                {!! Form::open(array('url' => url('admin/local_vendors/update'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @else
                                {!! Form::open(array('url' => url('admin/local_vendors/store'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @endif
                        <!-- text input -->
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} required">
                                <label for="title" class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                    <input id="title" value="{{ old('title')? old('title'): isset($local_vendor->title) ? $local_vendor->title : '' }}" type="text" class="form-control" name="title" placeholder="Enter Title">

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }} required">
                                <label for="description" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{ old('description')? old('description'): isset($local_vendor->description) ? $local_vendor->description : '' }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('link') ? ' has-error' : '' }} required">
                                <label for="link" class="col-sm-2 control-label">Redirect Url</label>

                                <div class="col-sm-10">
                                    <input id="link" value="{{ old('link')? old('link'): isset($local_vendor->link) ? $local_vendor->link : '' }}" type="text" class="form-control" name="link" placeholder="Redirect Url">

                                    @if ($errors->has('link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }} required">
                                <label for="favicon" class="col-sm-2 control-label">Upload Local Vendor Image</label>

                                <div class="col-sm-10">
                                    @if (isset($local_vendor->image) && $local_vendor->image != '')
                                        <div class="row">
                                            <div class="col-sm-2" style="margin-bottom:10px;">
                                                <img src="{{ url('public/uploads').'/'.$local_vendor->image }}" class="img-thumbnail">
                                            </div>
                                        </div>
                                    @endif

                                    <input id="image" type="file" name="image" id="image" accept="image/*" class="form-control" />
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            

                            <div class="form-group col-md-12">
                                @if (isset($local_vendor->id))
                                    <input class="clearfix clear" type="hidden" id="id" name="id" value="{{$local_vendor->id}}}">
                                @endif
                                <button id="submit-all" type="submit" class="btn btn-primary pull-left">
                                    Submit
                                </button>
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