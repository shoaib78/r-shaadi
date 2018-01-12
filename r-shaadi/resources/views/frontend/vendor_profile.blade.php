@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
    <?php $vcontact = ""; ?>
    <?php $vdetails = ""; ?>
    <?php $vgallary = ""; ?>
    <?php $vreviews = ""; ?>
    <?php $changepass = ""; ?>
    @if(Session::has('vcontact'))
        <?php $vcontact = " active in"; ?>
    @elseif(Session::has('vdetails'))
        <?php $vdetails = " active in"; ?>
    @elseif(Session::has('vgallary'))
        <?php $vgallary = " active in"; ?>
    @elseif(Session::has('changepass'))
        <?php $changepass = " active in"; ?>
    @endif
<style>
.dropzone .dz-message {
    margin-bottom: 0;
}
.dropzone.dz-clickable * {
    cursor: pointer !important;
}
</style>
    <section class="cotnent-area profile-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 profile-sidebar" role="tablist">
                    <div class="profile-photo">{!! Form::open(array('url' => route('user.change_profile_pic'), 'method' => 'post', 'class' => 'form-horizontall','id'=>'profile_pic-form','enctype'=>'multipart/form-data')) !!}
                        @if (!empty($user->profile_pic))
                            <img src="{{ url('public/uploads/profile').'/'.$user->profile_pic }}" class="img-responsive profile-img img-circle"/>
                        @else
                            <img src="{{ asset('public/assets/imgs/default_user.png') }}" class="img-responsive profile-img img-circle"/>
                        @endif
                        <i class="fa fa-camera chnge-photo"></i>
                        <h4>
                            @if (isset($user['company_name']) &&!empty($user['company_name']))
                                {{ ucwords($user['company_name']) }}
                            @elseif (!empty($user['firstname']) && !empty($user['lastname']))
                                {{ ucwords($user['firstname']).' '.ucwords($user['lastname']) }}
                            @else
                                John Doe
                            @endif
                        </h4>
                        <h5>
                            @if ((isset($user2->city) && !empty($user2->city)) || (isset($user2->state) && !empty($user2->state)))
                                <i class="fa fa-map-marker"></i>
                                {{ (!empty($user2->city)) ?$user2->city.', ' : '' }}

                                @if(!empty($user2->state) && $user2->state=='Alberta')
                                    AB 
                                @elseif(!empty($user2->state) && $user2->state=='British Columbia')
                                    BC
                                @elseif(!empty($user2->state) && $user2->state=='Manitoba')
                                    MB
                                @elseif(!empty($user2->state) && $user2->state=='New Brunswick')
                                    NB
                                @elseif(!empty($user2->state) && $user2->state=='Newfoundland and Labrador')
                                    NL
                                @elseif(!empty($user2->state) && $user2->state=='Nova Scotia')
                                    NS
                                @elseif(!empty($user2->state) && $user2->state=='Northwest Territories')
                                    NT 
                                @elseif(!empty($user2->state) && $user2->state=='Nunavut')
                                    NU, 
                                @elseif(!empty($user2->state) && $user2->state=='Ontario')
                                    ON
                                @elseif(!empty($user2->state) && $user2->state=='Prince Edward Island')
                                    PE
                                @elseif(!empty($user2->state) && $user2->state=='Quebec')
                                    QC
                                @elseif(!empty($user2->state) && $user2->state=='Saskatchewan')
                                    SK
                                @elseif(!empty($user2->state) && $user2->state=='Yukon')
                                    YT
                                @endif
                            @endif
                        </h5>

                        <input type="file" id="profile_pic" name="profile_pic" accept="image/">
                        {!! Form::close() !!}
                    </div>

                    <a href="{{ url('vendor/profile').'/'.$user->id }}"><i class="fa fa-eye"></i> Preview Profile</a>

                    <a href="#vcontact" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-edit"></i> Edit Profile</a>
                    <a href="#vdetails" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-heart-o"></i> Service Details</a>
                    <a href="#vgallerymanagenemt" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-picture-o"></i> Gallery</a>
                    <a href="#vreviews" aria-controls="profile" role="tab" data-toggle="tab" style="border-bottom:0"><i class="fa fa-star-o"></i> Reviews</a>
                    <a href="#changepass" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-lock"></i> Change Password</a>

                </div>

                <div class="col-sm-9 pull-right profile-content">
                    <div class="col-sm-12">

                        <div class="col-sm-12 v-profile-tabs-content row">
                            <!-- Tab panes -->
                            <div class="tab-content" style="padding:0 25px">
                                <div role="tabpanel" class="tab-pane fade {{ $vcontact }}" id="vcontact">
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
                                    {!! Form::open(array('url' => route('vendor.store'), 'method' => 'post', 'class' => 'form-horizontall','id'=>'vendor-info-form')) !!}
                                    <h3 class="dheadig">Contact Information</h3>
                                    <div class="spacer50"></div>

                                    @if (count($category))
                                        <div class="form-group col-xs-12 p0">
                                            <label class="col-sm-3 p0" for="category">Vendor Category <sup>*</sup></label>
                                            <div class="col-sm-7 p0 m10">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-control {{ $errors->has('category') ? ' error' : '' }}" name="category" id="category">
                                                            @foreach($category as $i=>$cat)
                                                                <?php
                                                                $selected = "";
                                                                $index = 'cat'.$cat->category_id;
                                                                if(((old($index) && old($index) == $cat->category_id) || (!empty($service_category)))){
                                                                    $selected = ($cat->category_id == $user->category) ? 'selected="selected"':'';
                                                                }
                                                                ?>

                                                                @if($cat->category_id == $user->category)

                                                                    <option value="{{ $cat->category_id }}" {{ $selected }}>{{$cat->category_name}}</option>
                                                                @endif
                                                            @endforeach
                                                            @if ($errors->has('category'))
                                                                <span class="help-block">
                                                        <strong>{{ $errors->first('category') }}</strong>
                                                    </span>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Company Name <sup>*</sup></label>
                                        <div class="col-sm-7 p0 m10">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input class="form-control {{ $errors->has('company_name') ? ' error' : '' }}" placeholder="Company Name" type="text" name="company_name" id="company_name" value="{{ old('company_name')? old('company_name'): isset($user->company_name) ? $user->company_name : '' }}">
                                                    @if ($errors->has('company_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('company_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                    <input class="form-control" placeholder="Email" type="text" name="email" id="email" value="{{ old('email')? old('email'): isset($user->email) ? $user->email : '' }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Contact Email</label>
                                        <div class="col-sm-7 p0 m10">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input class="form-control" placeholder="Contact Email" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email')? old('contact_email'): isset($vendor->contact_email) ? $vendor->contact_email : '' }}">
                                                    @if ($errors->has('contact_email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                                            @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Address</label>
                                        <div class="col-sm-7 p0 m10">
                                            <input class="form-control {{ $errors->has('address1') ? ' error' : '' }}" name="address1" id="address1" placeholder="Street Address" type="text" value="{{ old('address1')? old('address1'): isset($vendor->address1) ? $vendor->address1 : '' }}">
                                            <small>Street Address</small>
                                            @if ($errors->has('address1'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address1') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <label class="col-sm-3 p0 "></label>
                                        <div class="col-sm-7 p0 m10">
                                            <input class="form-control {{ $errors->has('address2') ? ' error' : '' }}" name="address2" id="address2" placeholder="Street Address Line 2" type="text" value="{{ old('address2')? old('address2'): isset($vendor->address2) ? $vendor->address2 : '' }}">
                                            <small>Street Address Line 2</small>
                                            @if ($errors->has('address2'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address2') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <label class="col-sm-3 p0"></label>
                                        <div class="col-sm-7 p0 m10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input class="form-control {{ $errors->has('city') ? ' error' : '' }}" name="city" id="city" placeholder="City" type="text" value="{{ old('city')? old('city'): isset($vendor->city) ? $vendor->city : '' }}">
                                                    <small>City</small>
                                                    @if ($errors->has('city'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('city') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="col-sm-6">
                                                    <select class="form-control {{ $errors->has('state') ? ' error' : '' }}" name="state" id="state">
                                                        <option value="Alberta" {{ (isset($vendor->state) && $vendor->state == 'Alberta') ? 'selected="selected"' : '' }}>Alberta</option>
                                                        <option value="British Columbia" {{ (isset($vendor->state) && $vendor->state == 'British Columbia') ? 'selected="selected"' : '' }}>British Columbia</option>
                                                        <option value="Manitoba" {{ (isset($vendor->state) && $vendor->state == 'Manitoba') ? 'selected="selected"' : '' }}>Manitoba</option>
                                                        <option value="New Brunswick" {{ (isset($vendor->state) && $vendor->state == 'New Brunswick') ? 'selected="selected"' : '' }}>New Brunswick</option>
                                                        <option value="Newfoundland and Labrador" {{ (isset($vendor->state) && $vendor->state == 'Newfoundland and Labrador') ? 'selected="selected"' : '' }}>Newfoundland and Labrador</option>
                                                        <option value="Nova Scotia" {{ (isset($vendor->state) && $vendor->state == 'Nova Scotia') ? 'selected="selected"' : '' }}>Nova Scotia</option>
                                                        <option value="Ontario" {{ (isset($vendor->state) && $vendor->state == 'Ontario') ? 'selected="selected"' : '' }}>Ontario</option>
                                                        <option value="Prince Edward Island" {{ (isset($vendor->state) && $vendor->state == 'Prince Edward Island') ? 'selected="selected"' : '' }}>Prince Edward Island</option>
                                                        <option value="Quebec" {{ (isset($vendor->state) && $vendor->state == 'Quebec') ? 'selected="selected"' : '' }}>Quebec</option>
                                                        <option value="Saskatchewan" {{ (isset($vendor->state) && $vendor->state == 'Saskatchewan') ? 'selected="selected"' : '' }}>Saskatchewan</option>
                                                        <option value="Northwest Territories" {{ (isset($vendor->state) && $vendor->state == 'Northwest Territories') ? 'selected="selected"' : '' }}>Northwest Territories</option>
                                                        <option value="Nunavut" {{ (isset($vendor->state) && $vendor->state == 'Nunavut') ? 'selected="selected"' : '' }}>Nunavut</option>
                                                        <option value="Yukon" {{ (isset($vendor->state) && $vendor->state == 'Yukon') ? 'selected="selected"' : '' }}>Yukon</option>
                                                    </select>
                                                    <small>Province</small>
                                                    @if ($errors->has('state'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('state') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <label class="col-sm-3 p0"></label>
                                        <div class="col-sm-7 p0 m10">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input class="form-control {{ $errors->has('pincode') ? ' error' : '' }}" name="pincode" id="pincode" placeholder="Postal Code" type="text" value="{{ old('pincode')? old('pincode'): isset($vendor->pincode) ? $vendor->pincode : '' }}">
                                                    <small>Postal Code</small>
                                                    @if ($errors->has('pincode'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('pincode') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="col-sm-6">
                                                    <select class="form-control {{ $errors->has('country') ? ' error' : '' }}" name="country" id="country">
                                                        <option value="Canada" {{ (isset($vendor->country) && $vendor->country == 'Canada') ? 'selected="selected"' : '' }}>Canada</option>
                                                    </select>
                                                    <small>Country</small>
                                                    @if ($errors->has('country'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('country') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Phone Number</label>
                                        <div class="col-sm-4 p0 m10">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <input class="form-control {{ $errors->has('area_code') ? ' error' : '' }}" placeholder="" type="text" name="area_code" id="area_code" value="{{ old('area_code')? old('area_code'): isset($vendor->area_code) ? $vendor->area_code : '' }}">
                                                    <small>Area Code</small>
                                                    @if ($errors->has('area_code'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('area_code') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="col-sm-7">
                                                    <input class="form-control {{ $errors->has('phone_number') ? ' error' : '' }}" placeholder="" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number')? old('phone_number'): isset($vendor->phone_number) ? $vendor->phone_number : '' }}">
                                                    <small>Phone Number</small>
                                                    @if ($errors->has('phone_number'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div><hr/>

                                    <h3 class="dheadig">Social Media & Website Links</h3>
                                    <div class="spacer50"></div>

                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Website URL</label>
                                        <div class="col-sm-7 p0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input class="form-control {{ $errors->has('website_url') ? ' error' : '' }}" placeholder="Website URL" type="text" name="website_url" id="website_url" value="{{ old('website_url')? old('website_url'): isset($vendor->website_url) ? $vendor->website_url : '' }}" onfocus ="if (this.value == '') {this.value='http://'}"
                                                    onblur = "if (this.value == 'http://') {this.value=''}">
                                                    @if ($errors->has('website_url'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('website_url') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Facebook URL</label>
                                        <div class="col-sm-7 p0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input class="form-control {{ $errors->has('facebook_url') ? ' error' : '' }}" placeholder="Facebook URL" type="text" name="facebook_url" id="facebook_url" value="{{ old('facebook_url')? old('facebook_url'): isset($vendor->facebook_url) ? $vendor->facebook_url : '' }}" onfocus ="if (this.value == '') {this.value='http://'}"
                                                    onblur = "if (this.value == 'http://') {this.value=''}">
                                                    @if ($errors->has('website_url'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('website_url') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Instagram URL</label>
                                        <div class="col-sm-7 p0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input class="form-control {{ $errors->has('instagram_url') ? ' error' : '' }}" placeholder="Instagram URL" type="text" name="instagram_url" id="instagram_url" value="{{ old('instagram_url')? old('instagram_url'): isset($vendor->instagram_url) ? $vendor->instagram_url : '' }}" onfocus ="if (this.value == '') {this.value='http://'}"
                                                    onblur = "if (this.value == 'http://') {this.value=''}">
                                                    @if ($errors->has('instagram_url'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('instagram_url') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Twitter URL</label>
                                        <div class="col-sm-7 p0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input class="form-control {{ $errors->has('twitter_url') ? ' error' : '' }}" placeholder="Twitter URL" type="text" name="twitter_url" id="twitter_url" value="{{ old('twitter_url')? old('twitter_url'): isset($vendor->twitter_url) ? $vendor->twitter_url : '' }}" onfocus ="if (this.value == '') {this.value='http://'}"
                                                    onblur = "if (this.value == 'http://') {this.value=''}">
                                                    @if ($errors->has('twitter_url'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('twitter_url') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-12 p0">
                                        <label class="col-sm-3 p0">Youtube URL</label>
                                        <div class="col-sm-7 p0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input class="form-control {{ $errors->has('youtube_url') ? ' error' : '' }}" placeholder="Youtube URL" type="text" name="youtube_url" id="youtube_url" value="{{ old('youtube_url')? old('youtube_url'): isset($vendor->youtube_url) ? $vendor->youtube_url : '' }}" onfocus ="if (this.value == '') {this.value='http://'}"
                                                    onblur = "if (this.value == 'http://') {this.value=''}">
                                                    @if ($errors->has('youtube_url'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('youtube_url') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div><hr/>

                                    <h3 class="dheadig">Vendor Description</h3>
                                    <div class="spacer50"></div>
                                        <div class="form-group col-xs-12 p0">
                                            <label class="col-sm-3 p0">Company Profile <sup>*</sup></label>
                                            <div class="col-sm-7 p0">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control {{ $errors->has('about_me') ? ' error' : '' }}" rows="8" name="about_me" id="about_me" maxlength="1200">{{ old('about_me')? old('about_me'): isset($vendor->about_me) ? $vendor->about_me : '' }}</textarea>
                                                        @if ($errors->has('about_me'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('about_me') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="clearfix"></div><br/>

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
                                </div><!--tab2-->

                                <div role="tabpanel" class="tab-pane fade {{ $vdetails }}" id="vdetails">
                                    <h3 class="dheadig">Vendor Details</h3>
                                    <div class="spacer50"></div>

                                    <div class="col-sm-10">
                                        <div class="row">
                                            @if (session('service_error'))
                                                <div class="alert alert-danger">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    {{ session('service_error') }}
                                                </div>
                                            @endif

                                            @if (session('service_success'))
                                                <div class="alert alert-success">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    {{ session('service_success') }}
                                                </div>
                                            @endif

                                            @if($user->category == 1 || $user->category == 4 || $user->category == 5 || $user->category == 6 || $user->category == 8 || $user->category == 9 || $user->category == 15 || $user->category == 17)
                                                {!! Form::open(array('url' => route('vendor.store_service_values'), 'method' => 'post', 'class' => 'form-horizontall','id'=>'vendor-service-form')) !!}
                                            @endif

                                            <div class="form-group col-xs-12 p0 m10">
                                                <label class="col-sm-4 p0">Select Vendor Category <sup>*</sup></label>
                                                <div class="col-sm-5 p0">
                                                    <div class="row">
                                                        <select class="form-control {{ $errors->has('vendor_category') ? ' error' : '' }}" name="vendor_category" id="vendor_category">
                                                            @if (!empty($category))
                                                                @foreach($category as $i=>$cat)
                                                                    <?php
                                                                    $selected = "";
                                                                    $index = 'cat'.$cat->category_id;
                                                                    if(((old($index) && old($index) == $cat->category_id) || ($cat->category_id == $user->category))){
                                                                        $selected = 'selected="selected"';
                                                                    }
                                                                    ?>

                                                                    @if($cat->category_id == $user->category)

                                                                        <option value="{{ $cat->category_id }}" {{ $selected }}>{{$cat->category_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('vendor_category'))
                                                            <span class="help-block">
                                                        <strong>{{ $errors->first('vendor_category') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            @if(!empty($categories) && in_array('Wedding Venues',$categories))
                                                <div class="vcategory-box col-sm-12 {{ (old('cat1') || 1 == $user->category)?'show':'hide' }}" id="cat1">
                                                    <h3 class="vcategory-box-heading">Wedding Venues</h3>

                                                    @if(old('cat1') || 1 == $user->category)
                                                        <input type='hidden' class='cat_type' name='cat1' id='field1' value='1'/>
                                                        <input type='hidden' class='vcat' name='vcat' id='vcat1' value='1'/>
                                                    @endif

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Venue Type <sup>*</sup></label>
                                                        <div class="col-sm-7 p0 m10">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vanue_type[]" id="inlineRadio1" value="banquet hall" {{ (old('vanue_type') == 'banquet hall' || (!empty($service_detail) && isset($service_detail['vanue_type']) && in_array('banquet hall',json_decode($service_detail['vanue_type']))))?'checked="checked"':'' }}> Banquet Hall
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vanue_type[]" id="inlineRadio2" value="hotel" {{ (old('vanue_type') == 'hotel' || (!empty($service_detail) && isset($service_detail['vanue_type']) && in_array('hotel',json_decode($service_detail['vanue_type']))))?'checked="checked"':'' }}> Hotel
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vanue_type[]" id="inlineRadio3" value="country / golf club" {{ (old('vanue_type') == 'country / golf club' || (!empty($service_detail) && isset($service_detail['vanue_type']) && in_array('country / golf club',json_decode($service_detail['vanue_type']))))?'checked="checked"':'' }}> Country / Golf Club
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vanue_type[]" id="inlineRadio4" value="restaurant / lounge" {{ (old('vanue_type') == 'restaurant / lounge' || (!empty($service_detail) && isset($service_detail['vanue_type']) && in_array('restaurant / lounge',json_decode($service_detail['vanue_type']))))?'checked="checked"':'' }}> Restaurant / Lounge
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vanue_type[]" id="inlineRadio5" value="heritage property" {{ (old('vanue_type') == 'heritage property' || (!empty($service_detail) && isset($service_detail['vanue_type']) && in_array('heritage property',json_decode($service_detail['vanue_type']))))?'checked="checked"':'' }}> Heritage Property
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vanue_type[]" id="inlineRadio6" value="religious center" {{ (old('vanue_type') == 'religious center' || (!empty($service_detail) && isset($service_detail['vanue_type']) && in_array('religious center',json_decode($service_detail['vanue_type']))))?'checked="checked"':'' }}> Religious Center
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Venue Setting <sup>*</sup></label>
                                                        <div class="col-sm-7 p0 m10">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vanue_settings[]" id="inlineRadio7" value="indoor" {{ (old('vanue_settings') == 'indoor' || (!empty($service_detail) && isset($service_detail['vanue_settings']) && in_array('indoor',json_decode($service_detail['vanue_settings']))))?'checked="checked"':'' }}> Indoor
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vanue_settings[]" id="inlineRadio8" value="outdoor" {{ (old('vanue_settings') == 'outdoor' || (!empty($service_detail) && isset($service_detail['vanue_settings']) && in_array('outdoor',json_decode($service_detail['vanue_settings']))))?'checked="checked"':'' }}> Outdoor
                                                                    </label>
                                                                    @if ($errors->has('vanue_settings'))
                                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('vanue_settings') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <div class="row m10">
                                                            <div class="col-sm-6">
                                                                <label class="col-sm-7 p0">Min. Price Per Plate</label>
                                                                <div class="col-sm-3 p0">
                                                                    <div class="row">
                                                                        <input class="form-control {{ $errors->has('vanue_min_price') ? ' error' : '' }}" placeholder="Min Price" type="text" name="vanue_min_price" id="vanue_min_price" value="{{ old('vanue_min_price')? old('vanue_min_price'): !empty($service_detail) && isset($service_detail['vanue_min_price']) ?trim($service_detail['vanue_min_price']):'' }}">
                                                                        @if ($errors->has('vanue_min_price'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('vanue_min_price') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="col-sm-7 p0">Max. Price Per Plate</label>
                                                                <div class="col-sm-3 p0">
                                                                    <div class="row">
                                                                        <input class="form-control {{ $errors->has('vanue_max_price') ? ' error' : '' }}" placeholder="Max Price" type="text" name="vanue_max_price" id="vanue_max_price" value="{{ old('vanue_max_price')? old('vanue_max_price'): isset($service_detail['vanue_max_price'])?trim($service_detail['vanue_max_price']):'' }}">
                                                                        @if ($errors->has('vanue_max_price'))
                                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('vanue_max_price') }}</strong>
                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!--vcategory-box 1-->
                                            @endif

                                            @if(!empty($categories) && in_array('Wedding Photographers',$categories))
                                                <div class="vcategory-box col-sm-12 {{ (old('cat4') || 4 == $user->category)?'show':'hide' }}" id="cat4">
                                                    <h3 class="vcategory-box-heading">Wedding Photographers</h3>

                                                    @if(old('cat4') || 4 == $user->category)
                                                        <input type='hidden' class='cat_type' name='cat4' id='field4' value='4'/>
                                                        <input type='hidden' class='vcat' name='vcat' id='vcat4' value='4'/>
                                                    @endif

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-12 p0">Do you also provide vidoegraphy services?<sup>*</sup></label>
                                                        <div class="col-sm-7 p0 m10">
                                                            <label class="radio-inline col-sm-6">
                                                                <input type="radio" name="photographer_vidoegraphy_service_provide" id="vsyes" value="1" {{ (old('photographer_vidoegraphy_service_provide') == '1' || (!empty($service_detail) && isset($service_detail['photographer_vidoegraphy_service_provide']) && $service_detail['videographer_photography_service_provide'] == '1'))?'checked="checked"':'' }}> Yes
                                                            </label>
                                                            <label class="radio-inline col-sm-6">
                                                                <input type="radio" name="photographer_vidoegraphy_service_provide" id="vsno" value="0" {{ (old('photographer_vidoegraphy_service_provide') == '0' || (!empty($service_detail) && isset($service_detail['photographer_vidoegraphy_service_provide']) && $service_detail['videographer_photography_service_provide'] == '0'))?'checked="checked"':'' }}> No
                                                            </label>
                                                            @if ($errors->has('photographer_vidoegraphy_service_provide'))
                                                                <span class="help-block">
                                                        <strong>{{ $errors->first('photographer_vidoegraphy_service_provide') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-12 p0">Do you also provide Photo Booth services?<sup>*</sup></label>
                                                        <div class="col-sm-7 p0 m10">
                                                            <label class="radio-inline col-sm-6">
                                                                <input type="radio" name="photographer_photo_booth_service_provide" id="pbyes" value="1" {{ (old('photographer_photo_booth_service_provide') == '1' || (!empty($service_detail) && isset($service_detail['photographer_vidoegraphy_service_provide']) && $service_detail['photographer_photo_booth_service_provide'] == '1'))?'checked="checked"':'' }}> Yes
                                                            </label>
                                                            <label class="radio-inline col-sm-6">
                                                                <input type="radio" name="photographer_photo_booth_service_provide" id="pbno" value="0" {{ (old('photographer_photo_booth_service_provide') == '0' || (!empty($service_detail) && isset($service_detail['photographer_photo_booth_service_provide']) && $service_detail['photographer_photo_booth_service_provide'] == '0'))?'checked="checked"':'' }}> No
                                                            </label>
                                                            @if ($errors->has('photographer_photo_booth_service_provide'))
                                                                <span class="help-block">
                                                        <strong>{{ $errors->first('photographer_photo_booth_service_provide') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="clearfix"></div>

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Starting Price</label>
                                                        <div class="col-sm-5 p0">
                                                            <div class="row">
                                                                <input class="form-control {{ $errors->has('photographer_starting_price') ? ' error' : '' }}" placeholder="Starting Price" type="text" name="photographer_starting_price" id="photographer_starting_price" value="{{ old('photographer_starting_price')? old('photographer_starting_price'): !empty($service_detail) && isset($service_detail['photographer_starting_price'])?trim($service_detail['photographer_starting_price']):'' }}">
                                                                @if ($errors->has('photographer_starting_price'))
                                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('photographer_starting_price') }}</strong>
                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!--vcategory-box 3-->
                                            @endif

                                            @if(!empty($categories) && in_array('Wedding Videographers',$categories))
                                                <div class="vcategory-box col-sm-12 {{ (old('cat5') || 5 == $user->category)?'show':'hide' }}" id="cat5">
                                                    <h3 class="vcategory-box-heading">Wedding Videographers</h3>

                                                    @if(old('cat5') || 5 == $user->category)
                                                        <input type='hidden' class='cat_type' name='cat5' id='field5' value='5'/>
                                                        <input type='hidden' class='vcat' name='vcat' id='vcat5' value='5'/>
                                                    @endif

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-12 p0">Do you also provide photography services?<sup>*</sup></label>
                                                        <div class="col-sm-7 p0 m10">
                                                            <label class="radio-inline col-sm-6">
                                                                <input type="radio" name="videographer_photography_service_provide" id="vsyes" value="1" {{ (old('videographer_photography_service_provide') == '1' || (!empty($service_detail) && isset($service_detail['videographer_photography_service_provide']) && $service_detail['videographer_photography_service_provide'] == '1'))?'checked="checked"':'' }}> Yes
                                                            </label>
                                                            <label class="radio-inline col-sm-6">
                                                                <input type="radio" name="videographer_photography_service_provide" id="vsno" value="0" {{ (old('videographer_photography_service_provide') == '0' || (!empty($service_detail) && isset($service_detail['videographer_photography_service_provide']) && $service_detail['videographer_photography_service_provide'] == '0'))?'checked="checked"':'' }}> No
                                                            </label>
                                                            @if ($errors->has('videographer_photography_service_provide'))
                                                                <span class="help-block">
                                                            <strong>{{ $errors->first('videographer_photography_service_provide') }}</strong>
                                                        </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="clearfix"></div>

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Starting Price</label>
                                                        <div class="col-sm-5 p0">
                                                            <div class="row">
                                                                <input class="form-control {{ $errors->has('videographer_starting_price') ? ' error' : '' }}" placeholder="Starting Price" type="text" name="videographer_starting_price" id="videographer_starting_price" value="{{ old('videographer_starting_price')? old('videographer_starting_price'): !empty($service_detail) && isset($service_detail['videographer_starting_price'])?trim($service_detail['videographer_starting_price']):'' }}">
                                                                @if ($errors->has('videographer_starting_price'))
                                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('videographer_starting_price') }}</strong>
                                                        </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!--vcategory-box 3-->
                                            @endif

                                            @if(!empty($categories) && in_array('Bridal Hair & Makeup',$categories))
                                                <div class="vcategory-box col-sm-12 {{ (old('cat6') || 6 == $user->category)?'show':'hide' }}" id="cat6">
                                                    <h3 class="vcategory-box-heading">Bridal Hair & Makeup</h3>

                                                    @if(old('cat6') || 6 == $user->category)
                                                        <input type='hidden' class='cat_type' name='cat6' id='field6' value='6'/>
                                                        <input type='hidden' class='vcat' name='vcat' id='vcat6' value='6'/>
                                                    @endif

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-12 p0">Do you Offer Offsite Servies <sup>*</sup></label>
                                                        <div class="col-sm-7 p0 m10">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="radio-inline col-sm-6">
                                                                        <input type="radio" name="bridal_makeup_offer" id="optionoossiteyes" value="1" {{ (old('bridal_makeup_offer') == '1' || (!empty($service_detail) && isset($service_detail['bridal_makeup_offer']) && $service_detail['bridal_makeup_offer'] == '1'))?'checked="checked"':'' }}> Yes
                                                                    </label>
                                                                    <label class="radio-inline col-sm-6">
                                                                        <input type="radio" name="bridal_makeup_offer" id="optionoossiteno" value="0" {{ (old('bridal_makeup_offer') == '0' || (!empty($service_detail) && isset($service_detail['bridal_makeup_offer']) && $service_detail['bridal_makeup_offer'] == '0'))?'checked="checked"':'' }}> No
                                                                    </label>
                                                                    @if ($errors->has('bridal_makeup_offer'))
                                                                        <span class="help-block">
                                                                    <strong>{{ $errors->first('bridal_makeup_offer') }}</strong>
                                                                </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="clearfix"></div>

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Starting Price</label>
                                                        <div class="col-sm-5 p0">
                                                            <div class="row">
                                                                <input class="form-control {{ $errors->has('bridal_makeup_starting_price') ? ' error' : '' }}" placeholder="Starting Price" type="text" name="bridal_makeup_starting_price" id="bridal_makeup_starting_price" value="{{ old('bridal_makeup_starting_price')? old('bridal_makeup_starting_price'): !empty($service_detail) && isset($service_detail['bridal_makeup_starting_price'])?trim($service_detail['bridal_makeup_starting_price']):'' }}">
                                                                @if ($errors->has('bridal_makeup_starting_price'))
                                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('bridal_makeup_starting_price') }}</strong>
                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!--vcategory-box 2-->
                                            @endif

                                            @if(!empty($categories) && in_array('Wedding DJ',$categories))
                                                <div class="vcategory-box col-sm-12 {{ (old('cat8') || 8 == $user->category)?'show':'hide' }}" id="cat8">
                                                    <h3 class="vcategory-box-heading">Wedding DJ</h3>

                                                    @if(old('cat8') || 8 == $user->category)
                                                        <input type='hidden' class='cat_type' name='cat8' id='field8' value='8'/>
                                                        <input type='hidden' class='vcat' name='vcat' id='vcat8' value='8'/>
                                                    @endif

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Musics Geners Offers <sup>*</sup></label>
                                                        <div class="col-sm-7 p0 m10">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="music_geners[]" id="mgo1" value="hindi" {{ (old('music_geners') == 'hindi' || (!empty($service_detail) && isset($service_detail['wedding_dj_music_offer']) && in_array('hindi',json_decode($service_detail['wedding_dj_music_offer']))))?'checked="checked"':'' }}> Hindi
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="music_geners[]" id="mgo2" value="hiphop" {{ (old('music_geners') == 'hiphop' || (!empty($service_detail) && isset($service_detail['wedding_dj_music_offer']) && in_array('hiphop',json_decode($service_detail['wedding_dj_music_offer']))))?'checked="checked"':'' }}> Hip Hop / R&B
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="music_geners[]" id="mgo3" value="pop" {{ (old('music_geners') == 'pop' || (!empty($service_detail) && isset($service_detail['wedding_dj_music_offer']) && in_array('pop',json_decode($service_detail['wedding_dj_music_offer']))))?'checked="checked"':'' }}> Pop
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="music_geners[]" id="mgo4" value="bhangra" {{ (old('music_geners') == 'bhangra' || (!empty($service_detail) && isset($service_detail['wedding_dj_music_offer']) && in_array('bhangra',json_decode($service_detail['wedding_dj_music_offer']))))?'checked="checked"':'' }}> Bhangra
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="music_geners[]" id="mgo5" value="electronic" {{ (old('music_geners') == 'electronic' || (!empty($service_detail) && isset($service_detail['wedding_dj_music_offer']) && in_array('electronic',json_decode($service_detail['wedding_dj_music_offer']))))?'checked="checked"':'' }}> Electronic
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="music_geners[]" id="mgo6" value="arabic" {{ (old('music_geners') == 'arabic' || (!empty($service_detail) && isset($service_detail['wedding_dj_music_offer']) && in_array('arabic',json_decode($service_detail['wedding_dj_music_offer']))))?'checked="checked"':'' }}> Arabic
                                                                    </label>
                                                                    @if ($errors->has('music_geners'))
                                                                        <span class="help-block">
                                                                        <strong>{{ $errors->first('music_geners') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--vcategory-box 4-->
                                            @endif

                                            @if(!empty($categories) && in_array('Wedding Entertainment',$categories))
                                                <div class="vcategory-box col-sm-12 {{ (old('cat9') || 9 == $user->category)?'show':'hide' }}" id="cat9">
                                                    <h3 class="vcategory-box-heading">Wedding Entertainment</h3>

                                                    @if(old('cat9') || 9 == $user->category)
                                                        <input type='hidden' class='cat_type' name='cat9' id='field9' value='9'/>
                                                        <input type='hidden' class='vcat' name='vcat' id='vcat9' value='9'/>
                                                    @endif

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Sub Category</label>
                                                        <div class="col-sm-5 p0">
                                                            <div class="row">
                                                                <select class="form-control {{ $errors->has('entertainment_sub_cat') ? ' error' : '' }}" name="entertainment_sub_cat" id="entertainment_sub_cat">
                                                                    <option value="">Select</option>
                                                                    <option value="dance_performers" {{ (old('entertainment_sub_cat') == 'dance_performers' || (!empty($service_detail) && isset($service_detail['wedding_entertainment_sub_category']) && $service_detail['wedding_entertainment_sub_category'] == 'dance_performers'))?'selected="selected"':'' }}>Dance Performers</option>
                                                                    <option value="wedding_singers_/_musicians" {{ (old('entertainment_sub_cat') == 'wedding_singers_/_musicians' || (!empty($service_detail) && isset($service_detail['wedding_entertainment_sub_category']) && $service_detail['wedding_entertainment_sub_category'] == 'wedding_singers_/_musicians'))?'selected="selected"':'' }}>Wedding Singers/Musicians</option>
                                                                </select>
                                                                @if ($errors->has('entertainment_sub_cat'))
                                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('entertainment_sub_cat') }}</strong>
                                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!--vcategory-box 6-->
                                            @endif

                                            @if(!empty($categories) && in_array('Officiant',$categories))
                                                <div class="vcategory-box col-sm-12 {{ (old('cat15') || 15 == $user->category)?'show':'hide' }}" id="cat15">
                                                    <h3 class="vcategory-box-heading">Officiant</h3>

                                                    @if(old('cat15') || 15 == $user->category)
                                                        <input type='hidden' class='cat_type' name='cat15' id='field15' value='15'/>
                                                        <input type='hidden' class='vcat' name='vcat' id='vcat15' value='15'/>
                                                    @endif

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Religion</label>
                                                        <div class="col-sm-5 p0">
                                                            <div class="row">
                                                                <select class="form-control {{ $errors->has('relegion') ? ' error' : '' }}" name="relegion" id="relegion">
                                                                    <option value="">Select</option>
                                                                    <option value="Buddhist" {{ (old('relegion') == 'Buddhist' || (!empty($service_detail) && isset($service_detail['officiant_religion']) && $service_detail['officiant_religion'] == 'Buddhist'))?'selected="selected"':'' }}>Buddhist</option>
                                                                    <option value="Christian" {{ (old('relegion') == 'Christian' || (!empty($service_detail) && isset($service_detail['officiant_religion']) && $service_detail['officiant_religion'] == 'Christian'))?'selected="selected"':'' }}>Christian</option>
                                                                    <option value="Islam" {{ (old('relegion') == 'Islam' || (!empty($service_detail) && isset($service_detail['officiant_religion']) && $service_detail['officiant_religion'] == 'Islam'))?'selected="selected"':'' }}>Islam</option>
                                                                    <option value="Hindu" {{ (old('relegion') == 'Hindu' || (!empty($service_detail) && isset($service_detail['officiant_religion']) && $service_detail['officiant_religion'] == 'Hindu'))?'selected="selected"':'' }}>Hindu</option>
                                                                    <option value="Sikh" {{ (old('relegion') == 'Sikh' || (!empty($service_detail) && isset($service_detail['officiant_religion']) && $service_detail['officiant_religion'] == 'Sikh'))?'selected="selected"':'' }}>Sikh</option>
                                                                </select>
                                                                @if ($errors->has('relegion'))
                                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('relegion') }}</strong>
                                                            </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!--vcategory-box 7-->
                                            @endif

                                            @if(!empty($categories) && in_array('Transportation',$categories))
                                                <div class="vcategory-box col-sm-12 {{ (old('cat17') || 17 == $user->category)?'show':'hide' }}" id="cat17">
                                                    <h3 class="vcategory-box-heading">Transportation</h3>

                                                    @if(old('cat17') || 17 == $user->category)
                                                        <input type='hidden' class='cat_type' name='cat17' id='field17' value='17'/>
                                                        <input type='hidden' class='vcat' name='vcat' id='vcat17' value='17'/>
                                                    @endif

                                                    <div class="form-group col-xs-12 p0 m10">
                                                        <label class="col-sm-4 p0">Vehicles Available <sup>*</sup></label>
                                                        <div class="col-sm-7 p0 m10">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t1" value="standard_limo" {{ (old('vehicles') == 'standard_limo' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('standard_limo',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Standard Limo
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t2" value="stretch_limo" {{ (old('vehicles') == 'stretch_limo' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('stretch_limo',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Stretch Limo
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t3" value="exotic" {{ (old('vehicles') == 'exotic' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('exotic',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Exotic
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t4" value="van" {{ (old('vehicles') == 'van' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('van',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Van
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t5" value="motercycle" {{ (old('vehicles') == 'motercycle' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('motercycle',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Motercycle
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t6" value="suv" {{ (old('vehicles') == 'suv' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('suv',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> SUV Limo
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t7" value="classic_car" {{ (old('vehicles') == 'classic_car' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('classic_car',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Classic Car
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t8" value="sedan" {{ (old('vehicles') == 'sedan' || (isset($service_detail['transportation_vechile_available']) && in_array('sedan',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Sedan
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t8" value="shuttle_bus" {{ (old('vehicles') == 'shuttle_bus' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('shuttle_bus',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Shuttle Bus
                                                                    </label>
                                                                    <label class="checkbox-inline col-sm-6">
                                                                        <input type="checkbox" name="vehicles[]" id="t9" value="horse_&_carriage" {{ (old('vehicles') == 'horse_&_carriage' || (!empty($service_detail) && isset($service_detail['transportation_vechile_available']) && in_array('horse_&_carriage',json_decode($service_detail['transportation_vechile_available']))))?'checked="checked"':'' }}> Horse & Carriage
                                                                    </label>
                                                                    @if ($errors->has('vehicles'))
                                                                        <span class="help-block">
                                                                        <strong>{{ $errors->first('vehicles') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--vcategory-box 5-->
                                            @endif
                                                <!--vcategory-box 7-->

                                        </div>

                                    </div>
                                    <div class="clearfix"></div><br/>

                                    @if($user->category == 1 || $user->category == 4 || $user->category == 5 || $user->category == 6 || $user->category == 8 || $user->category == 9 || $user->category == 15 || $user->category == 17)
                                        <div class="form-group col-xs-12 p0">
                                            <div class="col-sm-7 p0">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button  class="btn btn-pink"> &nbsp;  &nbsp; Save &nbsp;  &nbsp; </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    {!! Form::close() !!}
                                    @endif
                                    <div class="clearfix"></div>
                                </div><!--tab1-->

                                <div role="tabpanel" class="tab-pane fade {{ $vgallary }}" id="vgallerymanagenemt">
                                    <h3 class="dheadig">Gallery</h3>
                                    <div class="spacer50"></div>
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
                                        <div class="col-sm-8">
                                            <div class="form-group col-xs-12 p0">
                                                <label class="col-sm-12 p0">Banner Image</label>
                                                <div id="banner-preview" class="dropzone dz-clickable">
                                                    {{--<img src="{{ asset('public/assets/imgs/lisitng.png') }}" class="img-responsive img-thumbnail"/>--}}
                                                </div>
                                            </div>

                                            <div class="form-group col-xs-12 p0">
                                                <label class="col-sm-12 p0">Upload Banner Images</label>

                                                <!--Drop Zone will be placed here in place of this image-->
                                                <div class="col-sm-12 p0 drop-zone dropzone" id="banner-dropzone">
                                                    
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr style="border-color: #e72e77;" />

                                            <div class="form-group col-xs-12 p0">
                                                <label class="col-sm-12 p0">Gallery Image</label>
                                                <ul class="list-inline galleryviews dropzone dz-clickable" id="gallary-preview">
                                                    {{--<li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>
                                                    <li><img src="{{ asset('public/assets/imgs/g3.png') }}" class="img-responsive img-thumbnail"/> <i class="fa fa-close"></i></li>--}}
                                                </ul>
                                            </div>

                                            <div class="form-group col-xs-12 p0 m10">
                                                <label class="col-sm-12 p0">Upload Gallery Images</label>

                                                <!--Drop Zone will be placed here in place of this image-->
                                                <div class="col-sm-12 p0 drop-zone m10 dropzone" id="gallary-dropzone">

                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>


                                    <div class="clearfix"></div>
                                </div><!--tab2-->

                                <div role="tabpanel" class="tab-pane fade {{ $vreviews }}" id="vreviews">
                                    <h3 class="dheadig">Reviews
                                        @if (count($reviews)>0)
                                            <div class="col-sm-12 p0 rate_filter">
                                                    <div class="dropdown pull-right">
                                                      <button class="btn btn-theme dropdown-toggle" type="button" data-toggle="dropdown">Sort by rating
                                                      <span class="caret"></span></button>
                                                      <ul class="dropdown-menu">
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="sort-rating" href="javascript:void(0);">All</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="sort-rating" href="javascript:void(0);">1</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="sort-rating" href="javascript:void(0);">2</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="sort-rating" href="javascript:void(0);">3</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="sort-rating" href="javascript:void(0);">4</a></li>
                                                        <li><a data-val="{{ auth()->guard('user')->id() }}" class="sort-rating" href="javascript:void(0);">5</a></li>
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
                                                                <a href="javascript:void(0)">
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
                                                                        @if (!empty($row['anonymous']))
                                                                           Anonymous
                                                                        @elseif (!empty($row['name']))
                                                                            {{ ucwords($row['name']) }}
                                                                        @else
                                                                            John Geo
                                                                        @endif
                                                                    </h4>
                                                                    <h6 class="media-subheading">Reviwed on {{ date('d-F-Y', strtotime($row['created_at'])) }}</h5>
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

                                                                    {{--@if (strlen ($row['description'])>150)
                                                                        <a href="#">Read Full Review</a>
                                                                    @endif--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="alert alert-danger">
                                                    <p>
                                                        Sorry, No reviews are founds.
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div><!--tab3-->

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
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Dropzone.autoDiscover = false;
            if ($('#banner-dropzone').length) {
                var myDropzone = new Dropzone("#banner-dropzone", {
                    url: "{{url('banner/store')}}",
                    maxFiles: 1, //change limit as per your requirements
                    dictRemoveFile: 'Remove File',
                    previewsContainer: '#banner-preview',
                    acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
                    dictDefaultMessage: '<img src="{{ asset('public/assets/imgs/uplod.png') }}" class="img-responsive"/>',
                    addRemoveLinks: true,
                    maxFilesize: 2, // MB

                    sending: function (file, xhr, formData) {
                        // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
                        formData.append("_token", $('meta[name="csrf-token"]').attr('content')); // Laravel expect the token post value to be named _token by default
                    },
                    init: function () {
                        @if (!empty($user->banner))
                            var filename = "{{ $user->banner }}";
                            bannerDropzone = this;
                            $.get("{{url('banner/getFiles')}}/"+filename, function(data) {
                                    var data = jQuery.parseJSON(data);
                                    //console.log(data.output);
                                    if(!data.error){
                                        value = data.output;
                                        var mockFile = { name: value.name, size: value.size, accepted: true };
                                        mockFile.serverId = value.file_id;
                                        bannerDropzone.emit("addedfile", mockFile);
                                        bannerDropzone.emit("thumbnail", mockFile, value.thumb_path);
                                        bannerDropzone.emit("complete", mockFile);
                                        bannerDropzone.files.push(mockFile);
                                        $(mockFile.previewElement).find(".dz-remove").addClass("btn btn-danger");
                                        //create the anchor tag and specify HREF as image name or path
                                        var anchor_to_fancybox = document.createElement("a");
                                        $(anchor_to_fancybox).attr('href', value.file);
                                        $(anchor_to_fancybox).attr('data-fancybox', 'banner');
                                        //When you hover over the thumbnail, a div called dz-details is shown.
                                        //This div is contained within previewElement and contains size and name. 
                                        //Append our anchor in its HTML.
                                        $(mockFile.previewElement).after(anchor_to_fancybox);
                                        $(mockFile.previewElement).appendTo($(mockFile.previewElement).next('a'));
                                        /*$(mockFile.previewElement).find('.dz-filename').appendTo($(mockFile.previewElement).find('.dz-details a'));
                                        $("#attachment").val(value.name);*/
                                    }
                                }
                            );
                        @endif
                            this.on("success", function (file, response) {
                            response = JSON.parse(response);
                            if (!response.error) {
                                file.serverId = response.file_id;
                                file.filename = response.file_name;
                                $(file.previewElement).find('[data-dz-name]').html(response.file_name);
                                //create the anchor tag and specify HREF as image name or path
                                var anchor_to_fancybox = document.createElement("a");
                                $(anchor_to_fancybox).attr('href', "{{url('public/uploads/banner')}}/"+response.file_name);
                                $(anchor_to_fancybox).attr('data-fancybox', 'gallery');
                                //When you hover over the thumbnail, a div called dz-details is shown.
                                //This div is contained within previewElement and contains size and name. 
                                //Append our anchor in its HTML.
                                $(file.previewElement).find('.dz-image img').attr('src', "{{url('public/uploads/banner/thumbnail')}}/"+response.file_name);
                                $(file.previewElement).after(anchor_to_fancybox);
                                $(file.previewElement).appendTo($(file.previewElement).next('a'));
                                $(file.previewElement).find(".dz-remove").addClass("btn btn-danger");
                                $("#banner").val(response.file_name);
                            } else {
                                var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + response.message + '</div>';
                                bootbox.alert(msg);
                            }
                        });
                        this.on("removedfile", function (file) {
                            if (!file.serverId) {
                                return;
                            } // The file hasn't been uploaded
                            bootbox.confirm("Are you sure you want to remove this banner image?", function(result){
                                if (result) {
                                    $.ajax({
                                        url: "{{url('banner/delete')}}",
                                        type: "post",
                                        data: {file_id: file.serverId},
                                        success: function (response) {
                                            response = JSON.parse(response);
                                            $("#banner").val('');
                                        },
                                    });
                                }
                            });
                        });
                    }
                });
            }

            Dropzone.autoDiscover = false;
            if ($('#gallary-dropzone').length) {
                var myDropzone = new Dropzone("#gallary-dropzone", {
                    url: "{{url('gallary/store')}}",
                    maxFiles: 10, //change limit as per your requirements
                    dictRemoveFile: 'Remove File',
                    previewsContainer: '#gallary-preview',
                    acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
                    dictDefaultMessage: '<img src="{{ asset('public/assets/imgs/uplod.png') }}" class="img-responsive"/>',
                    addRemoveLinks: true,
                    maxFilesize: 2, // MB

                    sending: function (file, xhr, formData) {
                        // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
                        formData.append("_token", $('meta[name="csrf-token"]').attr('content')); // Laravel expect the token post value to be named _token by default
                    },
                    init: function () {
                        @if (!empty($gallary) && auth()->guard('user')->id())
                            @foreach($gallary as $i=>$row)
                                var filename = "{{ $row }}";
                                gallaryDropzone = this;
                                $.get("{{url('gallary/getFiles')}}/"+filename, function(data) {
                                        var data = jQuery.parseJSON(data);
                                        var gallaryFile = '';
                                        if(!data.error){
                                            value = data.output;
                                            gallaryFile = { name: value.name, size: value.size, accepted: true };
                                            gallaryFile.serverId = value.file_id;
                                            gallaryDropzone.emit("addedfile", gallaryFile);
                                            gallaryDropzone.emit("thumbnail", gallaryFile, value.thumb_path);
                                            gallaryDropzone.emit("complete", gallaryFile);
                                            gallaryDropzone.files.push(gallaryFile);
                                            $(gallaryFile.previewElement).find(".dz-remove").addClass("btn btn-danger");
                                            //create the anchor tag and specify HREF as image name or path
                                            var anchor_to_fancybox = document.createElement("a");
                                            $(anchor_to_fancybox).attr('href', value.file);
                                            $(anchor_to_fancybox).attr('data-fancybox', 'gallery');
                                            //When you hover over the thumbnail, a div called dz-details is shown.
                                            //This div is contained within previewElement and contains size and name. 
                                            //Append our anchor in its HTML.
                                            $(gallaryFile.previewElement).after(anchor_to_fancybox);
                                            $(gallaryFile.previewElement).appendTo($(gallaryFile.previewElement).next('a'));
                                        }
                                    }
                                );
                            @endforeach
                        @endif
                            this.on("success", function (file, response) {
                            response = JSON.parse(response);
                            if (!response.error) {
                                file.serverId = response.file_id;
                                file.filename = response.file_name;
                                $(file.previewElement).find('[data-dz-name]').html(response.file_name);
                                //create the anchor tag and specify HREF as image name or path
                                var anchor_to_fancybox = document.createElement("a");
                                $(anchor_to_fancybox).attr('href', "{{url('public/uploads/gallary')}}/"+response.file_name);
                                $(anchor_to_fancybox).attr('data-fancybox', 'gallery');
                                //When you hover over the thumbnail, a div called dz-details is shown.
                                //This div is contained within previewElement and contains size and name. 
                                //Append our anchor in its HTML.
                                $(file.previewElement).find('.dz-image img').attr('src', "{{url('public/uploads/gallary/thumbnail')}}/"+response.file_name);
                                $(file.previewElement).after(anchor_to_fancybox);
                                $(file.previewElement).appendTo($(file.previewElement).next('a'));
                                $(file.previewElement).find(".dz-remove").addClass("btn btn-danger");
                            } else {
                                var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + response.message + '</div>';
                                bootbox.alert(msg);
                            }
                        });
                        this.on("removedfile", function (file) {
                            if (!file.serverId) {
                                return;
                            } // The file hasn't been uploaded
                            bootbox.confirm("Are you sure you want to remove this image from your gallary?", function(result){
                                if (result) {
                                    $.ajax({
                                        url: "{{url('gallary/delete')}}",
                                        type: "post",
                                        data: {file_id: file.serverId},
                                        success: function (response) {
                                            response = JSON.parse(response);
                                            /*var output = $(".storage_files").map(function () {
                                                return $(this).val();
                                            }).get().join(',');
                                            $("#gallary").val(output);*/
                                        },
                                    });
                                }
                            });
                        });
                    }
                });
            }
        });
    </script>
@endsection