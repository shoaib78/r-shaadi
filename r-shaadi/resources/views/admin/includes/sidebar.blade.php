<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image"> 
	            @if (!empty(auth()->guard('admin')->user()->profile_pic)) 
	            	<img src="{{ url('public/uploads/profile').'/'.auth()->guard('admin')->user()->profile_pic }}" class="img-circle" alt="Admin Image"> 
	            @else 
	            	<img src="{{ asset('public/assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="Admin Image">
	            @endif
         	</div>

            <div class="pull-left info">
                <p> 
	                @if (!empty(auth()->guard('admin')->user()->username))
	                	{{ ucwords(auth()->guard('admin')->user()->username) }}
	            	@else
	            		Alexander Pierce
	        		@endif
        		</p>
		 	<a href="{{ url('admin/profile') }}"><i class="fa fa-circle text-success"></i> Online</a> </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."> <span class="input-group-btn">                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>                </button>              </span> </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ (Request::is('admin/dashboard') ? 'active' : '') }}">
                <a href="{{ url('admin') }}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>
            </li>
            <li class="{{ (Request::is('admin/manage_vendors') || Request::segment(2) == 'vendor_detail' || Request::segment(2) == 'user_detail'|| Request::segment(2) == 'gallary' || Request::segment(2) == 'review'? 'active' : '') }} {{ (Request::is('admin/manage_users') ? 'active' : '') }} treeview">
                <a href="#"> <i class="fa fa-users"></i> <span>Manage User</span> <span class="pull-right-container">                        <i class="fa fa-angle-left pull-right"></i>                        </span> </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('admin/manage_vendors') || Request::segment(2) == 'vendor_detail' || Request::segment(2) == 'gallary' || Request::segment(2) == 'review'? 'active' : '') }}" class="active"><a href="{{ url('admin/manage_vendors') }}"><i class="fa fa-user"></i> Manage Vendors</a></li>
                    <li class="{{ (Request::is('admin/manage_users') || Request::segment(2) == 'user_detail' ? 'active' : '') }}"><a href="{{ url('admin/manage_users') }}"><i class="fa fa-user"></i> Manage Normal Users</a></li>
                </ul>
            </li> {{--
            <li {{ (Request::is( 'category') ? 'active' : '') }}>
                <a href="{{ url('admin/category') }}"> <i class="fa fa-sitemap"></i> <span>Category</span> </a>
            </li>--}}
            <li class="{{ (Request::is('admin/slider') || Request::is('admin/slider/create') || (Request::segment(2) == 'slider' && Request::segment(4) == 'edit') ? 'active' : '') }}">
                <a href="{{ url('admin/slider') }}"> <i class="fa fa-image"></i> <span>Manage Slider Images</span> </a>
            </li>
            <li class="{{ (Request::is('admin/subscribers') ? 'active' : '') }}">
                <a href="{{ url('admin/subscribers') }}"> <i class="fa fa-users"></i> <span>Manage Subscribers</span> </a>
            </li>
            <li class="{{ (Request::is('admin/pages') || Request::is('admin/pages/create') || (Request::segment(2) == 'pages' && Request::segment(4) == 'edit') ? 'active' : '') }}">
                <a href="{{ url('admin/pages') }}"> <i class="fa fa-file-text"></i> <span>Manage Pages</span> </a>
            </li>

            
            <li class="{{ (Request::is('admin/user_comments') || Request::is('admin/user_comments/create') || Request::is('admin/home_page_section1') || Request::is('admin/featured_vendors') || Request::is('admin/local_vendors') || Request::is('admin/home_page_section4') || Request::segment(2) == 'local_vendors' || Request::segment(2) == 'user_comments' || Request::segment(2) == 'featured_vendors' || Request::segment(4) == 'edit' ? 'active' : '') }} treeview">

                <a href="#"> <i class="fa fa-home"></i> <span>Manage Home Page Section</span> <span class="pull-right-container">                        <i class="fa fa-angle-left pull-right"></i>                        </span> </a>
                <ul class="treeview-menu">
                	<li class="{{ (Request::is('admin/local_vendors') || Request::is('admin/local_vendors/create') || (Request::segment(2) == 'local_vendors' && Request::segment(4) == 'edit')) ? 'active' : '' }}"><a href="{{ url('admin/local_vendors') }}"><i class="fa fa-list"></i>Manage Local Vendors</a></li>

                    <li class="{{ (Request::is('admin/featured_vendors') || Request::is('admin/featured_vendors/create') || (Request::segment(2) == 'featured_vendors' && Request::segment(4) == 'edit')) ? 'active' : '' }}" class="active"><a href="{{ url('admin/featured_vendors') }}"><i class="fa fa-list"></i>Featured Vendors Gallery</a></li>

                    <li class="{{ (Request::is('admin/user_comments') || Request::is('admin/user_comments/create') || (Request::segment(2) == 'user_comments' && Request::segment(4) == 'edit')) ? 'active' : '' }}"><a href="{{ url('admin/user_comments') }}"><i class="fa fa-list"></i>Manage Users Comments</a></li>

                    <li class="{{ (Request::is('admin/home_page_section4') ? 'active' : '') }}"><a href="{{ url('admin/home_page_section4') }}"><i class="fa fa-list"></i> Why you should sign up</a></li>
                </ul>
            </li>

            <li class="{{ (Request::is('admin/settings') ? 'active' : '') }}">
                <a href="{{ url('admin/settings') }}"> <i class="fa fa-gear"></i> <span>Manage Settings</span> </a>
            </li>
         </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<!-- /left-sidebar -->