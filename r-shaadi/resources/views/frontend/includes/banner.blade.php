<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @if(!empty($slider))
            @foreach($slider as $i=>$row)
                <div class="item {{ ($i==0) ? 'active' : '' }}">
                    <img src="{{ asset('public/uploads/slider/').'/'.$row }}" class="img-responsive animated fadeIn" alt="...">
                </div>
            @endforeach
        @else
                <div class="item active">
                    <img src="{{ asset('public/assets/imgs/banner1.jpg') }}" class="img-responsive animated fadeIn" alt="...">
                    <div class="slider-caption col-sm-10">
                        <h2 class="animated fadeInUp">Weddings Made Easy</h2>
                        <p class="animated fadeInUp">Find the best wedding vendors with<br/>
                            thousands of trusted reviews</p>
                        <div class="col-sm-12 banner-search">
                            <div class="col-sm-6 bselect" style="padding:0">
                                <select class="form-control">
                                    <option>Option</option>
                                    <option>Option</option>
                                </select>
                            </div>
                            <div class="input-group col-sm-6 binput" style="padding:0">
                                <input type="text" class="form-control" value="San Francisco, CA" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-addon" style="height: 41px;"> &nbsp; <i class="fa fa-search"></i> &nbsp; </span>                        </div>
                        </div>
                    </div>
                </div>
        @endif
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
    </div>
</div>

<div class="top_search_bar">
    <div class="slider-caption col-sm-12">
        <h2 class="animated fadeInUp">Weddings Made Easy</h2>
        <p class="animated fadeInUp">Find the best wedding vendors with<br/>
                            thousands of trusted reviews</p>
	{!! Form::open(array('url' => route('service.filter'), 'method' => 'get', 'class' => 'form-horizontal','id'=>'search-service-form')) !!}
        <div class="col-sm-12 banner-search">
            <div class="col-sm-6 bselect" style="padding:0">
                <select class="form-control" name="category" id="category">
                    <option value="">All Categories</option>
                    @if (count($category)>0)
                        @foreach($category as $i=>$cat)
                        <?php
                            $selected = "";
                            if(isset($service_category) && $service_category == $cat->category_id){
                                $selected = 'selected="selected"';
                            }
                        ?>
                            <option value="{{ $cat->category_id }}" {{ $selected }}>{{ $cat->category_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="input-group col-sm-6 binput" style="padding:0">
                <input type="text" name="city" id="city" class="location form-control" placeholder="Place" aria-label="Amount (to the nearest dollar)">
                <span onclick="search_service();" class="input-group-addon" style="height: 41px;"> &nbsp; <i class="fa fa-search"></i> &nbsp; </span>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    </div>
</div>