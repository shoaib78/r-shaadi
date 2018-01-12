
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
@endif
