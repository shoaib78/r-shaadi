@extends('layouts.admin')
{{-- Web site name --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @if (isset($user_comment))
                    Add User Comments
                @else
                    Edit User Comments
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! url('admin') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Manage User Comments</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            {{-- <h3 class="box-name">Vendors Categories</h3>--}}
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

                            @if (isset($user_comment))
                                {!! Form::open(array('url' => url('admin/user_comments/update'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @else
                                {!! Form::open(array('url' => url('admin/user_comments/store'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @endif
                        <!-- text input -->
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} required">
                                <label for="name" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input id="name" value="{{ old('name')? old('name'): isset($user_comment->name) ? $user_comment->name : '' }}" type="text" class="form-control" name="name" placeholder="Enter Name">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }} required">
                                <label for="description" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description">{{ old('description')? old('description'): isset($user_comment->description) ? $user_comment->description : '' }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('profile_pic') ? ' has-error' : '' }} required">
                                <label for="favicon" class="col-sm-2 control-label">Upload User Profile Pic</label>

                                <div class="col-sm-10">
                                    @if (isset($user_comment->profile_pic) && $user_comment->profile_pic != '')
                                        <div class="row">
                                            <div class="col-sm-2" style="margin-bottom:10px;">
                                                <img src="{{ url('public/uploads').'/'.$user_comment->profile_pic }}" class="img-thumbnail">
                                            </div>
                                        </div>
                                    @endif

                                    <input id="profile_pic" type="file" name="profile_pic" id="profile_pic" accept="profile_pic/*" class="form-control" />
                                    @if ($errors->has('profile_pic'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('profile_pic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            

                            <div class="form-group col-md-12">
                                @if (isset($user_comment->id))
                                    <input class="clearfix clear" type="hidden" id="id" name="id" value="{{$user_comment->id}}}">
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