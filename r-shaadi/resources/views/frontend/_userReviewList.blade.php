@if (count($reviews)>0)
	@foreach($reviews as $i=>$row)
        <div class="media">
            <div class="media-left">
                <a href="{{ url('vendor/profile').'/'.$row['user_id'] }}">
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
                        <a class="custom-link" href="{{ url('vendor/profile').'/'.$row['user_id'] }}">
                            @if (!empty($row['company_name']))
                                {{ ucwords($row['company_name']) }}
                            @elseif (!empty($row['firstname']) && !empty($row['lastname']))
                            {{ ucwords($row['firstname']).' '.ucwords($row['lastname']) }}
                            @else
                            John Doe
                            @endif
                        </a>
                    </h4>
                    <h5 class="media-subheading">Reviwed on {{ date('d-F-Y', strtotime($row['created_at'])) }}</h5>
                </div>
                <span class="ratingg text-right pull-right">
                    <input value="{{ round($row['rating']) }}" type="number" class="recent-review" data-size="s" >
                </span>
                <div class="col-sm-12 p0 media-cotnent">
                    @if (!empty($row['description']))
                    <span class="more">
                        {!! ucfirst(nl2br($row['description'])) !!}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@else
	<div class="alert alert-danger">
		<p>
			<strong>Sorry, Reviews are not found for this rating.</strong>
		</p>
	</div>
@endif