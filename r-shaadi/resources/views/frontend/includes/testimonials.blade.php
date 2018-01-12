@if(count($user_comments)>0)
<div class="container">
    <div class="row">
        <h2 class="sec-heading">Testimonials</h2>
        <div class="spacer50"></div>
        <div id="carousel-example-generic-testi" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox" style="padding: 50px 15px;">
                @foreach($user_comments as $i=>$row)
                    <div class="item {{ ($i==0)?'active':'' }}">
                        <div class="col-sm-3 tleft-img">
                            @if($row['profile_pic'])
                                <img src="{{ url('public/uploads').'/'.$row['profile_pic'] }}" class="img-responsive" alt="img">
                            @else
                               <img src="{{ asset('public/assets/imgs/client.png') }}" class="img-responsive"/>
                            @endif
                            
                        </div>

                        <div class="col-sm-8 pull-right tright-content">
                            @if($row['description'])
                                {!! $row['description'] !!}
                            @endif
                            <h6>
                                @if($row['name'])
                                    {!! $row['name'] !!}
                                @endif
                            </h6>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @foreach($user_comments as $i=>$row)
                    <li data-target="#carousel-example-generic-testi" data-slide-to="{{ $i }}" class="{{ ($i==0)?'active':'' }}"></li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endif