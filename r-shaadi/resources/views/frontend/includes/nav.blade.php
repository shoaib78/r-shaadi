<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}">
                @if (isset($site_settings['logo']) && $site_settings['logo'] != '')
                    <img src="{{ url('public/uploads').'/'.$site_settings['logo']}}">
                @else
                    <img src="{{ asset('public/assets/imgs/logo.png') }}"/>
                @endif
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown megamenu-main">
                    <a href="{{ url('listings') }}" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Vendors
                        <span class="fa fa-angle-down"></span></a>
                    <ul class="dropdown-menu megamenu" >
                        @if (count($category)>0)
                            @foreach($category as $i=>$cat)
                                @if($i%2 == 0)
                                    <div class="col-sm-7">
                                        <li><a href="{{ url('listings').'/'.$cat->category_id}}">{{$cat->category_name}}</a></li>
                                    </div>
                                @else
                                    <div class="col-sm-5">
                                        <li><a href="{{ url('listings').'/'.$cat->category_id}}">{{$cat->category_name}}</a></li>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        @if (empty(auth()->guard('user')->id()))
                            <div class="dpfooter">
                                <span class="col-sm-6">Are you a Vendor?</span>
                                <a href='javascript:void(0);' onclick="vendor_registration_popup()" style="padding:0!important;" class="col-sm-6 text-right">Register now</a>
                            </div>
                        @endif
                    </ul>
                </li>
                <li><a href="{{ url('gallery') }}">Photos</a></li>
            </ul>




            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ url('listings') }}">Write a Review</a></li>
                @if (empty(auth()->guard('user')->id()))
                <li><a href="javascript:void(0)" onclick="show_loginpopup(this)">Login</a></li>
                <li class="login"><a href="javascript:void(0)" onclick="user_registration_popup()">Join</a></li>
                @else
                    <li class="dropdown login-dpdn">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            @if (!empty($user->profile_pic))
                                <img src="{{ url('public/uploads/profile').'/'.$user->profile_pic }}"/>
                            @else
                                <img src="{{ asset('public/assets/imgs/default.png') }}"/>
                            @endif
                            
                            @if (isset($user['company_name']) &&!empty($user['company_name']))
                                {{ ucwords($user['company_name']) }}
                            @elseif (!empty($user['firstname']) && !empty($user['lastname']))
                                {{ ucwords($user['firstname']).' '.ucwords($user['lastname']) }}
                            @else
                                John Doe
                            @endif

                            <span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @if ($user->usertype == 1)
                                <li><a href="{{ url('user/dashboard') }}"><i class="fa fa-user"></i> Profile</a></li>
                            @elseif($user->usertype == 2)
                                <li><a href="{{ url('vendor/dashboard') }}"><i class="fa fa-user"></i> Profile</a></li>
                            @else
                                <li><a href="{{ url('') }}"><i class="fa fa-user"></i> Profile</a></li>
                            @endif
                               {{--  <li><a href="{{ url('user/reset_password') }}"><i class="fa fa-gear"></i> Setting</a></li> --}}
                                <li><a href="{{ url('user/logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                @endif
                <li class="{{ isset($search) ? 'open' : ''}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu search-dpdn" >
                        <li>
                            {!! Form::open(array('url' => route('vendor.search'), 'method' => 'get', 'class' => 'form-horizontall','id'=>'vendor-search-form')) !!}
                            <div class="input-group">
                                <input name="search" id="search" type="text" class="form-control" placeholder="Search Vendor" value="{{ isset($search) ? $search : ''}}" aria-describedby="basic-addon2">
                                <span onclick="serach_vendor();" onKeypress="submit_vendor();" onkeydown="submit_vendor();" class="search-vendor input-group-addon" id="basic-addon2">Search</span>
                            </div>
                            {!! Form::close() !!}
                        </li>
                    </ul>

                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>