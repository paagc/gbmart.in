@extends('admin.app')

@section('content_header')
<h1>
	Edit Slide
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li><a href="/admin/home-slide">Home</a></li>
	<li class="active">Edit</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<form role="form" action="/admin/home-slide/{{$slide->id}}/edit" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="title">Title<span class="text-danger"> *</span></label>
								<input type="text" name="title" class="form-control" id="title" placeholder="Enter Offer Title" value="{{ old('title') ? old('title') : $slide->title }}">
								@if($errors->has('title'))
							    <span class="text-danger">{{ $errors->first('title') }}</span>
							    @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="link_url">Link<span class="text-danger"> *</span></label>
								<input type="url" name="link_url" class="form-control" id="link_url" placeholder="Enter Link URL" value="{{ old('link_url') ? old('link_url') : $slide->link_url }}">
								@if($errors->has('link_url'))
							    <span class="text-danger">{{ $errors->first('link_url') }}</span>
							    @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="image">Image</label>
								<input type="file" accept=".jpeg,.jpg,.png" name="background_image" class="form-control" id="image" placeholder="Upload images" value="{{ old('background_image') }}">
								@if($errors->has('background_image'))
							    <span class="text-danger">{{ $errors->first('background_image') }}</span>
							    @endif
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Offer Imgae</h4>
						</div>
						<div class="col-sm-12 col-md-12">
							@if ($slide->image_url)
							<div class="col-sm-3 col-md-3">
								<img src="{{ $slide->image_url }}" style="width: 100%">
								<p class="text-warning" style="font-size: 12px;font-style: italic;">* Upload new Image to change this Offer image.</p>
							</div>
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