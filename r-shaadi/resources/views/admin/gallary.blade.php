@extends('layouts.admin')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
    <style>
        #gallary img {
            filter: gray; /* IE6-9 */
            -webkit-filter: grayscale(0); /* Google Chrome, Safari 6+ & Opera 15+ */
            -webkit-box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);
            box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);
            margin-bottom:20px;
            margin-top: 25px;
        }
        .gallery_col {
            position: relative;
        }

        .gallery_col a {
            position: absolute;
            top: -13px;
            color: #fff;
            background: rgba(0, 0, 0, 0.59);
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            border-radius: 4px;
            right: -12px;
        }
        /*#gallary img:hover {
            filter: none; !* IE6-9 *!
            -webkit-filter: grayscale(1); !* Google Chrome, Safari 6+ & Opera 15+ *!
            -webkit-filter: blur(5px) brightness(0.5);

        }*/
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Vendor Gallery Management
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! url('admin/dashboard') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Vendor Gallery Management</li>
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
                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#gallary" data-toggle="tab">Gallary</a></li>
                                        <li><a href="#banner" data-toggle="tab">Banner</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="gallary"><div class="form-group col-xs-12 p0">
                                                <div class="row">
                                                    @if (!empty($gallary))
                                                        @foreach($gallary as $i=>$row)
                                                            <div class="col-md-3 col-sm-4 col-xs-6 gallary">
                                                                <div class="gallery_col">
                                                                    <img class="img-responsive" src="{{ $row['path'] }}" alt="{{ $row['gallary_img'] }}"/>
                                                                    <a href="javascript:void(0);" data-img="{{ base64_encode($row['gallary_id']) }}" id="gallary-{{ $row['gallary_id'] }}" onclick="remove_image(this);" title="Remove this image"><i class="fa fa-times"></i></a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-danger">
                                                            <p>Sorry, No gallary images are found for this vendor.</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="banner">
                                            <div class="row">
                                                <div class="col-sm-12 banner">
                                                    @if (!empty($banner['banner']))
                                                        <div class="gallery_col">
                                                            <img class="img-responsive" src="{{ url('public/uploads/banner').'/'.$banner['banner'] }}" style="width: 100%;" />
                                                            <a href="javascript:void(0);" data-img="{{ base64_encode($banner['user_id']) }}" id="banner-{{ $banner['user_id'] }}" onclick="remove_banner(this);" title="Remove this image"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    @else
                                                        <div class="alert alert-danger">
                                                            <p>Sorry, No banner image are found for this vendor.</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- /.nav-tabs-custom -->
                            </div>
                            <!-- /.col -->
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