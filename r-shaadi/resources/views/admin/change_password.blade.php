@extends('layouts.admin')

{{-- Web site Title --}}

@section('title') {!! $title !!} :: @parent @endsection



{{-- Content --}}

@section('content')

<style>

    .profile-img-container {

        position: relative;

        display: inline-block; /* added */

        overflow: hidden; /* added */

        left: 15%;

    }



    .profile-img-container img {width:150px; height: 150px;} /* remove if using in grid system */



    .profile-img-container img:hover {

        opacity: 0.5

    }

    .profile-img-container:hover a {

        opacity: 1; /* added */

        top: 0; /* added */

        z-index: 500;

    }

    /* added */

    .profile-img-container:hover a span {

        top: 50%;

        position: absolute;

        left: 0;

        right: 0;

        transform: translateY(-50%);

    }

    /* added */

    .profile-img-container a {

        display: block;

        position: absolute;

        top: -100%;

        opacity: 0;

        left: 0;

        bottom: 0;

        right: 0;

        text-align: center;

        color: inherit;

    }

    .Profile-input-file{

        height:180px;width:180px;left:33%;

        position: absolute;

        top: 0px;

        z-index: 999;

        opacity: 0 !important;

        visibility: hidden;

    }



    #PicUpload{

        color: #ffffff;

        width: 180px;

        height: 180px;

        padding: 100px;

        position: absolute;

        border-radius: 50%;

        top:-27%;

        display: none;

    }

    .camera{

        font-size: 20px;

        color: #333333;

        cursor: pointer;

    }

    .form-group.required .control-label:after {

        content:"*";

        color:#d40000;

    }

</style>

<!-- Content Wrapper. Contains page content -->

<?php $profile = ""; ?>

<?php $password = ""; ?>

@if(Session::has('profile'))

    <?php $profile = " active"; ?>

@elseif(Session::has('password'))

    <?php $password = " active"; ?>

@endif

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Change Password

        </h1>



        <ol class="breadcrumb">

            <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Admin profile</li>

        </ol>

    </section>

    <!-- Main content -->

    <section class="content">



        <div class="row">

            <div class="col-md-3">

                {{--<pre>{{ print_r(auth()->guard('admin')->user()->profession) }}</pre>--}}

                <!-- Profile Image -->

                <div class="box box-primary">

                    <div class="box-body box-profile">

                        {!! Form::open(array('url' => route('admin.change_profile_pic'), 'method' => 'post', 'class' => 'form-horizontal','id'=>'profile_pic-form','enctype'=>'multipart/form-data')) !!}

                        <div class="profile-img-container text-center">

                            @if (!empty($admin->profile_pic))

                                <img src="{{ url('public/uploads/profile').'/'.$admin->profile_pic }}" class="profile-user-img img-responsive img-circle" alt="Admin profile picture"/>

                            @else

                                <img src="{{ asset('public/assets/admin/dist/img/user2-160x160.jpg') }}" class="profile-user-img img-responsive img-circle" alt="Admin profile picture">

                            @endif

                                <a href="javascript:void(0)"><span class="fa fa-camera camera"></span></a>



                                <input type="file" id="image-input" name="image-input" accept="image/*" class="form-control form-input Profile-input-file" >

                        </div>

                        {!! Form::close() !!}



                        <h3 class="profile-username text-center">

                            @if (!empty($admin->firstname) && !empty($admin->lastname))

                                {{ ucwords($admin->firstname).' '.ucwords($admin->lastname) }}

                            @else

                                John Doe

                            @endif

                        </h3>



                        @if (!empty($admin->profession))

                            <p class="text-muted text-center">{{ ucwords($admin->profession) }}</p>

                        @endif

                    </div>

                    <!-- /.box-body -->

                </div>

                <!-- /.box -->

            </div>

            <!-- /.col -->

            <div class="col-md-9">

                <div class="nav-tabs-custom">

                    <ul class="nav nav-tabs">

                        {{-- <li class="{{ $profile }}"><a href="#edit_profile" data-toggle="tab">Edit Profile</a></li>
 --}}
                        <li class="active"><a href="#change_password" data-toggle="tab">Change Password</a></li>

                    </ul>

                    <div class="tab-content">

                       {{-- <div class="tab-pane {{ $profile }}" id="edit_profile">

                           @if (session('profile_error'))

                               <div class="alert alert-danger">

                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                   {{ session('profile_error') }}

                               </div>

                           @endif



                           @if (session('profile_success'))

                               <div class="alert alert-success">

                                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                   {{ session('profile_success') }}

                               </div>

                           @endif

                           {!! Form::open(array('url' => route('admin.edit'), 'method' => 'post', 'class' => 'form-horizontal','id'=>'admin-profile-form')) !!}

                                <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }} required">

                                    <label for="firstname" class="col-sm-2 control-label">First Name</label>



                                    <div class="col-sm-10">

                                        <input class="form-control {{ $errors->has('firstname') ? ' error' : '' }}" placeholder="First Name" type="text" name="firstname" id="firstname" value="{{ old('firstname')? old('firstname'): isset($admin->firstname) ? $admin->firstname : '' }}">

                                        @if ($errors->has('firstname'))

                                            <span class="help-block">

                                                    <strong>{{ $errors->first('firstname') }}</strong>

                                                </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }} required">

                                    <label for="lastname" class="col-sm-2 control-label">Last Name </label>



                                    <div class="col-sm-10">

                                        <input class="form-control {{ $errors->has('lastname') ? ' error' : '' }}" placeholder="Last Name" type="text" name="lastname" id="lastname" value="{{ old('lastname')? old('lastname'): isset($admin->lastname) ? $admin->lastname : '' }}">

                                        @if ($errors->has('lastname'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('lastname') }}</strong>

                                            </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} required">

                                    <label for="email" class="col-sm-2 control-label">Email</label>



                                    <div class="col-sm-10">

                                        <input class="form-control" placeholder="Email" type="text" name="email" id="email" value="{{ old('email')? old('email'): isset($admin->email) ? $admin->email : '' }}">

                                        @if ($errors->has('email'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('email') }}</strong>

                                            </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }} required">

                                    <label for="username" class="col-sm-2 control-label">Username</label>



                                    <div class="col-sm-10">

                                        <input class="form-control" placeholder="Username" type="text" name="username" id="username" value="{{ old('username')? old('username'): isset($admin->username) ? $admin->username : '' }}">

                                        @if ($errors->has('username'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('username') }}</strong>

                                            </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="profession" class="col-sm-2 control-label">Profession</label>



                                    <div class="col-sm-10">

                                        <input class="form-control" placeholder="Profession" type="text" name="profession" id="profession" value="{{ old('profession')? old('profession'): isset($admin->profession) ? $admin->profession : '' }}">

                                        @if ($errors->has('profession'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('profession') }}</strong>

                                            </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="about_me" class="col-sm-2 control-label">About Me</label>



                                    <div class="col-sm-10">

                                        <textarea class="form-control" id="about_me" name="about_me" placeholder="About Me">{{ old('about_me')? old('about_me'): isset($admin->about_me) ? $admin->about_me : '' }}</textarea>

                                        @if ($errors->has('about_me'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('about_me') }}</strong>

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            

                                <div class="form-group">

                                    <div class="col-sm-offset-2 col-sm-10">

                                        <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>

                                    </div>

                                </div>

                           {!! Form::close() !!}

                        </div>
 --}}
                        <!-- /.tab-pane -->



                        <div class="tab-pane active" id="change_password">

                            @if (session('password_error'))

                                <div class="alert alert-danger">

                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                    {{ session('password_error') }}

                                </div>

                            @endif



                            @if (session('password_success'))

                                <div class="alert alert-success">

                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                                    {{ session('password_success') }}

                                </div>

                            @endif

                            <form class="form-horizontal" id="reset-password-form" role="form" method="POST" action="{{ url('admin/reset_password') }}">

                                {{ csrf_field() }}

                                <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }} required">

                                    <label for="old_password" class="col-sm-2 control-label">Old Password </label>



                                    <div class="col-sm-10">

                                        <input id="old_password" type="password" class="form-control" name="old_password" required>



                                        @if ($errors->has('old_password'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('old_password') }}</strong>

                                            </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }} required">

                                    <label for="new_password" class="col-sm-2 control-label">New Password </label>



                                    <div class="col-sm-10">

                                        <input id="new_password" type="password" class="form-control" name="new_password" required>



                                        @if ($errors->has('new_password'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('new_password') }}</strong>

                                            </span>

                                        @endif

                                    </div>

                                </div>

                                <div class="form-group {{ $errors->has('confirm_new_password') ? ' has-error' : '' }} required">

                                    <label for="new_password_confirmation" class="col-sm-2 control-label">Confirm New Password </label>



                                    <div class="col-sm-10">

                                        <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>



                                        @if ($errors->has('new_password_confirmation'))

                                            <span class="help-block">

                                                <strong>{{ $errors->first('new_password_confirmation') }}</strong>

                                            </span>

                                        @endif

                                    </div>

                                </div>



                                <div class="form-group">

                                    <div class="col-sm-offset-2 col-sm-10">

                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </div>

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