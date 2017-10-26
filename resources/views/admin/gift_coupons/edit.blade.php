@extends('admin.app')

@section('content_header')
<h1>
	Edit Slide
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li><a href="/admin/gift-coupon">Home</a></li>
	<li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<form role="form" action="/admin/gift-coupon/{{$coupon->id}}/edit" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">
				
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="code">Code<span class="text-danger"> *</span></label>
								<input type="text" name="code" class="form-control" id="code" placeholder="Enter Code" value="{{ old('code') ? old('code') : $coupon->code }}">
								@if($errors->has('code'))
							    <span class="text-danger">{{ $errors->first('code') }}</span>
							    @endif
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="value">Value<span class="text-danger"> *</span></label>
								<input type="text" name="value" class="form-control" id="value" placeholder="Enter Value" value="{{ old('value') ? old('value') : $coupon->value }}">
								@if($errors->has('value'))
							    <span class="text-danger">{{ $errors->first('value') }}</span>
							    @endif
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="type">Type<span class="text-danger"> *</span></label>
								<input type="text" name="type" class="form-control" id="type" placeholder="Coupon Type" value="{{ old('type') ? old('type') : $coupon->type }}">
								@if($errors->has('type'))
							    <span class="text-danger">{{ $errors->first('type') }}</span>
							    @endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="max_amount">Max Amount<span class="text-danger"> *</span></label>
								<input type="text" name="max_amount" class="form-control" id="max_amount" placeholder="Max Amount" value="{{ old('max_amount') ? old('max_amount') : $coupon->max_amount }}">
								@if($errors->has('max_amount'))
							    <span class="text-danger">{{ $errors->first('max_amount') }}</span>
							    @endif
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="end_date">End Date<span class="text-danger"> *</span></label>
								<input type="date" name="end_date" class="form-control" id="end_date" value="{{ old('end_date') ? old('end_date') : $coupon->end_date }}">
								@if($errors->has('end_date'))
							    <span class="text-danger">{{ $errors->first('end_date') }}</span>
							    @endif
							</div>
						</div>
					</div>
				</div>

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection