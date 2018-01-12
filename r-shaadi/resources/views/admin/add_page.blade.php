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
                @if (isset($page))
                    Edit Page
                @else
                    Add New Page
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Add New Page </li>
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

                            @if (isset($page))
                                {!! Form::open(array('url' => url('admin/pages/update'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @else
                                {!! Form::open(array('url' => url('admin/pages/store'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @endif
                        <!-- text input -->
                            {{ csrf_field() }}
                            <div class="form-group col-md-12 {{ $errors->has('title') ? ' has-error' : '' }} required">
                                <label class="control-label">Title</label>
                                <input class="form-control" placeholder="Enter Title" name="title" id="title" type="text" value="{{ old('title')? old('title'): isset($page->title) ? $page->title : '' }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12 {{ $errors->has('slug') ? ' has-error' : '' }} required">
                                <label class="control-label">Slug</label>
                                <input class="form-control" placeholder="Enter Slug" name="slug" id="slug" type="text" value="{{ old('slug')? old('slug'): isset($page->slug) ? $page->slug : '' }}">
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12 {{ $errors->has('content') ? ' has-error' : '' }} required">
                                <label class="control-label">Content</label>
                                <textarea class="ckeditor form-control {{ $errors->has('content') ? ' error' : '' }}" name="content" id="content" placeholder="Enter Content">{{ old('content')? old('content'): isset($page->content) ? $page->content : '' }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label class="">Publish</label>
                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="radio-inline col-sm-3">
                                                <input type="radio" name="publish" id="publish1" value="1" {{ (old('publish') == 1 || isset($page->publish) && $page->publish == 1)?'checked="checked"':'' }}> Yes
                                            </label>
                                            <label class="radio-inline col-sm-3">
                                                <input type="radio" name="publish" id="publish2" value="0" {{ (old('publish') == 0 || isset($page->publish) && $page->publish == 0)?'checked="checked"':'' }}> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('vanue_settings'))
                                    <span class="help-block">
                                                    <strong>{{ $errors->first('vanue_settings') }}</strong>
                                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                @if (isset($page->id))
                                    <input class="clearfix clear" type="hidden" id="id" name="id" value="{{$page->id}}}">
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