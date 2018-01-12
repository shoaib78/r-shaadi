@if(count($local_vendors)>0)
<div class="container">
    <div class="row">
        <h2 class="sec-heading">Find Local Wedding Vendors</h2>
        <div class="spacer50"></div>
        @foreach($local_vendors as $row)
            <div class="col-sm-4">
                <!-- normal -->
                <div class="ih-item circle effect3 left_to_right">
                <a href="{{ (isset($row['link']) && !empty($row['link'])) ? $row['link'] : 'javascript:void(0);' }}">
                    <div class="img">
                        @if($row['image'])
                            <img src="{{ url('public/uploads').'/'.$row['image'] }}" alt="img">
                        @else
                            <img src="{{ asset('public/assets/imgs/4.jpg') }}" alt="img">
                        @endif
                    </div>

                    <div class="info">
                        <h3>
                            @if($row['title'])
                                {!! $row['title'] !!}
                            @endif
                        </h3>
                        <p>
                            @if($row['description'])
                                {{ $row['description'] }}
                            @endif
                        </p>
                    </div>
                    </a>
                </div>
                <!-- end normal -->
            </div>
        @endforeach
    </div>
</div>
@endif