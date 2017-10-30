@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/">Home</a></li>
				<li class='active'>Write To Us</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row">
			<h2 style="text-align:center">Any Queries Reach Us</h2>
			<div class="col-md-6">
				<form class="register-form" role="form">
					<div class="form-group">
						<label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
						<input type="email" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="">
					</div>

					<div class="form-group">
						<label class="info-title" for="exampleInputEmail1">Email Address<span>*</span></label>
						<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="">
					</div>

					<div class="form-group">
						<label class="info-title" for="exampleInputTitle">Phone<span>*</span></label>
						<input type="email" class="form-control unicase-form-control text-input" id="exampleInputTitle" placeholder="">
					</div>

					<div class="form-group">
						<label class="info-title" for="exampleInputComments">Your Message<span>*</span></label>
						<textarea class="form-control unicase-form-control" id="exampleInputComments"></textarea>
					</div>

					<center> 
						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send Message</button>
					</center>
					<br>
				</form>
			</div>

			<div class="col-md-6">

				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.1359311846813!2d77.57568851482263!3d13.027014590819538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae17c43fb2a2fd%3A0x4d48adf3419a99cc!2sPaagc+Digital+Pvt.+Ltd.!5e0!3m2!1sen!2sin!4v1508563235484"

				width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

			</div>


		</div>
	</div>






</div>
@endsection