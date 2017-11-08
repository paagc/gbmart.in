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
				<div class="col-md-12 col-sm-12 create-new-account">
					<h4 class="checkout-subtitle">Create a new account</h4>
					<p class="text title-tag-line">Create your new account.</p>
					<form class="register-form outer-top-xs" role="form" action="/seller/register" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="type" value="seller">

						@if(Session::has('error'))
						<p style="text-align: center; color: red;">{{ Session::get('error') }}</p>
						@endif
						<div class="form-group row">
							<div class="col-sm-6 col-md-6">
								<label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
								<input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="email" value="{{old('email')}}">
								@if($errors->has('email'))
							    <span class="text-danger">{{ $errors->first('email') }}</span>
							    @endif
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6 col-sm-6">
								<label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="name" value="{{old('name')}}">
								@if($errors->first('name'))
							    <span class="text-danger">{{ $errors->first('name') }}</span>
							    @endif
							</div>
							<div class="col-md-6 col-sm-6">
								<label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
								<input type="number" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="mobile_number" value="{{old('mobile_number')}}">
								@if($errors->first('mobile_number'))
							    <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
							    @endif
							</div>
								
						</div>
						<div class="form-group row">
							<div class="col-sm-6 col-md-6">
								<label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
								<input type="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="password" >
								@if($errors->first('password'))
							    <span class="text-danger">{{ $errors->first('password') }}</span>
							    @endif
							</div>

							<div class="col-sm-6 col-md-6">
								<label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
								<input type="text" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="password_confirmation" >
								@if($errors->first('password_confirmation'))
							    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
							    @endif
							</div>	
						</div>
						<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
					</form>
				</div>	
			</div>
		</div>
		
	</div>
</div>
@endsection