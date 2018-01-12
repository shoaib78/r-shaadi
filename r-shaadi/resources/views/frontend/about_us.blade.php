@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
<section class="banner-inner">
	<h3>About Us</h3>
</section>


<section class="cotnent-area static-page">
	<div class="container">
		<div class="col-sm-8 pl0 about-left">
			<h2 class="page-heading">About Shaadi Vibes</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie lorem metus. Donec quis tempus sapien. In in malesuada urna. Sed nec augue cursus libero posuere vulputate in at lectus. Vestibulum posuere at elit in feugiat. Nulla sit amet tincidunt augue. Donec molestie fringilla hendrerit. Donec ac mattis lacus. Quisque mauris nibh, posuere vel blandit sit amet, tempor ac magna. Morbi pharetra sapien nec diam rutrum, quis cursus mauris varius. Sed finibus et metus quis tristique. Etiam vehicula fringilla dui, a consectetur quam porta eget. Nulla ac porta dolor. Nullam accumsan, nunc vel bibendum rutrum, quam tellus blandit urna, eget volutpat lectus metus a odio. Pellentesque vel iaculis dui, vitae faucibus nisl. Quisque mauris nibh, posuere vel blandit sit amet, tempor ac magna. Morbi pharetra sapien nec diam rutrum, quis cursus mauris varius. Sed finibus et metus quis tristique.Quisque mauris nibh, posuere vel blandit sit amet, tempor ac magna. Morbi pharetra sapien nec diam rutrum, quis cursus mauris varius. Sed finibus et metus quis tristique.</p>
			<p>Pellentesque eu tincidunt dolor. Cras eu tincidunt est. Nam sed vehicula justo, sit amet sollicitudin nisl. Suspendisse potenti. Aliquam nec euismod nisl. Maecenas non laoreet diam, sed congue tellus. In tempor vitae risus vitae tincidunt. Morbi finibus ex gravida neque volutpat, ac porta dui efficitur.Quisque mauris nibh, posuere vel blandit sit amet, tempor ac magna. Morbi pharetra sapien nec diam rutrum, quis cursus mauris varius. Sed finibus et metus quis tristique.</p>
		</div>
		<div class="col-sm-4 about-right">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
				<div class="item active">
				  <img src="{{ url('public/assets/imgs/4.jpg') }}">
				</div>
				<div class="item">
				  <img src="{{ url('public/assets/imgs/4.jpg') }}">
				</div>
				
				
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
		
	</div>
</section>


<section class="testimonials secpad">
        <div class="container">
    <div class="row">
        <h2 class="sec-heading">Few Words form Users</h2>
        <div class="spacer50"></div>

        <div id="carousel-example-generic-testi" class="carousel slide" data-ride="carousel">


            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox" style="padding: 50px 15px;">
                <div class="item">
                    <div class="col-sm-3 tleft-img">
                        <img src="{{ url('public/assets/imgs/client.png') }}" class="img-responsive">
                    </div>
                    <div class="col-sm-8 pull-right tright-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tortor nisi, finibus vitae sollicitudin in, viverra id metus. Fusce orci sapien, gravida in nulla ac, tristique dapibus turpis. Praesent ut purus mauris. Vestibulum congue eros purus, ac porta ipsum accumsan in. Sed condimentum diam dui, vitae dignissim libero molestie eget.
                        <h6>Lorem ipsum</h6>
                    </div>
                </div>

                <div class="item">
                    <div class="col-sm-3 tleft-img">
                        <img src="{{ url('public/assets/imgs/client.png') }}" class="img-responsive">
                    </div>
                    <div class="col-sm-8 pull-right tright-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tortor nisi, finibus vitae sollicitudin in, viverra id metus. Fusce orci sapien, gravida in nulla ac, tristique dapibus turpis. Praesent ut purus mauris. Vestibulum congue eros purus, ac porta ipsum accumsan in. Sed condimentum diam dui, vitae dignissim libero molestie eget.
                        <h6>Lorem ipsum</h6>
                    </div>
                </div>

                <div class="item active">
                    <div class="col-sm-3 tleft-img">
                        <img src="{{ url('public/assets/imgs/client.png') }}" class="img-responsive">
                    </div>
                    <div class="col-sm-8 pull-right tright-content">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tortor nisi, finibus vitae sollicitudin in, viverra id metus. Fusce orci sapien, gravida in nulla ac, tristique dapibus turpis. Praesent ut purus mauris. Vestibulum congue eros purus, ac porta ipsum accumsan in. Sed condimentum diam dui, vitae dignissim libero molestie eget.
                        <h6>Lorem ipsum</h6>
                    </div>
                </div>
            </div>

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic-testi" data-slide-to="0" class=""></li>
                <li data-target="#carousel-example-generic-testi" data-slide-to="1" class=""></li>
                <li data-target="#carousel-example-generic-testi" data-slide-to="2" class="active"></li>
            </ol>
        </div>

    </div>
</div>
        </section>





<section class="why-us secpad inner-why-us">
	<div class="container">
		<div class="row">
			<h2 class="sec-heading text-center">Why you should sign up?</h2>
			<div class="spacer50"></div>
			
			<div class="col-sm-3 why-box">
				<img src="{{ url('public/assets/imgs/b1ic.png') }}">
				<h4>Inbox</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt quam ante, vitae vulput Lorem ipsum dolor sit amet, consectetur adipiscing elum dolor sit amet, consectetur adipiscing elit.</p>
			</div>
			
			<div class="col-sm-3 why-box">
				<img src="{{ url('public/assets/imgs/b2ic.png') }}">
				<h4>Collaborate</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt quam ante, vitae vulput Lorem ipsum dolor sit amet, consectetur adipiscing elum dolor sit amet, consectetur adipiscing elit.</p>
			</div>
			
			
			<div class="col-sm-3 why-box">
				<img src="{{ url('public/assets/imgs/b3ic.png') }}">
				<h4>Shortlist and Finalize Vendors</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt quam ante, vitae vulput Lorem ipsum dolor sit amet, consectetur adipiscing elum dolor sit amet, consectetur adipiscing elit.</p>
			</div>
			
			<div class="col-sm-3 why-box">
				<img src="{{ url('public/assets/imgs/b4ic.png') }}">
				<h4>Checklist</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt quam ante, vitae vulput Lorem ipsum dolor sit amet, consectetur adipiscing elum dolor sit amet, consectetur adipiscing elit.</p>
			</div>
			<div class="clearfix"></div>
			<div class="spacer50"></div>
			@if (empty(auth()->guard('user')->id()))
				<center><a href="javascript:void(0)" onclick="user_registration_popup()" class="btn-pink">Signup</a></center>
			@endif
		</div>
	</div>
</section>
