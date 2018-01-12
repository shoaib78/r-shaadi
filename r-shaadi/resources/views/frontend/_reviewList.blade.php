@if (count($reviews)>0)
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