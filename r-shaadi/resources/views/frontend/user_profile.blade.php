@extends('layouts.app'){{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection{{-- Content --}}
@section('content')
<?php $uprofile = ""; ?>
<?php $changepass = ""; ?>
@if(Session::has('uprofile'))
    <?php $uprofile = " active in"; ?>
@elseif(Session::has('changepass'))
    <?php $changepass = " active in"; ?>
@endif
    <section class="cotnent-area profile-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 profile-sidebar">
                    <div class="profile-photo">
                        {!! Form::open(array('url' => route('user.change_profile_pic'), 'method' => 'post', 'class' => 'form-horizontal','id'=>'profile_pic-form','enctype'=>'multipart/form-data')) !!}
                            @if (!empty($user->profile_pic))
                                <img src="{{ url('public/uploads/profile').'/'.$user->profile_pic }}" class="img-responsive profile-img img-circle"/>
                            @else
                                <img src="{{ asset('public/assets/imgs/default_user.png') }}" class="img-responsive profile-img img-circle"/>
                            @endif
                            <i class="fa fa-camera chnge-photo"></i>
                            <h4>
                                @if (!empty($user['firstname']) && !empty($user['lastname']))
                                    {{ ucwords($user['firstname']).' '.ucwords($user['lastname']) }}
                                @else
                                    John Doe
                                @endif
                            </h4>
                            <h5>
                                @if (!empty($user['country']))
                                    <i class="fa fa-map-marker"></i>
                                    {{ ucwords($user['country']) }}
                                @endif
                            </h5>
                            <input type="file" id="profile_pic" name="profile_pic" accept="image/">
                        {!! Form::close() !!}
                    </div>
                        <a href="#uprofile" aria-controls="uprofile" role="tab" data-toggle="tab"><i class="fa fa-edit"></i> Edit Profile</a>

                        <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab" style="border-bottom:0"><i class="fa fa-signal"></i> Reviews</a>

                        <a href="#bookmarks" aria-controls="bookmark" role="tab" data-toggle="tab" style="border-bottom:0"><i class="fa fa-bookmark"></i> Vendor Bookmarks</a>

                        <a href="#changepass" aria-controls="changepass" role="tab" data-toggle="tab" style="border-bottom:0"><i class="fa fa-lock"></i> Change Password</a>
                </div>

                <div class="col-sm-9 pull-right profile-content">
                    <div class="col-sm-12">
                        <div class="col-sm-12 v-profile-tabs-content row">
                            <!-- Tab panes -->
                            <div class="tab-content" style="padding:0 25px">
                                <div role="tabpanel" class="tab-pane fade {{ $uprofile }}" id="uprofile">
                                    @if (session('status_error'))
                                        <div class="alert alert-danger">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            {{ session('status_error') }}
                                        </div>
                                    @endif
                                        @if (session('status_success'))
                                            <div class="alert alert-success">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                {{ session('status_success') }}
                                            </div>
                                        @endif
                                        {!! Form::open(array('url' => route('user.store'), 'method' => 'post', 'class' => 'form-horizontal','id'=>'user-info-form')) !!}
                                        <h3 class="dheadig">User Personal Information</h3>
                                        <div class="spacer50"></div>
                                        <div class="form-group col-xs-12 p0">
                                            <label class="col-sm-3 p0">First Name <sup>*</sup></label>
                                            <div class="col-sm-7 p0 m10">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="form-control {{ $errors->has('firstname') ? ' error' : '' }}" placeholder="Firstname" type="text" name="firstname" id="firstname" value="{{ old('firstname')? old('firstname'): isset($user->firstname) ? $user->firstname : '' }}">
                                                        @if ($errors->has('firstname'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('firstname') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-12 p0">
                                            <label class="col-sm-3 p0">Last Name <sup>*</sup></label>
                                            <div class="col-sm-7 p0 m10">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="form-control {{ $errors->has('lastname') ? ' error' : '' }}" placeholder="Lastname" type="text" name="lastname" id="lastname" value="{{ old('lastname')? old('lastname'): isset($user->lastname) ? $user->lastname : '' }}">
                                                        @if ($errors->has('lastname'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('lastname') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-xs-12 p0">
                                            <label class="col-sm-3 p0">Email <sup>*</sup></label>
                                            <div class="col-sm-7 p0 m10">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="form-control" placeholder="Email" type="text" name="email" id="email" value="{{ old('email')? old('email'): !empty($user->email) ? $user->email : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-12 p0">
                                            <label class="col-sm-3 p0">Gender <sup>*</sup></label>
                                            <div class="col-sm-7 p0 m10">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="gender" id="optradio" value="1" {{ (old('gender') == '1' || (isset($user->gender) && $user->gender == '1'))?'checked="checked"':'' }}> Male
                                                        </label>                                                    <label class="radio-inline">                                                        <input type="radio" name="gender" id="optradio" value="2" {{ (old('gender') == '2' || (isset($user->gender) && $user->gender == '2'))?'checked="checked"':'' }}> Female
                                                        </label>                                                    <label class="radio-inline">                                                        <input type="radio" name="gender" id="optradio" value="3" {{ (old('gender') == '3' || (isset($user->gender) && $user->gender == '3'))?'checked="checked"':'' }}> Other
                                                        </label>                                                    @if ($errors->has('gender'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('gender') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-xs-12 p0">
                                            <label class="col-sm-3 p0">Birthdate </label>
                                            <div class="col-sm-7 p0 m10">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input class="form-control" placeholder="Birthdate" type="text" name="birthdate" id="birthdate" value="{{ old('birthdate')? old('birthdate'): !empty($user->birthdate) ? date("d-m-Y", strtotime($user->birthdate)) : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div><hr/>
                                        <div class="form-group col-xs-12 p0">
                                            <label class="col-sm-3 p0"></label>
                                            <div class="col-sm-7 p0">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button  class="btn btn-pink"> &nbsp;  &nbsp; Save &nbsp;  &nbsp; </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                        <div class="clearfix"></div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="reviews">
                                    
									<h3 class="dheadig col-sm-10 p0"> Reviews
                                        @if (count($reviews)>0)
                                            <div class="col-sm-12 p0 rate_filter">
                                                    <div class="dropdown pull-right">
                                                      <button class="btn btn-theme dropdown-toggle" type="button" data-toggle="dropdown">Sort by rating
                                                      <span class="caret"></span></button>
                                                      <ul class="dropdown-menu">
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="user-sort-rating" href="javascript:void(0);">All</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="user-sort-rating" href="javascript:void(0);">1</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="user-sort-rating" href="javascript:void(0);">2</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="user-sort-rating" href="javascript:void(0);">3</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="user-sort-rating" href="javascript:void(0);">4</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="user-sort-rating" href="javascript:void(0);">5</a></li>
                                                      </ul>
                                                    </div>
                                                </div>
                                        @endif
									</h3>
                                    <div class="spacer50" style="height:35px"></div>

                                    <div class="col-sm-10">
                                        <div class="row">
                                            @if (count($reviews)>0)
                                            <div class="recent-reviews">
                                                @foreach($reviews as $i=>$row)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="{{ url('vendor/profile').'/'.$row['user_id'] }}">
                                                            @if (!empty($row['profile_pic']))
                                                            <img class="media-object img-circle" src="{{ asset('public/uploads/profile/').'/'.$row['profile_pic'] }}" width="60" height="60"/>
                                                            @else
                                                            <img class="media-object img-circle" src="{{ asset('public/assets/imgs/default_user.png') }}" width="60" height="60" alt="...">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <div class="col-sm-8 p0">
                                                            <h4 class="media-heading">
                                                                <a class="custom-link" href="{{ url('vendor/profile').'/'.$row['user_id'] }}">
                                                                    @if (!empty($row['company_name']))
                                                                        {{ ucwords($row['company_name']) }}
                                                                    @elseif (!empty($row['firstname']) && !empty($row['lastname']))
                                                                    {{ ucwords($row['firstname']).' '.ucwords($row['lastname']) }}
                                                                    @else
                                                                    John Doe
                                                                    @endif
                                                                </a>
                                                            </h4>
                                                            <h5 class="media-subheading">Reviwed on {{ date('d-F-Y', strtotime($row['created_at'])) }}</h5>
                                                        </div>
                                                        <span class="ratingg text-right pull-right">
                                                            <input value="{{ round($row['rating']) }}" type="number" class="recent-review" data-size="s" >
                                                        </span>
                                                        <div class="col-sm-12 p0 media-cotnent">
                                                            @if (!empty($row['description']))
                                                            <span class="more">
                                                                {!! ucfirst(nl2br($row['description'])) !!}
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <div class="alert alert-danger">
                                                <p>
                                                    Sorry, No reviews are found.
                                                </p>
                                            </div>
                                            @endif
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                                <div role="tabpanel" class="tab-pane fade" id="bookmarks">
                                    <h3 class="dheadig"> Vendor Bookmarks</h3>
                                    <div class="spacer50" style="height:35px"></div>

                                    @if (count($bookmarks)>0)
                                    <table class="table table-striped">
                                        @foreach($bookmarks as $i=>$row)
                                        <tr>
                                            <td width="5%" style="vertical-align: middle;">
                                                @if (!empty($row['profile_pic']))
                                                <img class="img-responsive" src="{{ asset('public/uploads/profile/').'/'.$row['profile_pic'] }}" width="60" height="60"/>
                                                @else
                                                <img class="img-responsive" src="{{ asset('public/assets/imgs/default_user.png') }}" width="60" height="60" alt="...">
                                                @endif
                                            </td>
                                            <td width="30%" style="vertical-align: middle;">
                                                <a href="{{ url('vendor/profile').'/'.$row['user_id'] }}" class="custom-link">
                                                    <h3>
                                                        @if (!empty($row['company_name']))
                                                                    {{ ucwords($row['company_name']) }}
                                                        @elseif (!empty($row['firstname']) && !empty($row['lastname']))
                                                        {{ ucwords($row['firstname']).' '.ucwords($row['lastname']) }}
                                                        @else
                                                        John Doe
                                                        @endif
                                                    </h3>
                                                </a>
                                            </td>
                                            <td width="20%" class="text-right" style="vertical-align: middle;">
                                                <a href="{{ url('vendor/unbookmark').'/'.$row['user_id'] }}" class="btn-pink remove-bookmark">Remove</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    @else
                                    <br>
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p>
                                            Sorry, No bookmarked vendors are found.
                                        </p>
                                    </div>
                                    @endif
                                </div>

                                <div role="tabpanel" class="tab-pane fade {{ $changepass }}" id="changepass">
                                    <h3 class="dheadig"> Change Password</h3>
                                    <div class="spacer50" style="height:35px"></div>

                                    <div class="col-sm-10">
                                        <div class="row">
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
                                            <form class="form-horizontal" id="reset-password-form" role="form" method="POST" action="{{ url('/password/reset') }}">
                                                {{ csrf_field() }}

                                                <div class="form-group required">
                                                    <label for="old_password" class="col-md-4 control-label">Old Password </label>

                                                    <div class="col-md-8">
                                                        <input id="old_password" type="password" class="form-control {{ $errors->has('old_password') ? ' error' : '' }}" name="old_password" required>

                                                        @if ($errors->has('old_password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('old_password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group required">
                                                    <label for="new_password" class="col-md-4 control-label">New Password </label>

                                                    <div class="col-md-8">
                                                        <input id="new_password" type="password" class="form-control {{ $errors->has('new_password') ? ' error' : '' }}" name="new_password" required>

                                                        @if ($errors->has('new_password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('new_password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group required">
                                                    <label for="new_password_confirmation" class="col-md-4 control-label">Confirm New Password </label>
                                                    <div class="col-md-8">
                                                        <input id="new_password_confirmation" type="password" class="form-control {{ $errors->has('new_password_confirmation') ? ' error' : '' }}" name="new_password_confirmation" required>

                                                        @if ($errors->has('new_password_confirmation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <button type="submit" class="btn btn-pink">Reset Password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection