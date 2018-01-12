@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
<section class="banner-inner">
    <h3>
        @if(isset($service_category) || isset($service_city) || isset($service_rating))
            @if(isset($service_category) && !empty($service_category))
                @foreach($category as $i=>$cat)
                    @if($service_category == $cat->category_id)
                        {{ $cat->category_name }}
                    @endif
                @endforeach
            @else
                All Categories
            @endif
        @elseif(isset($search) && !empty($search))
            Shaadivibes Search
        @elseif(Request::is('listings'))
            All Categories
        @elseif(!empty($listings))
            {{ $listings[0]['category_name'] }}
        @endif
    </h3>
</section>


<section class="cotnent-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 side-filter">
                <h3 class="heading">Filters</h3>
                {!! Form::open(array('url' => route('service.filter'), 'method' => 'get', 'class' => 'form-horizontall','id'=>'filter-form')) !!}
                <div class="form-group">
                    <label>Select Vendor Service</label>
                    <select class="form-control filter" name="category" id="category">
                        <option value="">All Categories</option>
                        @if (count($category)>0)
                            @foreach($category as $i=>$cat)
                                <?php
                                $selected = "";
                                if(isset($service_category) || isset($service_city) || isset($service_rating)){
                                    if(isset($service_category) && !empty($service_category) && $service_category == $cat->category_id){
                                        $selected = 'selected="selected"';
                                    }
                                }elseif(!Request::is('listings') && !empty($listings) && $listings[0]['category_id'] == $cat->category_id){
                                    $selected = 'selected="selected"';
                                }
                                ?>
                                <option value="{{ $cat->category_id }}" {{ $selected }}>{{ $cat->category_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                {{--<div class="form-group">
                    <label>By Rating</label>
                    <select class="form-control filter" name="rating" id="rating"  data-show-icon="true">
                        <option value="">Select Rating</option>
                        <option value="1" {{ (isset($service_rating) && $service_rating == 1) ? 'selected="selected"' : '' }}>1</option>
                        <option value="2" {{ (isset($service_rating) && $service_rating == 2) ? 'selected="selected"' : '' }}>2</option>
                        <option value="3" {{ (isset($service_rating) && $service_rating == 3) ? 'selected="selected"' : '' }}>3</option>
                        <option value="4" {{ (isset($service_rating) && $service_rating == 4) ? 'selected="selected"' : '' }}>4</option>
                        <option value="5" {{ (isset($service_rating) && $service_rating == 5) ? 'selected="selected"' : '' }}>5</option>
                    </select>
					<script>$('#rating').selectpicker();</script>
                </div>--}}

                <div class="form-group">
                    <label>Enter City</label>
                    <input type="text" name="city" id="city" class="filter_location form-control" value="{{ isset($service_city) ? $service_city : '' }}" placeholder="Place" aria-label="Amount (to the nearest dollar)">
                </div>
				<div class="form-group">
                    <label>By Rating</label>
                    @if(isset($service_rating) && !empty($service_rating))
                        <a href="javascript:void(0);" class="custom-link clear-rating pull-right">Clear</a>
                    @endif
                    
                    
					<div class="rate_list_new">
						<a href="javascript:void(0);" data-val="5" class="rating-filter"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        @if(isset($service_rating) && $service_rating == 5)
                            <strong style="color: #000"> & Only </strong>
                        @else
                            <span style="color: #000"> & Only </span>
                        @endif
                        </a>
					</div>
					<div class="rate_list_new">
						<a href="javascript:void(0);" data-val="4" class="rating-filter"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i> 
                        @if(isset($service_rating) && $service_rating == 4)
                            <strong style="color: #000"> & UP </strong>
                        @else
                            <span style="color: #000"> & UP </span>
                        @endif
                        </a>
					</div>
					<div class="rate_list_new">
						<a href="javascript:void(0);" data-val="3" class="rating-filter"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> 
                        @if(isset($service_rating) && $service_rating == 3)
                            <strong style="color: #000"> & UP </strong>
                        @else
                            <span style="color: #000"> & UP </span>
                        @endif
                        </a>
					</div>
					<div class="rate_list_new">
						<a href="javascript:void(0);" data-val="2" class="rating-filter"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> 
                        @if(isset($service_rating) && $service_rating == 2)
                            <strong style="color: #000"> & UP </strong>
                        @else
                            <span style="color: #000"> & UP </span>
                        @endif
                        </a>
					</div>
					<div class="rate_list_new">
						<a href="javascript:void(0);" data-val="1" class="rating-filter"><i class="fa fa-star"></i><i class="fa fa-star-0"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        @if(isset($service_rating) && $service_rating == 1)
                            <strong style="color: #000"> & UP </strong>
                        @else
                            <span style="color: #000"> & UP </span>
                        @endif
                        </a>
					</div>
				</div>
                {!! Form::close() !!}
            </div>

            <div class="col-sm-9 listing-main">
                @if (count($listings)>0)
                    @foreach($listings as $i=>$row)
                        <div class="col-md-4 col-sm-6 col-xs-12"> <!-- listing box-->
                            <div class="col-sm-12 listing-box">
                                    <div class="col-sm-12 listing-box-img banner-hover">
                                        <a class="event_box" href="{{ url('vendor/profile').'/'.$row->vendor_id }}">
                                            @if (!empty($row->banner))
                                                <img style="    width: 100% !important;height: 100%;object-fit: cover;" src="{{ asset('public/uploads/banner/').'/'.$row->banner }}"/>
                                            @else
                                                <img src="{{ asset('public/assets/imgs/default.png') }}"/>
                                            @endif
                                        </a>

                                        @if ($row->vendor_category == 1 && $row->vanue_min_price>0)
                                                <div class="price-tag"><span class="pt-content">${{ $row->vanue_min_price }}</span></div>
                                        @elseif ($row->vendor_category ==4 && $row->photographer_starting_price>0)
                                                <div class="price-tag"><span class="pt-content">${{ $row->photographer_starting_price }}</span></div>
                                        @elseif ($row->vendor_category ==5 && $row->videographer_starting_price>0)
                                                <div class="price-tag"><span class="pt-content">${{ $row->videographer_starting_price }}</span></div>
                                        @elseif ($row->vendor_category ==6 && $row->bridal_makeup_starting_price>0)
                                                <div class="price-tag"><span class="pt-content">${{ $row->bridal_makeup_starting_price }}</span></div>
                                        @endif

                                        @if ($row->is_bookmarked)
                                            <a href="{{ url('vendor/unbookmark').'/'.$row->vendor_id }}" class="unbookmark unbookmark-{{ $row->vendor_id }}">
                                                <i class="fa fa-bookmark bokmarkic"></i>
                                            </a>
                                        @else
                                            <a href="{{ url('vendor/bookmark').'/'.$row->vendor_id }}" class="bookmark bookmark-{{ $row->vendor_id }}">
                                                <i class="fa fa-bookmark-o bokmarkic"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 lisitng-box-content">
                                        <a href="{{ url('vendor/profile').'/'.$row->vendor_id }}">
                                            <span class="col-sm-12 p0">
                                                    <h3>
                                                        @if (!empty($row->company_name))
                                                            {{ ucwords($row->company_name) }}
                                                            {{-- {{ str_limit(ucwords($row->company_name), $limit = 12, $end = '...') }} --}}
                                                         @elseif (!empty($row->firstname) && !empty($row->lastname))
                                                            {{ str_limit(ucwords($row->firstname).' '.ucwords($row->lastname), $limit = 12, $end = '...') }}
                                                        @else
                                                            John Doe
                                                        @endif
                                                    </h3>
                                            </span>
                                        </a>
                                </div>
                                <div class="col-sm-12 lisitng-box-content lbc">
                                    <div class="col-sm-7 p0">
                                        <a href="{{ url('vendor/profile').'/'.$row->vendor_id }}">
                                         <h6 class="as"><i class="fa fa-map-marker"></i>
                                                    {{ (!empty($row->city)) ?$row->city.', ' : '' }}

                                                    @if(!empty($row->state) && $row->state=='Alberta')
                                                        AB
                                                    @elseif(!empty($row->state) && $row->state=='British Columbia')
                                                        BC 
                                                    @elseif(!empty($row->state) && $row->state=='Manitoba')
                                                        MB
                                                    @elseif(!empty($row->state) && $row->state=='New Brunswick')
                                                        NB
                                                    @elseif(!empty($row->state) && $row->state=='Newfoundland and Labrador')
                                                        NL
                                                    @elseif(!empty($row->state) && $row->state=='Nova Scotia')
                                                        NS
                                                    @elseif(!empty($row->state) && $row->state=='Northwest Territories')
                                                        NT, 
                                                    @elseif(!empty($row->state) && $row->state=='Nunavut')
                                                        NU
                                                    @elseif(!empty($row->state) && $row->state=='Ontario')
                                                        ON
                                                    @elseif(!empty($row->state) && $row->state=='Prince Edward Island')
                                                        PE
                                                    @elseif(!empty($row->state) && $row->state=='Quebec')
                                                        QC
                                                    @elseif(!empty($row->state) && $row->state=='Saskatchewan')
                                                        SK
                                                    @elseif(!empty($row->state) && $row->state=='Yukon')
                                                        YT
                                                    @endif
                                                    
                                                </h6>
                                        </a>
                                    </div>
                                   
                                    <div class="col-sm-4 p0 lisitng-box-c-right text-right">
                                        <input value="{{ round($row->rating_average) }}" type="number" class="recent-review" data-size="s" >
                                    </div>
                                     <a class="col-md-1 dvd pull-right p0" href="javascript:void(0)">({{ $row->reviews_count }})</a>
                                </div>
                        </div>
                        </div><!-- //listing box-->
                    @endforeach
                    <div class="col-sm-12 paginations tex-center">
                        {{ $listings->appends($_GET)->links() }}
                    </div>
                @else
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <p>
                            Sorry, No service vendors are found.
                        </p>
                    </div>

                @endif
            </div>
        </div>
    </div>
</section>


<div class="clearfix"></div>
@endsection