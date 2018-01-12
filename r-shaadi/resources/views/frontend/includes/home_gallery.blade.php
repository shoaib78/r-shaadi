@if(count($featured_vendors)>0)
<div class="container">
    <div class="row">
        <h2 class="sec-heading">Featured Vendors</h2>
        <div class="spacer50"></div>
        <div class="col-sm-12 gallery-mosac">
			<div class="grid-gallery">
				@foreach($featured_vendors as $i=>$row)
						@if($i==0 || $i==3)
							<div class="wedding col-sm-3 ">
								<figure>
									<div class="RXcircleEffect"></div>
									<div class="img-portfolio">
										<a href="{{ !empty($row['vendor_profile_link']) ? $row['vendor_profile_link'] : url('')}}" title="">
											@if($row['featured_image'])
					                            <img src="{{ url('public/uploads').'/'.$row['featured_image'] }}" alt="img">
					                        @else
					                            <img src="{{ asset('public/assets/imgs/img1.jpg') }}" alt="">
					                        @endif
										</a>
										<figcaption>
											<div class="capCont">
												@if($row['company_name'])
													<h4><a href="{{ !empty($row['vendor_profile_link']) ? $row['vendor_profile_link'] : url('listings')}}">{{$row['company_name']}}</a></h4>
												@endif

												@if($row['category'])
													<p>{{$row['category']}}</p>
												@endif
											</div>
										</figcaption>
									</div>
								</figure>
							</div>

						@elseif($i==1 || $i==2 || $i==4 || $i==5)
							@if($i==1 || $i==4)
								<div class="engaged col-sm-3">
							@endif
								<figure>
									<div class="RXcircleEffect"></div>
									<div class="img-portfolio">
										<a href="{{ !empty($row['vendor_profile_link']) ? $row['vendor_profile_link'] : url('')}}" title="">
											@if($row['featured_image'])
					                            <img src="{{ url('public/uploads').'/'.$row['featured_image'] }}" alt="img">
					                        @else
					                            <img src="{{ asset('public/assets/imgs/img1.jpg') }}" alt="">
					                        @endif
										</a>
										<figcaption>
											<div class="capCont">
												@if($row['company_name'])
													<h4><a href="{{ !empty($row['vendor_profile_link']) ? $row['vendor_profile_link'] : url('listings')}}">{{$row['company_name']}}</a></h4>
												@endif

												@if($row['category'])
													<p>{{$row['category']}}</p>
												@endif
											</div>
										</figcaption>
									</div>
									
								</figure>
							@if($i==2 || $i==5)
								</div>
							@endif
						@endif
					@endforeach
			</div>

            <div class="gallery-caption col-sm-4">
                <h3>Lorem ipsum Dep Deteo</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tortor nisi, finibus vitae sollicitudin in, viverra id metus.</p>
            </div> 
        </div>
    </div>
</div>
@endif