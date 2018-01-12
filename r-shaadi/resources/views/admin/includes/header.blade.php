header -->

<header class="main-header">

    <!-- Logo -->

    <a href="{{url('admin/dashboard')}}" class="logo">

        <!-- mini logo for sidebar mini 50x50 pixels -->

        <span class="logo-mini">Admin</span>

        <!-- logo for regular state and mobile devices -->

        <span class="logo-lg">Admin</span>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

        <!-- Sidebar toggle button-->

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

            <span class="sr-only">Toggle navigation</span>

        </a>



        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Notifications: style can be found in dropdown.less -->

               {{--  <li class="dropdown notifications-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <i class="fa fa-bell-o"></i>

                        <span class="label label-warning">10</span>

                    </a>

                    <ul class="dropdown-menu">

                        <li class="header">You have 10 notifications</li>

                        <li>

                            <!-- inner menu: contains the actual data -->

                            <ul class="menu">

                                <li>

                                    <a href="#">

                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today

                                    </a>

                                </li>

                                <li>

                                    <a href="#">

                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the

                                        page and may cause design problems

                                    </a>

                                </li>

                                <li>

                                    <a href="#">

                                        <i class="fa fa-users text-red"></i> 5 new members joined

                                    </a>

                                </li>

                                <li>

                                    <a href="#">

                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made

                                    </a>

                                </li>

                                <li>

                                    <a href="#">

                                        <i class="fa fa-user text-red"></i> You changed your username

                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="footer"><a href="#">View all</a></li>

                    </ul>

                </li> --}}



                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        @if (!empty(auth()->guard('admin')->user()->profile_pic))

                            <img src="{{ url('public/uploads/profile').'/'.auth()->guard('admin')->user()->profile_pic }}" class="user-image" alt="Admin Image">

                        @else

                            <img src="{{ asset('public/assets/admin/dist/img/user2-160x160.jpg') }}" class="user-image" alt="Admin Image">

                        @endif

                        <span class="hidden-xs">

                            @if (!empty(auth()->guard('admin')->user()->username))

                                {{ ucwords(auth()->guard('admin')->user()->username) }}

                            @else

                                Alexander Pierce

                            @endif

                        </span>

                    </a>

                    <ul class="dropdown-menu">

                        <!-- User image -->

                        <li class="user-header">

                            @if (!empty(auth()->guard('admin')->user()->profile_pic))

                                <img src="{{ url('public/uploads/profile').'/'.auth()->guard('admin')->user()->profile_pic }}" class="img-circle" alt="Admin Image">

                            @else

                                <img src="{{ asset('public/assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="Admin Image">

                            @endif

                            <p>
                                @if (!empty(auth()->guard('admin')->user()->username))
                                    {{ ucwords(auth()->guard('admin')->user()->username) }}
                                @else
                                    Alexander Pierce
                                @endif
                            </p>

                        </li>

                        <!-- Menu Footer-->

                        <li class="user-footer">

                            <div class="pull-left">

                                <a href="{{ url('admin/change_password') }}" class="btn btn-default btn-flat">Change Password</a>

                            </div>

                            <div class="pull-right">

                                <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">Logout</a>

                            </div>

                        </li>

                    </ul>

                </li>

                <!-- Control Sidebar Toggle Button -->

                {{-- <li>

                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>

                </li>
 --}}
            </ul>

        </div>

    </nav>

</header>

<!-- /header