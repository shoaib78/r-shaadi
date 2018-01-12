@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

@section('content')
<section class="banner-inner">
   <h3>
   		@if(isset($title) && count($title)>0)
	        {!! (($title)) !!}
	    @endif
   </h3>
</section>

<section>
	<div class="container">
		@if(isset($content) && count($content)>0)
	        {!! (($content->content)) !!}
	    @endif
	</div>
</section>
@endsection