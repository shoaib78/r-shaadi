@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
<section class="banner-inner">
    <h3>Gallery</h3>
</section>
<section class="cotnent-area">
    <div class="container" id="gallery">
        <div class="col-md-12">
            <div class="row gallery-main">
                @if(count($gallary))
                @foreach ($gallary->chunk(4) as $i=>$array)
                <div class="col-md-3 col-xs-12 row-container">
                    @foreach($array as $key=>$row)
                    <a href="javascript:void(0)" class="open-album" data-open-id="group{{ $row->user_id}}" >
                        <?php $id = "group-".$row->user_id; ?>
                        <img src="{{ asset('public/uploads/gallary/thumbnail').'/'.$row->gallary_img }}" width="100%" alt="">

                        <div class="sub-box">
                            <div class="col-md-2 col-xs-2 img-box">
                                <a href="{{ url('vendor/profile').'/'.$row->user_id }}">
                                    @if (!empty($row->profile_pic))
                                    <img width="100%" src="{{ asset('public/uploads/profile/').'/'.$row->profile_pic }}"/>
                                    @else
                                    <img width="100%" src="{{ asset('public/assets/imgs/default_user.png') }}">
                                    @endif
                                </a>
                            </div>
                            <div class="col-md-10 col-xs-10 user-caption">
                               <a href="{{ url('vendor/profile').'/'.$row->user_id }}">
                                <h5>
                                    @if (!empty($row->company_name))
                                    {{--  {{ str_limit(ucwords($row->company_name), $limit = 20, $end = '...') }} --}}
                                    {{ ucwords($row->company_name) }}
                                    @elseif (!empty($row->firstname) && !empty($row->lastname))
                                    {{ str_limit(ucwords($row->firstname).' '.ucwords($row->lastname), $limit = 20, $end = '...') }}
                                    @else
                                    John Doe
                                    @endif
                                </h5>
                            </a>
                            @if(!empty($row->country))
                            <p>
                                <a href="{{ url('vendor/profile').'/'.$row->user_id }}">
                                    <i class="fa fa-map-marker"></i>
                                    {{ $row->country }}
                                </a>
                            </p>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
                @if (!empty($row->albums))
                <ul class="hide" style="display:none;">
                    @foreach($row->albums as $j=>$img)
                    <li>
                        <a class="image-show" rel="group{{ $row->user_id}}" href="{{ asset('public/uploads/gallary/').'/'.$img }}" data-fancybox="group{{ $row->user_id}}" data-caption="{{ $row->user_id}}#{{ $j }}">
                            <img src="{{ asset('public/uploads/gallary/').'/'.$img }}" alt="" />
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endif
                @endforeach
            </div>
            @endforeach
            @else
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>
                    Sorry, No gallary images are found.
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</section>
<div class="clearfix"></div>
<script>
    var page = 1; //track user scroll as page number, right now page number is 1
    var load = true;
    $('document').ready(function() {
        $(window).scroll(function() { //detect page scroll
            if($(window).scrollTop() + $(window).height() + parseInt(100) >= $(document).height()) { //if user scrolled from top to bottom of the page
                page++; //page number increment
                load_more(page); //load content   
            }
        });  

        $(".image-show").fancybox();
        $('.open-album').click(function(e) {
            var el, id = $(this).data('open-id');
            if(id){
                el = $('.image-show[rel=' + id + ']:eq(0)');
                e.preventDefault();
                el.click();
            }
        }); 
    });     
    function load_more(page){
        if(load)
        {
            $.ajax(
            {
                url: url+'/gallery?page=' + page,
                type: "get",
                datatype: "html",
                beforeSend: function()
                {
                    if(!$("#gallery").find('.ajax-loading').hasClass('ajax-loading'))
                        $(".listing-main").after('<div class="ajax-loading text-center"><img src="'+url+'/public/assets/imgs/ajax-loader.gif" alt="ajax-loader" /></div>');
                }
            })
            .done(function(data)
            {
                $('.ajax-loading').remove(); //hide loading animation once data is received
                if(data.count == 0){
                    //notify user if nothing to load
                    $(".gallery-main").after('<div class="ajax-loading text-center"><p>No more records!</p></div>');
                    setTimeout(function(){
                        $('.ajax-loading').remove();
                    }, 3500);
                    load = false;
                    return false;
                }

                
                $(".gallery-main").append(data.html); //append data into #results element          
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
            $('.ajax-loading').remove(); //hide loading animation once data is received
            bootbox.alert('No response from server');
        });
        }
    }
</script>
@endsection