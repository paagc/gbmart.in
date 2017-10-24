@extends('admin.app')

@section('content_header')
<h1>
	Products
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li class="active">Products</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<a href="/admin/products/create" class="btn btn-success pull-right">Add New Product</a>
			</div>

			<div class="box-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th>#</th>
							<th>Display Name</th>
							<th>Slug Name</th>
							<tH>Brand</th>
							<th>Category</th>
							<th>Sub Categeory</th>
							<th>Is Featured</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
						<tr>
							<form action="/admin/products" method="GET">
								<th></th>
								<th>
									<div class="form-group">
										<input type="text" name="display_name" class="form-control" placeholder="" @if(app('request')->has('display_name')) value="{{ app('request')->get('display_name') }}" @endif>
									</div>
								</th>
								<th>
									<div class="form-group">
										<input type="text" name="name" class="form-control" placeholder="" @if(app('request')->has('name')) value="{{ app('request')->get('name') }}" @endif>
									</div>
								</th>
								<th>
									<div class="form-group">
										<input type="text" name="brand" class="form-control" placeholder="" @if(app('request')->has('brand')) value="{{ app('request')->get('brand') }}" @endif>
									</div>
								</th>
								<th>
									<div class="form-group">
										<select name="category_name" class="form-control">
											<option></option>
											@foreach($categories as $category)
											<option value="{{ $category->name }}" @if(app('request')->has('category_name') && app('request')->get('category_name') == $category->name) selected @endif>{{ $category->display_name }}</option>
											@endforeach
										</select>
									</div>
								</th>
								<th>
									<div class="form-group">
										<select name="sub_category_name" class="form-control">
											<option></option>
											@foreach($sub_categories as $sub_category)
											<option value="{{ $sub_category->name }}" @if(app('request')->has('sub_category_name') && app('request')->get('sub_category_name') == $sub_category->name) selected @endif>{{ $sub_category->display_name }}</option>
											@endforeach
										</select>
									</div>
								</th>
								<th>
									<div class="form-group">
										<input type="checkbox" name="is_featured" placeholder="" value="YES" @if(app('request')->has('is_featured') && app('request')->get('is_featured')) checked @endif>
									</div>
								</th>
								<th>
									<div class="form-group">
										<select name="status" class="form-control">
											<option></option>
											<option value="ACTIVE" @if(app('request')->has('status') && app('request')->get('status') == 'ACTIVE') selected @endif>ACTIVE</option>
											<option value="INACTIVE" @if(app('request')->has('status') && app('request')->get('status') == 'INACTIVE') selected @endif>INACTIVE</option>
										</select>
									</div>
								</th>
								<th>
									<button type="submit" class="btn btn-primary">Filter</button>
								</th>
							</form>
						</tr>
						@if(count($products) == 0)
						<tr>
							<td colspan="6">No records found.</td>
						</tr>
						@endif
						@foreach($products as $index => $product)
						<tr>
							<td>{{ (($page - 1) * $page_size) + $index + 1 }}</td>
							<td>{{ $product->display_name }}</td>
							<td>{{ $product->name }}</td>
							<td>{{ $product->brand }}</td>
							<td>{{ $product->category->display_name }}</td>
							<td>{{ $product->sub_category->display_name }}</td>
							<td>{{ ($product->is_featured ? "YES" : "NO") }}</td>
							<td>{{ $product->status }}</td>
							<td>
								@if($product->status == 'ACTIVE')
								<a class="btn btn-danger" href="/admin/products/{{ $product->id }}/status/INACTIVE"><i class="fa fa-window-close"></i></a>
								@endif
								@if($product->status == 'INACTIVE')
								<a class="btn btn-success" href="/admin/products/{{ $product->id }}/status/ACTIVE"><i class="fa fa-check-square"></i></a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				{{ $products->appends(app('request')->all())->render() }}
			</div>
		</div>
	</div>
</div>
@endsection