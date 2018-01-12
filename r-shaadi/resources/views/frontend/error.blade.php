@extends('layouts.app')
{{-- Web site Title --}}
@section('title') {!! $title !!} :: @parent @endsection

{{-- Content --}}
@section('content')
<section class="banner-inner">
	<h3>Error</h3>
</section>


<section class="cotnent-area static-page">     
	<div class="container">
		<div class="col-sm-12 pl0">
			<div class="alert alert-danger">
				<p><strong>Sorry, No vendor are found on this link.</strong></p>
			</div>
		</div>
	</div>
</section>
@endsection