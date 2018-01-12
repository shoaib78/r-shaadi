@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
<style>
   #geocomplete {
      width: 200px
   }

   #map_canvas {
      width: 100%;
      height: 250px;
      margin: 10px 20px 10px 0;
   }
</style>
    <section class="banner-detail-page" style="background-image:url({{ (!empty($details))?  asset('public/uploads/banner/').'/'.$details['banner']  :  asset('public/assets/imgs/default.png') }});">
        <div class="overlay">
            <div class="container detail-caption">
                <h4>
                    @if (!empty($details['company_name']))
                        {{ ucwords($details['company_name']) }}
                    @elseif (!empty($details['firstname']) && !empty($details['lastname']))
                        {{ ucwords($details['firstname']).' '.ucwords($details['lastname']) }}
                    @else
                        John Doe
                    @endif
                </h4>
                <h5>
                    @if ((isset($details['city']) && !empty($details['city'])) || (isset($details['state']) && !empty($details['state'])))
                        <i class="fa fa-map-marker"></i>
                        {{ (!empty($details['city'])) ?$details['city'].', ' : '' }}

                        @if(!empty($details['state']) && $details['state']=='Alberta')
                            AB 
                        @elseif(!empty($details['state']) && $details['state']=='British Columbia')
                            BC
                        @elseif(!empty($details['state']) && $details['state']=='Manitoba')
                            MB
                        @elseif(!empty($details['state']) && $details['state']=='New Brunswick')
                            NB
                        @elseif(!empty($details['state']) && $details['state']=='Newfoundland and Labrador')
                            NL
                        @elseif(!empty($details['state']) && $details['state']=='Nova Scotia')
                            NS
                        @elseif(!empty($details['state']) && $details['state']=='Northwest Territories')
                            NT 
                        @elseif(!empty($details['state']) && $details['state']=='Nunavut')
                            NU, 
                        @elseif(!empty($details['state']) && $details['state']=='Ontario')
                            ON
                        @elseif(!empty($details['state']) && $details['state']=='Prince Edward Island')
                            PE
                        @elseif(!empty($details['state']) && $details['state']=='Quebec')
                            QC
                        @elseif(!empty($details['state']) && $details['state']=='Saskatchewan')
                            SK
                        @elseif(!empty($details['state']) && $details['state']=='Yukon')
                            YT
                        @endif
                    @endif
                </h5>

                @if(!empty(auth()->guard('user')->user()->usertype) && auth()->guard('user')->user()->usertype == 2 && $details['vendor_id'] == auth()->guard('user')->id())
                
                @else
                    @if ($details['is_bookmarked'])

                        <a href="{{ url('vendor/unbookmark').'/'.$details['vendor_id'] }}" class="unbookmark unbookmark-{{ $details['vendor_id'] }}">
                            <i class="fa fa-bookmark bokmarkic" data-toggle="tooltip" data-placement="top" title="Un Bookmark"></i>
                        </a>
                    @else
                        <a href="{{ url('vendor/bookmark').'/'.$details['vendor_id'] }}" class="bookmark bookmark-{{ $details['vendor_id'] }}">
                            <i class="fa fa-bookmark-o bokmarkic" data-toggle="tooltip" data-placement="top" title="Bookmark"></i>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </section>

    <section class="cotnent-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 detail-desc">
                    <h3 class="dheadig">
                        {{ ucwords('Company Profile') }}
                    </h3>
                    <p>
                        @if (!empty($details['about_me']))
                            {!! ucfirst(nl2br($details['about_me'])) !!}
                        @endif
                    </p>
                    <div class="clearfix"></div> <hr/>

                    @if (!empty($gallary))
                        <h3 class="dheadig">Gallery</h3>
                        <div class="col-sm-12 detail-gslider">
                            <div class="row">
                                <div class="row">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            @foreach (array_chunk($gallary, 4, true) as $i=>$array)
                                                <div class="item {{ ($i==0)? 'active' : ''}}">
                                                    @foreach($array as $j=>$row)
                                                        <div class="col-sm-3">
                                                            <a class="example-image-link" data-fancybox="gallery" href="{{ asset('public/uploads/gallary/').'/'.$row['gallary_img'] }}" data-lightbox="example-set" data-title="">

                                                                <img src="{{ asset('public/uploads/gallary/').'/'.$row['gallary_img'] }}" class="example-image img-responsive"/>

                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Controls -->
                                        @if (count($gallary)>= 4)
                                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="clearfix"></div> <hr/>

                    <div class="col-sm-12 tabss row">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#reviewst" aria-controls="home" role="tab" data-toggle="tab">Reviews</a></li>
                            <li role="presentation"><a href="#contctt" aria-controls="profile" role="tab" data-toggle="tab">Vendor Contact</a></li>

                            @if($is_service_available>0)
                            <li role="presentation"><a href="#vdetailss" aria-controls="messages" role="tab" data-toggle="tab">Service Details</a></li>
                            @endif
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active fade in" id="reviewst">
                            @if (count($reviews)>0)
                                <div class="col-sm-12 p0 rate_filter">
                                    <div class="dropdown pull-right">
                                      <button class="btn btn-theme dropdown-toggle" type="button" data-toggle="dropdown">Sort by rating
                                      <span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                        <li><a data-val="{{ $details['vendor_id'] }}" class="sort-rating" href="javascript:void(0);">All</a></li>
                                        <li><a data-val="{{ $details['vendor_id'] }}" class="sort-rating" href="javascript:void(0);">1</a></li>
                                        <li><a data-val="{{ $details['vendor_id'] }}" class="sort-rating" href="javascript:void(0);">2</a></li>
                                        <li><a data-val="{{ $details['vendor_id'] }}" class="sort-rating" href="javascript:void(0);">3</a></li>
                                        <li><a data-val="{{ $details['vendor_id'] }}" class="sort-rating" href="javascript:void(0);">4</a></li>
                                        <li><a data-val="{{ $details['vendor_id'] }}" class="sort-rating" href="javascript:void(0);">5</a></li>
                                      </ul>
                                    </div>
                                </div>
                                <div class="recent-reviews">
                                    @foreach($reviews as $i=>$row)
                                        <div class="col-sm-12 p0 media">
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
                                                        @elseif (!empty($row['firstname']) && !empty($row['lastname']))
                                                            {{ ucwords($row['firstname']).' '.ucwords($row['lastname']) }}
                                                        @else
                                                            John Doe
                                                        @endif
                                                    </h4>
                                                    <h6 class="media-subheading">Reviwed on {{ date('d-F-Y', strtotime($row['created_at'])) }}</h5>
                                                </div>
                                                <span class="ratingg text-right pull-right">
                                                    {{--({{ number_format($row['rating'],1) }})--}}
                                                    <input value="{{ ucwords($row['rating']) }}" type="number" class="recent-review" data-size="s" >
                                                </span>
                                                <div class="col-sm-12 p0 media-cotnent" style="text-align: justify; text-justify: inter-word;">
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
                                @endif

                                @if(!empty(auth()->guard('user')->user()->usertype) && auth()->guard('user')->user()->usertype == 2 && $details['vendor_id'] == auth()->guard('user')->id())

                                @else
                                    <div class="col-xs-12 p0 submit-review">
                                        {!! Form::open(array('url' => route('user.review'), 'method' => 'post', 'class' => 'form-horizontal','id'=>'review-rating-form')) !!}
                                        <div class="form-group col-sm-12">
                                            <h5>Give Rating</h5>
                                            <span class="pull-left">
                                                <input id="rating-input" name="rating-input" type="hidden" value="0" type="number" class="rating " data-size="xs" data-step="1" data-star-captions="{}">
                                            </span>
                                        </div>
                                        <textarea class="form-control" id="review" name="review" rows="5" placeholder="Tell us about your experience"></textarea>
                                        <input type="hidden" id="review_for" name="review_for" value="{{ $details['vendor_id'] }}">
                                        <div class="form-group col-sm-12">
                                            <button  id="submit-btn" class="pull-right btn btn-pink"> &nbsp;  &nbsp; Submit &nbsp;  &nbsp; </button>

                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                                <div class="clearfix"></div>
                            </div><!--tab1-->

                            <div role="tabpanel" class="tab-pane fade" id="contctt">
                                <div class="col-sm-6 p0">
                                    <h4>Contact Information</h4>
                                    <h5><i class="fa fa-map-marker"></i> ADDRESS</h5>

                                    <p>{!! (!empty($details['address1'])) ?$details['address1'].'<br>' : '' !!}
                                    {{ (!empty($details['city'])) ?$details['city'] : '' }}

                                    @if(!empty($details['state']) && $details['state']=='Alberta')
                                        AB, 
                                    @elseif(!empty($details['state']) && $details['state']=='British Columbia')
                                        BC, 
                                    @elseif(!empty($details['state']) && $details['state']=='Manitoba')
                                        MB, 
                                    @elseif(!empty($details['state']) && $details['state']=='New Brunswick')
                                        NB, 
                                    @elseif(!empty($details['state']) && $details['state']=='Newfoundland and Labrador')
                                        NL, 
                                    @elseif(!empty($details['state']) && $details['state']=='Nova Scotia')
                                        NS, 
                                    @elseif(!empty($details['state']) && $details['state']=='Northwest Territories')
                                        NT, 
                                    @elseif(!empty($details['state']) && $details['state']=='Nunavut')
                                        NU, 
                                    @elseif(!empty($details['state']) && $details['state']=='Ontario')
                                        ON, 
                                    @elseif(!empty($details['state']) && $details['state']=='Prince Edward Island')
                                        PE, 
                                    @elseif(!empty($details['state']) && $details['state']=='Quebec')
                                        QC, 
                                    @elseif(!empty($details['state']) && $details['state']=='Saskatchewan')
                                        SK, 
                                    @elseif(!empty($details['state']) && $details['state']=='Yukon')
                                        YT, 
                                    @endif

                                    {!! (!empty($details['pincode'])) ?$details['pincode'].'<br>': '' !!}

                                    {{ (!empty($details['country'])) ?$details['country'] : '' }}
                                    
                                    <h5><i class="fa fa-mobile"></i> PHONE NUMBER</h5>
                                    <p>
                                        {{ (!empty($details['area_code'])) ?'('.$details['area_code'].') ' : '' }}
                                        {{ (!empty($details['phone_number'])) ?substr($details['phone_number'], 0, 3).'-'.substr($details['phone_number'], 3, 15): '' }}
                                    </p>
                                    
                                    @if(!empty($details['contact_email']))
                                    <h5><i class="fa fa-envelope-o"></i> EMAIL</h5>
                                    <p>{{ (!empty($details['contact_email'])) ?$details['contact_email']: '' }}</p>
                                    @endif


                                    @if(!empty($details['website_url']) || !empty($details['facebook_url']) || !empty($details['instagram_url']) || !empty($details['twitter_url']) || !empty($details['youtube_url']))
                                        <h4 style="font-size:15px;">Social Connects</h4>
                                        <ul class="list-inline ldetail-social">
                                            @if(!empty($details['website_url']))
                                                <li data-toggle="tooltip" data-placement="top" title="Website"><a href="{{ $details['website_url'] }}" target="_blank"><i class="fa fa-globe"></i></a></li>
                                            @endif

                                            @if(!empty($details['facebook_url']))
                                                <li data-toggle="tooltip" data-placement="top" title="facebook"><a href="{{ $details['facebook_url'] }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            @endif

                                            @if(!empty($details['instagram_url']))
                                                <li data-toggle="tooltip" data-placement="top" title="Instagram"><a href="{{ $details['instagram_url'] }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                            @endif

                                            @if(!empty($details['twitter_url']))
                                                <li data-toggle="tooltip" data-placement="top" title="Twitter"><a href="{{ $details['twitter_url'] }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            @endif

                                            @if(!empty($details['youtube_url']))
                                                <li data-toggle="tooltip" data-placement="top" title="Youtube"><a href="{{ $details['youtube_url'] }}" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                            @endif

                                        </ul>
                                    @endif
                                </div>
                                <div class="col-sm-6 p0">
                                    <div class="map-holder">
                                        {{-- <div id="map_canvas"></div> --}}
                                        
                                        <iframe width="100%" height="350" frameborder="0" style="border: 1px solid #ddd;" src = "https://maps.google.com/maps?q={{ (isset($lat) && !empty($lat)) ? $lat : '43.653226' }},{{ (isset($long) && !empty($long)) ? $long : '-79.38318429999998' }}&hl=es;z=8&amp;output=embed"></iframe>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div><!--tab2-->

                            @if($is_service_available>0)
                            <div role="tabpanel" class="tab-pane fade" id="vdetailss">
                                <h4>Service Details</h4>
                                <ul class="list-inline" style="margin-left: -17px;">
                                    @if(!empty($details['vanue_type']))
                                        <li>
                                            <strong><h5>Wedding Venue Type</h5></strong>
                                            {{ ucwords(str_replace("_"," ",implode(', ',json_decode($details['vanue_type'])))) }}
                                        </li>
                                    @endif

                                    @if(!empty($details['vanue_settings']))
                                        <li>
                                            <strong><h5>Wedding Venue Setting</h5></strong>
                                            {{ ucwords(implode(', ',json_decode($details['vanue_settings']))) }}
                                        </li>
                                    @endif

                                    @if(!empty($details['vanue_min_price']))
                                        <li>
                                            <strong><h5>Min Price Per Plate</h5></strong>
                                            ${{ number_format($details['vanue_min_price'],2) }}
                                        </li>
                                    @endif

                                    @if(!empty($details['vanue_max_price']))
                                        <li>
                                            <strong><h5>Max Price Per Plate</h5></strong>
                                            ${{ number_format($details['vanue_max_price'],2) }}
                                        </li>
                                    @endif

                                    @if(!empty($details['bridal_makeup_offer']))
                                        <li>
                                            <strong><h5>Bridal Makeup Offsite Service</h5></strong>
                                            @if($details['bridal_makeup_offer'] == '1')
                                                Yes
                                            @elseif($details['bridal_makeup_offer'] == '0')
                                                No
                                            @endif
                                        </li>
                                    @endif

                                    @if(!empty($details['bridal_makeup_starting_price']))
                                        <li>
                                            <strong><h5>Bridal Makeup Starting Price</h5></strong>
                                            ${{ number_format($details['bridal_makeup_starting_price'],2) }}
                                        </li>
                                    @endif

                                    @if(!empty($details['vendor_category']) && $details['vendor_category'] ==5)
                                        <li>
                                            <strong><h5>Videographers Provide Photography Services?</h5></strong>
                                            @if($details['videographer_photography_service_provide'] == '1')
                                                Yes
                                            @elseif($details['videographer_photography_service_provide'] == '0')
                                                No
                                            @endif
                                        </li>

                                        <li>
                                            <strong><h5>Videography Starting Price</h5></strong>
                                            ${{ number_format($details['videographer_starting_price'],2) }}
                                        </li>
                                    @endif

                                    @if(!empty($details['vendor_category']) && $details['vendor_category'] ==4)
                                        <li>
                                            <strong><h5>Photographers Provide Vidoegraphy Services?</h5></strong>
                                            @if($details['photographer_vidoegraphy_service_provide'] == '1')
                                                Yes
                                            @elseif($details['photographer_vidoegraphy_service_provide'] == '0')
                                                No
                                            @endif
                                        </li>

                                        <li>
                                            <strong><h5>Photographers Provide Photo Booth Services?</h5></strong>
                                            @if($details['photographer_photo_booth_service_provide'] == '1')
                                                Yes
                                            @elseif($details['photographer_photo_booth_service_provide'] == '0')
                                                No
                                            @endif
                                        </li>

                                        <li>
                                            <strong><h5>Photography Starting Price</h5></strong>
                                            ${{ ($details['photographer_starting_price']>0)? number_format($details['photographer_starting_price'],2) :0 }}
                                        </li>
                                    @endif

                                    @if(!empty($details['wedding_dj_music_offer']))
                                        <li>
                                            <strong><h5>Wedding DJ Musics Geners Offers</h5></strong>
                                            {{ ucwords(implode(', ',json_decode($details['wedding_dj_music_offer']))) }}
                                        </li>
                                    @endif

                                    @if(!empty($details['transportation_vechile_available']))
                                        <li>
                                            <strong><h5>Transportation Vehicles Available</h5></strong>
                                            {{ ucwords(str_replace("_"," ",implode(', ',json_decode($details['transportation_vechile_available'])))) }}
                                            {{--@if($details['transportation_vechile_available'] == 'standard_limo')
                                                Standard Limo
                                            @elseif($details['transportation_vechile_available'] == 'stretch_limo')
                                                Stretch Limo
                                            @elseif($details['transportation_vechile_available'] == 'exotic')
                                                Exotic
                                            @elseif($details['transportation_vechile_available'] == 'van')
                                                Van
                                            @elseif($details['transportation_vechile_available'] == 'motercycle')
                                                Motercycle
                                            @elseif($details['transportation_vechile_available'] == 'suv')
                                                SUV Limo
                                            @elseif($details['transportation_vechile_available'] == 'classic_car')
                                                Classic Car
                                            @elseif($details['transportation_vechile_available'] == 'sedan')
                                                Sedan
                                            @elseif($details['transportation_vechile_available'] == 'horse_&_carriage')
                                                Horse & Carriage
                                            @elseif($details['transportation_vechile_available'] == 'shuttle_bus')
                                                Shuttle Bus
                                            @endif--}}
                                        </li>
                                    @endif

                                    @if(!empty($details['wedding_entertainment_sub_category']))
                                        <li>
                                            <strong><h5>Wedding Entertainment Sub Category</h5></strong>
                                            @if($details['wedding_entertainment_sub_category'] == 'test')
                                                Test
                                            @endif
                                        </li>
                                    @endif

                                    @if(!empty($details['officiant_religion']))
                                        <li>
                                            <strong><h5>Officiant Religion</h5></strong>
                                            @if($details['officiant_religion'] == 'Hindu')
                                                Hindu
                                            @elseif($details['officiant_religion'] == 'Muslim')
                                                Muslim
                                            @elseif($details['officiant_religion'] == 'Christian')
                                                Christian
                                            @elseif($details['officiant_religion'] == 'Sikh')
                                                Sikh
                                            @elseif($details['officiant_religion'] == 'Jain')
                                                Jain
                                            @elseif($details['officiant_religion'] == 'Jewish')
                                                Jewish
                                            @elseif($details['officiant_religion'] == 'Other')
                                                Other
                                            @endif
                                        </li>
                                    @endif

                                    @if(!empty($details['additional_cat']))
                                        <li>
                                            <strong><h5>Additional Service</h5></strong>
                                            @if($details['additional_cat'] == '2')
                                                Wedding Decorations
                                            @elseif($details['additional_cat'] == '12')
                                                Wedding Cakes
                                            @elseif($details['additional_cat'] == '13')
                                                Wedding Cards
                                            @elseif($details['additional_cat'] == '3')
                                                Wedding Florists
                                            @elseif($details['additional_cat'] == '10')
                                                Groom Wear
                                            @elseif($details['additional_cat'] == '11')
                                                Mehndi Artists
                                            @elseif($details['additional_cat'] == '16')
                                                Wedding Planner
                                            @endif
                                        </li>
                                    @endif
                                </ul>
                            </div><!--tab3-->
                            @endif

                        </div>
                    </div>

                </div>

                <div class="clearfix"></div>


                @if (!empty($related))
                    <h3 class="col-sm-12 dheadig" style="margin:30px 0 20px 0">Realted Services</h3>
                    @foreach($related as $i=>$row)
                        <div class="col-sm-3">
                            <!-- listing box-->
                            <div class="col-sm-12 listing-box">
                                <div class="col-sm-12 listing-box-img">
                                    <a href="{{ url('vendor/profile').'/'.$row['vendor_id'] }}">
                                        @if (!empty($row['banner']))
                                            <img src="{{ asset('public/uploads/banner/').'/'.$row['banner'] }}"/>
                                        @else
                                            <img src="{{ asset('public/assets/imgs/default.png') }}" width="100"/>
                                        @endif

                                        @if ($row['vendor_category'] == 1)
                                            <div class="price-tag"><span class="pt-content">${{ $row['vanue_min_price'] }}</span></div>
                                        @elseif ($row['vendor_category'] ==4)
                                            <div class="price-tag"><span class="pt-content">${{ $row['photographer_starting_price'] }}</span></div>
                                        @elseif ($row['vendor_category'] ==5)
                                            <div class="price-tag"><span class="pt-content">${{ $row['videographer_starting_price'] }}</span></div>
                                        @elseif ($row['vendor_category'] ==6)
                                            <div class="price-tag"><span class="pt-content">${{ $row['bridal_makeup_starting_price'] }}</span></div>
                                        @endif
                                    </a>
                                </div>
                                <div class="col-sm-12 lisitng-box-content">
                                    <a href="{{ url('vendor/profile').'/'.$row['vendor_id'] }}">
                                        <span class="col-sm-7 p0">
                                            <h3>
                                                 @if (!empty($row['company_name']))
                                                    {{ str_limit(ucwords($row['company_name']), $limit = 12, $end = '...') }}
                                                 @elseif (!empty($row['firstname']) && !empty($row['lastname']))
                                                    {{ str_limit(ucwords($row['firstname']).' '.ucwords($row['lastname']), $limit = 12, $end = '...') }}
                                                @else
                                                    John Doe
                                                @endif
                                            </h3>
                                            <h6>
                                                @if ((isset($row['city']) && !empty($row['city'])) || (isset($row['state']) && !empty($row['state'])))
                                                    <i class="fa fa-map-marker"></i>
                                                    {{ (!empty($row['city'])) ?$row['city'].', ' : '' }}

                                                    @if(!empty($row['state']) && $row['state']=='Alberta')
                                                        AB 
                                                    @elseif(!empty($row['state']) && $row['state']=='British Columbia')
                                                        BC
                                                    @elseif(!empty($row['state']) && $row['state']=='Manitoba')
                                                        MB
                                                    @elseif(!empty($row['state']) && $row['state']=='New Brunswick')
                                                        NB
                                                    @elseif(!empty($row['state']) && $row['state']=='Newfoundland and Labrador')
                                                        NL
                                                    @elseif(!empty($row['state']) && $row['state']=='Nova Scotia')
                                                        NS
                                                    @elseif(!empty($row['state']) && $row['state']=='Northwest Territories')
                                                        NT 
                                                    @elseif(!empty($row['state']) && $row['state']=='Nunavut')
                                                        NU, 
                                                    @elseif(!empty($row['state']) && $row['state']=='Ontario')
                                                        ON
                                                    @elseif(!empty($row['state']) && $row['state']=='Prince Edward Island')
                                                        PE
                                                    @elseif(!empty($row['state']) && $row['state']=='Quebec')
                                                        QC
                                                    @elseif(!empty($row['state']) && $row['state']=='Saskatchewan')
                                                        SK
                                                    @elseif(!empty($row['state']) && $row['state']=='Yukon')
                                                        YT
                                                    @endif
                                                @endif
                                            </h6>
                                        </span>
                                    </a>
                                    <div class="col-sm-5 p0 lisitng-box-c-right text-right">
                                        <input value="{{ ucwords($row['rating']) }}" type="number" class="recent-review" data-size="s" >
                                        <a href="javascript:void(0)">{{ $row['reviews'] }} Reviews</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //listing box-->
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <div class="clearfix"></div>

<!--modal user signup-->
<div class="modal fade login-modal" id="review-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Review Confirmation</h4>
            </div>
            <div class="modal-body" style="padding: 8px;">
                <div id='social-icons-conatainer'>
                    <div class="clearfix"></div>
                    <div class='col-sm-12' style="float:none; margin: 0 auto">
                        <form id="review-confirm-form" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            <div class="checkbox" style="padding-top: 15px;">
                                <label style="padding-left: 1px;">
                                    Would you like this review to be anonymous?
                                </label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" value="1" id="anonymous_confirmation_1" class="optradio" name="optradio">Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" id="anonymous_confirmation_0" class="optradio" name="optradio">No
                                </label>
                            </div>
                            <button class="btn btn-pink modal-login-btn">
                                    Submit
                            </button>
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


    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection