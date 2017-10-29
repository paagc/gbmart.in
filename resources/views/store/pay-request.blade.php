<html>
<head>
	<title>GBMart Payments</title>
</head>
<body>
	<h2 style="text-align: center;">Please wait for payment options...</h2>
	<h4 style="text-align: center;">Do not reload or close this page.</h4>
	<form id="pay_form" name="pay_form" action="https://secure.ebs.in/pg/ma/payment/request" method="POST" style="display: none;">
		@foreach($parameters as $key => $value)
		<input type="hidden" name="{{ $key }}" value="{{ $value }}">
		@endforeach
		<input type="submit" value="Submit">
	</form>
	<script>
		window.onload = function() {
			document.pay_form.submit();
		};
	</script>
</body>
</html>