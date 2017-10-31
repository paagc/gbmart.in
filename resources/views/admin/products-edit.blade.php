@extends('admin.app')

@section('content_header')
<h1>
	Edit Product
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li><a href="/admin/products">Products</a></li>
	<li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			@if(Session::has('error'))
			<p class="text-red">{{ Session::get('error') }}</p>
			@endif
			@if(Session::has('success'))
			<p class="text-green">{{ Session::get('success') }}</p>
			@endif
			<form role="form" action="/admin/products/{{$product->id}}/edit" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
            	<input type="hidden" name="_method" value="PUT">

				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputSubCategory">Sub Category</label>
								<select name="sub_category_id" class="form-control" id="inputSubCategory">
									<option></option>
									@foreach($sub_categories as $sub_category)
									<option value="{{ $sub_category->id }}" @if(old('sub_category_id') == $sub_category->id) selected @elseif ($product->sub_category->id == $sub_category->id) selected  @endif>{{ $sub_category->display_name }}</option>
									@endforeach
								</select>
								@if($errors->has('sub_category_id'))
							    <span class="text-danger">{{ $errors->first('sub_category_id') }}</span>
							    @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputName">Name</label>
								<input type="text" name="display_name" class="form-control" id="inputName" placeholder="Enter product name" value="{{ old('display_name') ? old('display_name') : $product->display_name }}">
								@if($errors->has('display_name'))
							    <span class="text-danger">{{ $errors->first('display_name') }}</span>
							    @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputBrand">Brand</label>
								<input type="text" name="brand" class="form-control" id="inputBrand" value="{{ old('brand') ? old('brand') : $product->brand }}">
								@if($errors->has('brand'))
							    <span class="text-danger">{{ $errors->first('brand') }}</span>
							    @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputOriginalPrice">Original price</label>
								<input type="number" name="original_price" class="form-control" id="inputOriginalPrice" placeholder="Enter price" value="{{ old('original_price') ? old('original_price') : $product->original_price }}">
								@if($errors->has('original_price'))
							    <span class="text-danger">{{ $errors->first('original_price') }}</span>
							    @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputProductImages">Images</label>
								<input type="file" multiple accept=".jpeg,.jpg,.png" name="images[]" class="form-control" id="inputProductImages" placeholder="Upload images" value="{{ old('images') }}">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label for="inputIsFeatured">Is featured?</label>
								<br>
								<input type="checkbox" name="is_featured" id="inputIsFeatured" placeholder="Enter price" value="true" @if(old('is_featured') == true) checked @elseif($product->is_featured) checked @endif>
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label for="inputHotDeal">Is hot deal?</label>
								<br>
								<input type="checkbox" name="is_hot_deal" id="inputHotDeal" placeholder="Enter price" value="true" @if(old('is_hot_deal') == true) checked @elseif($product->is_hot_deal) checked @endif>
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label for="inputBestseller">Is bestseller?</label>
								<br>
								<input type="checkbox" name="is_bestseller" id="inputBestseller" placeholder="Enter price" value="true" @if(old('is_bestseller') == true) checked @elseif($product->is_bestseller) checked @endif>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="inputDescriptionText">Description</label>
								<textarea rows="8" name="description_text" class="form-control text-area" id="inputDescriptionText" placeholder="Enter description">{{ old('description_text') ? old('description_text') : $product->description_text }}</textarea>
								@if($errors->has('description_text'))
							    <span class="text-danger">{{ $errors->first('description_text') }}</span>
							    @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="imageDescriptionImage">Decription Image</label>
								<input type="file" accept=".jpeg,.jpg,.png" name="description_image" class="form-control" id="imageDescriptionImage" placeholder="Upload images" value="{{ old('description_image') }}">
								@if($errors->has('description_image'))
							    <span class="text-danger">{{ $errors->first('description_image') }}</span>
							    @endif
							</div>
							<div class="form-group">
								<label for="inputDescriptionVideo">Description video</label>
								<input type="text" name="description_video_url" class="form-control" id="inputDescriptionVideo" placeholder="Enter video embed url" value="{{ old('description_video_url') ? old('description_video_url') : $product->description_video_url }}">
								@if($errors->has('description_video_url'))
							    <span class="text-danger">{{ $errors->first('description_video_url') }}</span>
							    @endif
							</div>
							<div class="form-group">
								<label for="inputDescriptionSmall">Small Description</label>
								<textarea rows="2" name="description_small" class="form-control" id="inputDescriptionSmall" placeholder="Enter small description">{{ old('description_small') ? old('description_small') : $product->description_small }}</textarea>
								@if($errors->has('description_small'))
							    <span class="text-danger">{{ $errors->first('description_small') }}</span>
							    @endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Product Attributes</h4>
						</div>
						<div class="col-md-12">
							<a class="btn btn-info add-product-attribute"><i class="fa fa-plus"></i> Add</a>
							<a class="btn btn-danger clear-product-attributes"><i class="fa fa-close"></i> Reset</a>
						</div>
						<div class="col-md-12">
						</div>
						<div class="col-md-12">
							<div class="row product-attributes">
								<div class="col-md-3 product-attribute">
									<div class="form-group">
										<input name="attributes[]" class="form-control" placeholder="Size, colour, or any other variation">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								@foreach ($product->attributes as $attribute)
								@if ($attribute->status == 'ACTIVE')
								<div class="col-md-3 product-attribute">
									<div class="form-group">
										<p>{{$attribute->name}} <i class="fa fa-times click_to_delete" title="delete" style="cursor: pointer;float: right;color: red;margin-right: 25px;"></i></p>
										<input type="checkbox" name="product_attribute_id[]" value="{{$attribute->id}}" title="check to delete" class="check_to_delete" style="display: none;">
									</div>
								</div>
								@endif
								@endforeach
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Product Gallery</h4>
						</div>
						<div class="col-sm-12 col-md-12">
							@forelse ($product->product_images as $image)
								@if ($image->status == 'ACTIVE')
								<div class="col-sm-3 col-md-3 product_image" style="padding: 15px;">
									<img src="{{ $image->url }}" style="width: 100%; height: 200px;margin: auto;display: block;">
									<input type="checkbox" name="uploaded_image_id[]" value="{{$image->id}}" title="check to delete" class="check_to_delete" style="display: none;">
									<i class="fa fa-trash click_to_delete" title="delete" style="cursor: pointer;color: red;"></i>
								</div>
								@endif
							@empty
							<p>No Images Uploaded</p>
							@endforelse
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Description Image</h4>
						</div>
						<div class="col-sm-4 col-md-4 description_image">
							@if ($product->description_image_url)
								<img src="{{ $product->description_image_url }}" style="width: 100%">
								<input type="checkbox" name="delete_description_image" value="true" title="check to delete" class="check_to_delete" style="display: none;">
								<i class="fa fa-trash click_to_delete" title="delete" style="cursor: pointer;color: red;"></i>
							@else
							<p>No Image Uploaded</p>
							@endif
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

@section('footer')
<script>
	$(document).ready(function () {
		$('.add-product-attribute').click(function() {
			$('.product-attributes').append('<div class="col-md-3 product-attribute"><div class="form-group"><input name="attributes[]" class="form-control" placeholder="Size, colour, or any other variation"></div></div>');
		});

		$('.clear-product-attributes').click(function() {
			$('.product-attributes').html('<div class="col-md-3 product-attribute"><div class="form-group"><input name="attributes[]" class="form-control" placeholder="Size, colour, or any other variation"></div></div>');
		});

		$('.click_to_delete').click(function() {
			if (confirm('Are you sure, you want to delete ?')) {
				$(this).siblings('.check_to_delete').prop('checked', true);
				$(this).parents('.product_image').css('display', 'none');
				$(this).parents('.description_image').css('display', 'none');
				$(this).parents('.product-attribute').css('display', 'none');
			}
		});

		$('.textarea').wysihtml5();
	});
</script>
@endsection