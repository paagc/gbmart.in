@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Login</li>
			</ul>
		</div>
	</div>
</div>

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->
				@if(Session::has('error'))
				<div class="col-md-offset-3 col-md-6">
					<h5 class="text-center text-danger">{{ Session::get('error') }}</h5>
				</div>
				@endif
				@if($errors->has('email'))
				<div class="col-md-offset-3 col-md-6">
					<h5 class="text-center text-danger">{{ $errors->first('email') }}</h5>
				</div>
				@elseif($errors->has('name'))
				<div class="col-md-offset-3 col-md-6">
					<h5 class="text-center text-danger">{{ $errors->first('name') }}</h5>
				</div>
				@elseif($errors->has('mobile_number'))
				<div class="col-md-offset-3 col-md-6">
					<h5 class="text-center text-danger">{{ $errors->first('mobile_number') }}</h5>
				</div>
				@elseif($errors->has('password'))
				<div class="col-md-offset-3 col-md-6">
					<h5 class="text-center text-danger">{{ $errors->first('password') }}</h5>
				</div>
				@elseif($errors->has('confirm_password'))
				<div class="col-md-offset-3 col-md-6">
					<h5 class="text-center text-danger">{{ $errors->first('confirm_password') }}</h5>
				</div>
				@endif
				<div class="col-md-6 col-sm-6 sign-in">
					<h4 class="">Sign in</h4>
					<p class="">Hello, Welcome to your account.</p>

					<form class="register-form outer-top-xs" role="form" action="" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
							<input name="email" type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
							<input name="password" type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" >
						</div>

						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
						<a href="{{url('password/email')}}">Forgot Password?</a>
					</form>					
				</div>

				<div class="col-md-6 col-sm-6 create-new-account">
					<h4 class="checkout-subtitle">Create a new account</h4>
					<p class="text title-tag-line">Create your new account.</p>
					<form class="register-form outer-top-xs" role="form" action="/register" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
							<input name="email" type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" >
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
							<input name="name" type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
							<input name="mobile_number" type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
							<input name="password" type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
						</div>
						<div class="form-group">
							<label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
							<input name="confirm_password" type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
						</div>
						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
					</form>


				</div>	
			</div>
		</div>

	</div>
</div>
@endsection