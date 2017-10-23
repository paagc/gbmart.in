@extends('admin.app')

@section('content_header')
<h1>
	Create A New Sub Category
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li><a href="/admin/products">Sub Categories</a></li>
	<li class="active">Create</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			@if(Session::has('error'))
			<p class="text-red text-center">{{ Session::get('error') }}</p>
			@endif
			@if(Session::has('success'))
			<p class="text-green text-center">{{ Session::get('success') }}</p>
			@endif
			<form role="form" action="/admin/sub-categories/create" method="POST">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<label for="inputCategory">Category</label>
						<select name="category_id" class="form-control" id="inputCategory">
							<option></option>
							@foreach($categories as $category)
							<option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->display_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="inputName">Name</label>
						<input type="text" name="display_name" class="form-control" id="inputName" placeholder="Enter sub category name" value="{{ old('display_name') }}">
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