@if (empty(auth()->guard('user')->id()))
<div class="modal fade login-modal" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#userlogin" aria-controls="home" role="tab" onclick="function resetForm() {$('#vendor-login-form')[0].reset();}resetForm();" data-toggle="tab">User</a>
                    </li>
                    <li role="presentation">
                        <a href="#vendorlogin" aria-controls="profile" role="tab" onclick="function resetForm() {$('#user-login-form')[0].reset();}resetForm();" data-toggle="tab">Vendor</a>
                    </li>
                </ul>

            </div>
            <div class="modal-body login-modal">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="userlogin">

                        <div id='social-icons-conatainer'>
                            <div class="col-sm-12 headingss">
                                <h5>New to Shaadi Vibes? <a class="custom-link" href="javascript:void(0);" data-dismiss="modal" aria-hidden="true" onclick="user_registration_popup()">Create Account</a></h5>
                                <h4>Sign in your account to have access to different features</h4>
                                <hr/>
                            </div>							<div class="clearfix"></div>

                            <div class='modal-body-left  col-sm-5'>

                                <div class="modal-social-icons">
                                    <a href='javascript:void(0);' onclick="facebookLogin()" >
                                        <img src="{{ url('public/assets/imgs/loginfb.png') }}" /></a>
                                </div>

                            </div>

                            <div id="OR" class="hidden-xs">OR</div>

                            <div class='modal-body-right col-sm-6 pull-right'>
                                <form id="user-login-form" role="form" method="POST" action="{{ url('authenticate') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control login-field" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                                    </div>

                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control login-field" name="password" placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>

                                    <button  class="btn btn-pink modal-login-btn">Login</button>
                                    <div class="text-center"><a href="javascript:void(0);" onclick="forgot_password()" class="link-pink text-center">Forgot Password?</a></div>
                                </form>
                            </div>

                        </div>

                    </div>


                    <div role="tabpanel" class="tab-pane" id="vendorlogin">

                        <div class="col-sm-12 headingss">
                            <h5>New to Shaadi Vibes? <a class="custom-link" href='javascript:void(0);' onclick="vendor_registration_popup()" data-dismiss="modal" aria-hidden="true">Create Account</a></h5>
                            <h4>Sign in your account to have access to different features</h4>
                            <hr/>
                        </div><div class="clearfix"></div>

                        <form id="vendor-login-form" role="form" class="col-sm-6 text-center" style="margin:0 auto; float:none;" method="POST" action="{{ url('authenticate') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input id="email" type="email" class="form-control login-field" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control login-field" name="password" placeholder="Password">
                            </div>

                            <button  class="btn btn-pink modal-login-btn">Login</button>
                            <a href="javascript:void(0);" onclick="forgot_password()" class="link-pink text-center">Forgot Password?</a>
                        </form>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="clearfix"></div>

        </div>
    </div>
</div>



<!--modal user signup-->
<div class="modal fade login-modal" id="user-signup-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body login-modal">
                <div id='social-icons-conatainer'>
                    <div class="col-sm-12 headingss">
                        <h5>Already have a Account <a class="custom-link" href='javascript:void(0);' onclick="show_loginpopup()">Login</a></h5>
                        <h4>Please share the following details to create your profile</h4>
                        <hr/>
                    </div>
                    <div class="clearfix"></div>
                    <div class='col-sm-12' style="float:none; margin: 0 auto">
                        <form id="user-signup-form" role="form" method="POST" action="{{ url('saveregister') }}">
                            {{ csrf_field() }}
                            <div class="">
                                <div class="form-group required col-sm-6">
                                    <label class="control-label" for="firstname">Firstname</label>
                                    <input name="firstname" id="firstname" placeholder="Firstname" class="form-control login-field" type="text" value="{{ old('firstname') }}"/>
                                </div>

                                <div class="form-group required col-sm-6">
                                    <label class="control-label" for="lastname">Lastname</label>
                                    <input name="lastname" id="lastname" placeholder="Lastname" class="form-control login-field" type="text" value="{{ old('lastname') }}"/>
                                </div>
                            </div>

                            <div class="form-group required  col-md-12">
                                <label class="control-label" for="email">Email</label>
                                <input id="email" type="email" class="form-control login-field" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                            </div>

                            <div class="form-group required  col-md-12">
                                <label class="control-label" for="password">Password</label>
                                <input id="upassword" type="password" class="form-control login-field" name="upassword" placeholder="Password">
                            </div>

                            <div class="form-group required  col-md-12">
                                <label class="control-label" for="password_confirmation">Confirm Password</label>
                                <input id="upassword_confirmation" type="password" class="form-control login-field" name="upassword_confirmation" placeholder="Confirm your Password">
                            </div>

                            <button  class="btn btn-pink modal-login-btn">Create My Account</button>
                            <a href="javascript:void(0);" onclick="vendor_registration_popup()" class="link-pink text-center">Are You a Vendor?</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</div>
<!--//modal signup-->

<!--modal vendor signup-->
<div class="modal fade" id="vendor-signup-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">

                <div id='social-icons-conatainer'>
                    <div class="col-sm-12 headingss">
                        <h5 style="text-align: center;">Already have a Account <a class="custom-link" href="javascript:void(0);" onclick="show_loginpopup()">Login</a></h5>
                        <h4>Please share the following details to create your profile</h4>
                        <hr/>
                    </div>

                    <div class='col-sm-12' style="float:none; margin: 0 auto">
                        <form id="vendor-signup-form" role="form" method="POST" action="{{ url('saveregister') }}">
                            {{ csrf_field() }}

                            @if (count($category))
                            <div class="form-group  col-md-12 required">
                                <label class="control-label" for="category">Category</label>
                                <select class="form-control {{ $errors->has('category') ? ' error' : '' }}" name="category" id="category">
                                    <option value="">Select Category</option>
                                    @foreach($category as $i=>$cat)
                                    {{--@if($cat->category_id != 2 && $cat->category_id != 3 && $cat->category_id != 7 && $cat->category_id != 10 && $cat->category_id != 11 && $cat->category_id != 12 && $cat->category_id != 13 && $cat->category_id != 14 && $cat->category_id != 16)--}}
                                    <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                                   {{-- @endif--}}
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="form-group required  col-md-12">
                                <label class="control-label" for="company_name">Company Name</label>
                                <input id="vendor_company_name" type="text" class="form-control login-field" name="vendor_company_name" placeholder="Company Name" value="{{ old('vendor_company_name') }}">
                            </div>

                            <div class="">
                                <div class="form-group required col-sm-6">
                                    <label class="control-label" for="firstname">Firstname</label>
                                    <input name="vendor_firstname" id="vendor_firstname" placeholder="Firstname" class="form-control login-field" type="text" value="{{ old('vendor_firstname') }}"/>
                                </div>

                                <div class="form-group required col-sm-6">
                                    <label class="control-label" for="lastname">Lastname</label>
                                    <input name="vendor_lastname" id="vendor_lastname" placeholder="Lastname" class="form-control login-field" type="text" value="{{ old('vendor_lastname') }}"/>
                                </div>
                            </div>

                            <div class="form-group required  col-md-12">
                                <label class="control-label" for="email">Email</label>
                                <input id="email" type="email" class="form-control login-field" name="email" placeholder="Enter your email" value="{{ old('vendor_email') }}">
                            </div>

                            <div class="form-group required  col-md-12">
                                <label class="control-label" for="vpassword">Password</label>
                                <input id="vpassword" type="password" class="form-control login-field" name="vpassword" placeholder="Password">
                            </div>

                            <div class="form-group required  col-md-12">
                                <label class="control-label" for="password_confirmation">Confirm Password</label>
                                <input id="vpassword_confirmation" type="password" class="form-control login-field" name="vpassword_confirmation" placeholder="Confirm Password">
                            </div>
                            <div class="form-group col-sm-12">
                                <!-- Button -->
                                <button  class="btn btn-pink modal-login-btn">Create My Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</div>
<!--//modal signup-->

<!-- Modal -->
<div class="modal fade fogot-pw" id="forgot-password-model"  tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Fogrot Your Deatils?</h4>
            </div>

            <div class="modal-body" style="padding: 30px">
                <form id="forgot-password-form" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>
                    <button class="btn btn-pink modal-login-btn">
                        Send Password Reset Link
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endif

@if(Request::is('user/dashboard') || Request::is('vendor/dashboard'))
<!-- For alert popup -->
<div class="modal fade" id="alert-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Profile Pic Error</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>
            </div>

            <!--Modal footer-->
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end Popup -->
@endif

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <img src="{{ asset('public/assets/imgs/logo.png') }}" style="margin-bottom: 5px;" class="img-responsive"/>
                <p>{{ (isset($site_settings['site_footer_text']) && !empty($site_settings['site_footer_text'])) ? $site_settings['site_footer_text'] : 'Lorem ipsum dolor sit amet, consectetur ad ipiscing elit. Etiam tincidunt quam ante, vitae vulputate est porta vel. Ut ornare nibh et turpis ulvinar porttitor.' }}</p>
            </div>

            <div class="col-sm-2 flinks col-sm-offset-2">
                <h4>INFORMATION</h4>
                <ul>
                    <li><a href="{{ url('') }}">Home</a></li>
                    <li><a href="{{ url('page/about_us') }}">About us</a></li>
                    <li><a href="{{ url('contact_us') }}">Contact us</a></li>
                    <li><a href="{{ url('page/terms_conditions') }}">Terms & Conditons</a></li>
                    <li><a href="{{ url('page/privacy_policy') }}">Privacy Policy</a></li>
                </ul>
            </div>


            <div class="col-sm-3 sconnet pull-right">
                <h4>FOLLOW US ON</h4>
                <ul class="list-inline">
                    <li><a href="{{ (isset($site_settings['fb_url']) && !empty($site_settings['fb_url'])) ? $site_settings['fb_url'] : '#' }}"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{ (isset($site_settings['twitter_url']) && !empty($site_settings['twitter_url'])) ? $site_settings['twitter_url'] : '#' }}"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="{{ (isset($site_settings['instagram_url']) && !empty($site_settings['instagram_url'])) ? $site_settings['instagram_url'] : '#' }}"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="{{ (isset($site_settings['gplus_url']) && !empty($site_settings['gplus_url'])) ? $site_settings['gplus_url'] : '#' }}"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="{{ (isset($site_settings['snapchat_url']) && !empty($site_settings['snapchat_url'])) ? $site_settings['snapchat_url'] : '#' }}"><i class="fa fa-snapchat-ghost"></i></a></li>
                </ul>

                <h4 style="margin:30px 0 20px 0">Get the Latest Updates</h4>
                {!! Form::open(array('url' => route('user.subscribe'), 'method' => 'post', 'class' => 'form-horizontal','id'=>'subscriber-form')) !!}
                <div class="input-group">
                    <input type="text" name="subscriber" id="subscriber" class="form-control" placeholder="Email" aria-describedby="basic-addon2">
                    <span class="input-group-addon" id="subscribe-btn" onclick="subscribe();"> &nbsp; <i class="fa fa-send"></i>  &nbsp; </span>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>


    <hr/>

    <div class="container text-center">
        {{ (isset($site_settings['copyright']) && !empty($site_settings['copyright'])) ? $site_settings['copyright'] : 'Copyright © 2017 Shaadi Vibes. All rights reserved.' }}
    </div>

</footer>
