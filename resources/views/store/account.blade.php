@extends('store.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="/">Home</a></li>
				
				<li class='active'>My Account</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>


			<div class='col-md-12'>



				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">My Orders</a></li>
								<li><a data-toggle="tab" href="#review">Account Settings</a></li>
								<li><a data-toggle="tab" href="#tags">Change Password</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">

								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">My cart division will come here</p>
									</div>	
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">



										<div class="product-add-review">
											<h4 class="title">My Details</h4>


											<div class="review-form">
												<div class="form-container">
													<form role="form" class="cnt-form">

														<div class="row">


															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Name <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Contact Number <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">E-Mail  <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
																</div><!-- /.form-group -->
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label for="exampleInputReview">Address <span class="astk">*</span></label>
																	<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->

														<div class="action text-right">
															<button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->										

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

								<div id="tags" class="tab-pane">
									<div class="product-tag">

										<div class="review-form">
											<div class="form-container">
												<form role="form" class="cnt-form">

													<div class="row">
														<div class="col-sm-12">
															<div class="col-sm-12"><div class="form-group">
																<label for="exampleInputName">Old Password <span class="astk">*</span></label>
																<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
															</div></div><!-- /.form-group -->
															<div class="col-sm-6"><div class="form-group">
																<label for="exampleInputName">New Password <span class="astk">*</span></label>
																<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
															</div></div><!-- /.form-group -->
															<div class="col-sm-6"><div class="form-group">
																<label for="exampleInputName">Conform New Password <span class="astk">*</span></label>
																<input type="text" class="form-control txt" id="exampleInputName" placeholder="">
															</div></div><!-- /.form-group -->
														</div>


													</div><!-- /.row -->

													<div class="action text-right">
														<button class="btn btn-primary btn-upper">Update Password</button>
													</div><!-- /.action -->
												</form><!-- /.cnt-form -->
											</div><!-- /.form-container -->
										</div><!-- /.review-form -->
									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->
							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->	
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
		<div id="brands-carousel" class="logo-slider wow fadeInUp">

			<div class="logo-slider-inner">	
				<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
					<div class="item m-t-15">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item m-t-10">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->

					<div class="item">
						<a href="#" class="image">
							<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
						</a>	
					</div><!--/.item-->
				</div><!-- /.owl-carousel #logo-slider -->
			</div><!-- /.logo-slider-inner -->

		</div><!-- /.logo-slider -->
		<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	
	</div><!-- /.container -->
</div><!-- /.body-content -->
@endsection