@extends('admin.app')

@section('content_header')
<h1>
	Create A Product
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li><a href="/admin/products">Products</a></li>
	<li class="active">Create</li>
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
			<form role="form" action="/admin/products/create" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputSubCategory">Sub Category</label>
								<select name="sub_category_id" class="form-control" id="inputSubCategory">
									<option></option>
									@foreach($sub_categories as $sub_category)
									<option value="{{ $sub_category->id }}" @if(old('sub_category_id') == $sub_category->id) selected @endif>{{ $sub_category->display_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputName">Name</label>
								<input type="text" name="display_name" class="form-control" id="inputName" placeholder="Enter product name" value="{{ old('display_name') }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputBrand">Brand</label>
								<input type="text" name="brand" class="form-control" id="inputBrand" placeholder="Enter brand" value="{{ old('brand') }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputOriginalPrice">Original price</label>
								<input type="number" name="original_price" class="form-control" id="inputOriginalPrice" placeholder="Enter price" value="{{ old('original_price') }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputProductImages">Images</label>
								<input type="file" multiple accept=".jpeg,.jpg,.png" name="images[]" class="form-control" id="inputProductImages" placeholder="Upload images" value="{{ old('images') }}">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="inputIsFeatured">Is featured?</label>
								<br>
								<input type="checkbox" name="is_featured" id="inputIsFeatured" placeholder="Enter price" value="true" @if(old('is_featured') == "true") checked @endif>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="inputDescriptionText">Description</label>
								<textarea rows="5" name="description_text" class="form-control" id="inputDescriptionText" placeholder="Enter description">{{ old('description_text') }}</textarea>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="imageDescriptionImage">Decription Image</label>
								<input type="file" accept=".jpeg,.jpg,.png" name="description_image" class="form-control" id="imageDescriptionImage" placeholder="Upload images" value="{{ old('description_image') }}">
							</div>
							<div class="form-group">
								<label for="inputDescriptionVideo">Description video</label>
								<input type="text" name="description_video_url" class="form-control" id="inputDescriptionVideo" placeholder="Enter video embed url" value="{{ old('description_video_url') }}">
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