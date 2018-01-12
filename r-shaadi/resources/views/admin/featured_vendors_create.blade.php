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
                @if (isset($featured_vendor))
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
                            @if (session('featured_vendor_error'))
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('featured_vendor_error') }}
                                </div>
                            @endif

                            @if (session('featured_vendor_success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('featured_vendor_success') }}
                                </div>
                            @endif

                            @if (isset($featured_vendor))
                                {!! Form::open(array('url' => url('admin/featured_vendors/update'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @else
                                {!! Form::open(array('url' => url('admin/featured_vendors/store'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true, 'enctype'=>'multipart/form-data')) !!}
                            @endif
                        <!-- text input -->
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }} required">
                                <label for="company_name" class="col-sm-2 control-label">Company Name</label>

                                <div class="col-sm-10">
                                    <input id="company_name" value="{{ old('company_name')? old('company_name'): isset($featured_vendor->company_name) ? $featured_vendor->company_name : '' }}" type="text" class="form-control" name="company_name" placeholder="Enter Vendor Company Name">

                                    @if ($errors->has('company_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }} required">
                                <label for="category" class="col-sm-2 control-label">Category</label>

                                <div class="col-sm-10">
                                    <input id="category" value="{{ old('category')? old('category'): isset($featured_vendor->category) ? $featured_vendor->category : '' }}" type="text" class="form-control" name="category" placeholder="Enter Vendor Category">

                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('vendor_profile_link') ? ' has-error' : '' }} required">
                                <label for="vendor_profile_link" class="col-sm-2 control-label">Vendor Profile Url</label>

                                <div class="col-sm-10">
                                    <input id="vendor_profile_link" value="{{ old('vendor_profile_link')? old('vendor_profile_link'): isset($featured_vendor->vendor_profile_link) ? $featured_vendor->vendor_profile_link : '' }}" type="text" class="form-control" name="vendor_profile_link" placeholder="Enter Vendor Profile Url">

                                    @if ($errors->has('vendor_profile_link'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('vendor_profile_link') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('featured_image') ? ' has-error' : '' }} required">
                                <label for="favicon" class="col-sm-2 control-label">Upload Featured Vendor Gallery Image</label>

                                <div class="col-sm-10">
                                    @if (isset($featured_vendor->featured_image) && $featured_vendor->featured_image != '')
                                        <div class="row">
                                            <div class="col-sm-2" style="margin-bottom:10px;">
                                                <img src="{{ url('public/uploads').'/'.$featured_vendor->featured_image }}" class="img-thumbnail">
                                            </div>
                                        </div>
                                    @endif

                                    <input id="featured_image" type="file" name="featured_image" id="featured_image" accept="image/*" class="form-control" />
                                    @if ($errors->has('featured_image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('featured_image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            

                            <div class="form-group col-md-12">
                                @if (isset($featured_vendor->id))
                                    <input class="clearfix clear" type="hidden" id="id" name="id" value="{{$featured_vendor->id}}}">
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