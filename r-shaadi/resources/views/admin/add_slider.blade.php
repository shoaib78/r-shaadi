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
                Add Slider Images
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add Slider Images </li>
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
                            @if (session('status'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if (isset($slider))
                                {!! Form::open(array('url' => url('admin/slider/update'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @else
                                {!! Form::open(array('url' => url('admin/slider/store'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @endif
                                <!-- text input -->
                                {{ csrf_field() }}
                                <div class="form-group col-md-12 {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Title</label>
                                    <input class="form-control" placeholder="Enter Title" name="title" id="title" type="text" value="{{ old('title')? old('title'): isset($slider->title) ? $slider->title : '' }}">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 {{ $errors->has('attachment') ? ' has-error' : '' }}">
                                    <label class="control-label">Featured Image</label>
                                    <div class="controls">
                                        <div id="attachment-dropzone" class="dropzone">
                                            <div class="dz-default dz-message">
                                                <div class="dz-icon icon-wrap icon-circle icon-wrap-md">
                                                    <i class="fa fa-cloud-upload fa-3x"></i>
                                                </div>
                                                <div>
                                                    <p class="dz-text">Drop image file to upload</p>
                                                    <p class="text-muted">or click to pick manually</p>
                                                </div>
                                            </div>
                                            <div class="fallback">
                                                <input name="file" type="file" name="fetured" id="fetured" multiple />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="controls">
                                        <input class="clearfix clear" type="text" id="attachment" name="attachment" value="{{ old('attachment')? old('attachment'): isset($slider->image) ? $slider->image : '' }}" style="visibility: hidden;">
                                        @if ($errors->has('attachment'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('attachment') }}</strong>
                                        </span>
                                        @endif
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    @if (isset($slider->id))
                                        <input class="clearfix clear" type="hidden" id="id" name="id" value="{{$slider->id}}}">
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