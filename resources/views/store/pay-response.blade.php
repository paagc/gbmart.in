
<html>
<head>
	<title>GBMart Payments</title>

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	@if(app('request')->has('ResponseCode') && app('request')->get('ResponseCode') == '0')
	<h2 style="text-align: center;">Your payment was successful. Redirecting to home page...</h2>
	<h4 style="text-align: center;">Do not reload or close this page.</h4>
	@else
	<h2 style="text-align: center;">Your payment has failed. Redirecting to checkout page...</h2>
	<h4 style="text-align: center;">Do not reload or close this page.</h4>
	@endif
	<form id="pay_form" name="pay_form" action="https://secure.ebs.in/pg/ma/payment/request" method="POST" style="display: none;">
	</form>
	<script>
		window.onload = function() {
			@if(app('request')->has('ResponseCode') && app('request')->get('ResponseCode') == '0')
			window.location.href="/";
			@else
			window.location.href="/store/checkout";
			@endif
		};
	</script>
</body>
</html>
