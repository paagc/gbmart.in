@extends('seller.app')

@section('content_header')
<h1>
  Products 
</h1>
<ol class="breadcrumb">
  <li><a href="/seller">Home</a></li>
  <li class="active">Your Products</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<a href="/seller/seller-products/create" class="btn btn-success pull-right">Add New Product</a>
			</div>

			<div class="box-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th>#</th>
							<th>Display Name</th>
							<tH>Brand</th>
							<th>Category</th>
							<th>Sub Categeory</th>
							<th>Original Price</th>
							<th>Your Price</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
						<tr>
							<form action="/seller/seller-products" method="GET">
								<th></th>
								<th>
									<div class="form-group">
										<input type="text" name="display_name" class="form-control" placeholder="" @if(app('request')->has('display_name')) value="{{ app('request')->get('display_name') }}" @endif>
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
								<th></th>
								<th></th>
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
						@if(count($seller_products) == 0)
						<tr>
							<td colspan="6">No records found.</td>
						</tr>
						@endif
						@foreach($seller_products as $index => $seller_product)
						<tr>
							<td>{{ (($page - 1) * $page_size) + $index + 1 }}</td>
							<td>{{ $seller_product->product->display_name }}</td>
							<td>{{ $seller_product->product->brand }}</td>
							<td>{{ $seller_product->product->category->display_name }}</td>
							<td>{{ $seller_product->product->sub_category->display_name }}</td>
							<td>{{ $seller_product->product->original_price }}</td>
							<td>{{ $seller_product->seller_price }}</td>
							<td>{{ $seller_product->status }}</td>
							<td>
								@if($seller_product->status == 'ACTIVE')
								<a class="btn btn-danger" href="/seller/seller-products/{{ $seller_product->id }}/status/INACTIVE"><i class="fa fa-window-close"></i></a>
								@endif
								@if($seller_product->status == 'INACTIVE')
								<a class="btn btn-success" href="/seller/seller-products/{{ $seller_product->id }}/status/ACTIVE"><i class="fa fa-check-square"></i></a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				{{ $seller_products->appends(app('request')->all())->render() }}
			</div>
		</div>
	</div>
</div>
@endsection