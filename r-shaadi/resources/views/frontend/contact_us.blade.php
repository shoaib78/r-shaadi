@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection
@section('content')
<style>

   .item img {
      width: 100%;
      height: 500px;
      max-height: 500px;
   }

   #examples a {
      text-decoration: underline;
   }

   #geocomplete {
      width: 200px
   }

   #map_canvas {
      width: 100%;
      height: 300px;
      margin: 10px 20px 10px 0;
   }

   #multiple li {
      cursor: pointer;
      text-decoration: underline;
   }

   .times {
      font-size: 15px;
   }
   .cpage .control-label {
      display: block !important;
  }
</style>
{{-- Content --}}
<section class="contact_page">
   <section class="contact-thirds">
      <div class="container">
		<div class="contact-wrap">
			<h3>Contact Shaadi Vibes</h3>
         <div class="col-sm-6 col-xs-12 p0 contact_form_new">
            @if (session('contact_success'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('contact_success') }}
                </div>
            @endif

            @if (session('contact_error'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('contact_error') }}
                </div>
            @endif
            {!! Form::open(array('url' => url('contactus'), 'method' => 'post', 'class' => 'contact_form cpage', 'files'=> true, 'id'=>'contactus-frm')) !!}
             <div class="col-sm-12 p0">
              <div class="form-group required">
               <label class="col-sm-3 control-label">Name</label>
               <div class="col-sm-9">
                <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" id="name" name="name" placeholder="Please Enter Your First name" value="">
                @if ($errors->has('name'))
                    <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>  
            </div>
            </div>
            <!-- col-sm-12 -->
            <div class="col-sm-12 p0">
              <div class="form-group required">
               <label class="col-sm-3 control-label">E-mail</label>
               <div class="col-sm-9">
                <input type="text" class="form-control {{ $errors->has('email') ? 'error' : '' }}" id="email" name="email" placeholder="Please Enter Your E-mail" value="">
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>  
            </div>
            </div>
            <!-- col-sm-12 -->
            <div class="col-sm-12 p0">
              <div class="form-group required">
               <label class="col-sm-3 control-label">I am</label>
               <div class="col-sm-5">
                <select class="form-control {{ $errors->has('reason_type') ? 'error' : '' }}" name="reason_type" id="reason_type">
                 <option value="">- Select an option -</option>
                 <option value="bride_groom">Bride / Groom</option>
                 <option value="business">Business</option>
               </select>
               @if ($errors->has('reason_type'))
                    <span class="help-block">
                    <strong>{{ $errors->first('reason_type') }}</strong>
                </span>
                @endif
             </div> 
            </div>
            </div>
            <div class="col-sm-12 p0 hide reason">
              <div class="form-group required">
               <label class="col-sm-3 control-label">Reason</label>
               <div class="col-sm-5">
                <select class="form-control" name="reason" id="reason">
                  <option value="-1">- Choose a reason for contact -</option>
                  <option value="Planning Tools">Planning Tools</option>
                  <option value="Community">Community</option>
                  <option value="Shaadi Vibes Contest">Shaadi Vibes Contest</option>
                  <option value="Other Questions">Other Questions</option>
                </select>
              </div>  
            </div>
            </div>
            <div class="col-sm-12 p0">
              <div class="form-group required">
               <label class="col-sm-3 control-label">Comment</label>
               <div class="col-sm-9">
                <textarea class="form-control {{ $errors->has('message') ? 'error' : '' }}" id="message" name="message" value="{{ old('message')? old('message'): '' }}" rows="5"></textarea>
                @if ($errors->has('message'))
                    <span class="help-block">
                    <strong>{{ $errors->first('message') }}</strong>
                </span>
                @endif
              </div>  
            </div>
            </div>
            <!-- col-sm-12 -->
            <div class="col-sm-12 p0">
              <div class="form-group">
               <label class="col-sm-3"></label>
               <div class="col-sm-9">
                 <button class="btn btn-pink" style="display: inline-block;">Submit</button>
               </div> 
             </div>
            </div>
            {!! Form::close() !!}
         </div>
         <!-- col-sm-8 -->
		</div><!-- contact-wrap -->
         {{-- <div class="col-sm-4 contact-right">
            <h3 class="contact-title">Contact Information</h3>
            <div class="col-sm-12 pad0">
               <div class="col-sm-2 con-icon"><i class="fa fa-map-marker"></i></div>
               <div class="col-sm-10">
                  <h3 class="cinfo-title">Address</h3>
                  <p>{{ (isset($site_settings['contact_location']) && !empty($site_settings['contact_location'])) ? $site_settings['contact_location'] : 'Toronto, ON, Canada' }}</p>
               </div>
            </div>
            <!-- col-sm-12 -->
            <div class="col-sm-12 pad0">
               <div class="col-sm-2 con-icon"><i class="fa fa-phone"></i></div>
               <div class="col-sm-10">
                  <h3 class="cinfo-title">Phone Number</h3>
                  <p>
                     {{ (isset($site_settings['contact_phone']) && !empty($site_settings['contact_phone'])) ? $site_settings['contact_phone'] : '+(31)46 475 7193' }}
                  </p>
               </div>
            </div>
            <!-- col-sm-12 -->
            <div class="col-sm-12 pad0">
               <div class="col-sm-2 con-icon"><i class="fa fa-envelope-o"></i></div>
               <div class="col-sm-10">
                  <h3 class="cinfo-title">Email</h3>
                  <p> {{ (isset($site_settings['contact_email']) && !empty($site_settings['contact_email'])) ? $site_settings['contact_email'] : 'info@shaadivibes.com' }}</p>
               </div>
            </div>
            <!-- col-sm-12 -->
         </div> --}}
         <!-- col-sm-9 -->
      </div>
      <!-- container -->
   </section>
</section>
@endsection