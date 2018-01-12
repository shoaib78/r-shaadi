<html>
<head>

</head>
<body style="background-color: #262626;border: 1px solid #000000; color: #fff">
	<div style=" color: #000;    padding: 20px;    font-size: 20px;">
		<p>Hello Site Owner</p>
	
		<p>For {{ ucwords(str_replace("_","And",$reason_type)) }}</p>

		@if($reason && $reason != -1)
			<p><strong>Reason: </strong>{{ $reason }}</p>
		@endif
		
		<p>{{ $content }}</p>
		
		<br/>
		<strong>Thanks &amp; Regards</strong><br/>
		<strong>Shaadi Vibes</strong>
	</div>
</body>
</html>