@extends('admin.app')

@section('content_header')
<h1>
	Google Shopping Content
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li class="active">Products in Google Shopping Content</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				@if (Session::has('success'))
				<h4 class="text-center text-green">{{ Session::get('success') }}</h4>
				@endif
				<h3>Existing Products In Google Shopping Content</h3>
			</div>

			<div class="box-body" style="height: 300px; overflow-y: scroll;">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Description</th>
							<th>Link</th>
							<th>Condition</th>
							<th>Price</th>
							<th>Availability</th>
							<th>Image Link</th>
							<th>Brand</th>
						</tr>
					</thead>
					<tbody style="height: 400px; overflow-y: scroll;">
						@foreach($existingProducts as $product)
						<tr>
							<td>{{ $product->offerId }}</td>
							<td style="width: 100px;">{{ $product->title }}</td>
							<td style="width: 200px;">{{ $product->description }}</td>
							<td style="width: 100px; word-break: break-all;"><a href="{{ $product->link }}" style="width: 100px; word-break: break-all;">{{ $product->link }}</a></td>
							<td>{{ $product->condition }}</td>
							<td>{{ $product->price->value }}</td>
							<td>{{ $product->availability }}</td>
							<td style="width: 100px; word-break: break-all;"><a href="{{ $product->imageLink }}" style="width: 100px; word-break: break-all;">{{ $product->imageLink }}</a></td>
							<td>{{ $product->brand }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<form method="POST" action="/admin/google-merchant-products">
			{{ csrf_field() }}
			<input type="hidden" name="access_token" value="{{ $google_access_token }}">
			<div class="box">
				<div class="box-header with-border">
					<h3>Products In GBMart</h3>
					<h5>Note: While updating, above products will be deleted, and below selected products will be inserted.</h5>
				</div>

				<div class="box-body" style="height: 300px; overflow-y: scroll;">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td><input type="checkbox" class="check-products" checked></td>
								<th>ID</th>
								<th>Name</th>
								<th>Description</th>
								<th>Link</th>
								<th>Condition</th>
								<th>Price</th>
								<th>Availability</th>
								<th>Image Link</th>
								<th>Brand</th>
							</tr>
						</thead>
						<tbody style="height: 400px; overflow-y: scroll;">
							@foreach($inputProducts as $product)
							<tr>
								<td><input type="checkbox" class="check-product" name="productIds[]" value="{{ $product['offerId'] }}" checked></td>
								<td>{{ $product['offerId'] }}</td>
								<td style="width: 100px;">{{ $product['title'] }}</td>
								<td style="width: 200px;">{{ $product['description'] }}</td>
								<td style="width: 100px; word-break: break-all;"><a href="{{ $product['link'] }}" style="width: 100px; word-break: break-all;">{{ $product['link'] }}</a></td>
								<td>{{ $product['condition'] }}</td>
								<td>{{ $product['price.value'] }}</td>
								<td>{{ $product['availability'] }}</td>
								<td style="width: 100px; word-break: break-all;"><a href="{{ $product['imageLink'] }}" style="width: 100px; word-break: break-all;">{{ $product['imageLink'] }}</a></td>
								<td>{{ $product['brand'] }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-info">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('footer')
<script>
	$(document).ready(function () {
		$('input.check-products').change(function () {
			var checked = $(this).prop('checked');
			$('input.check-product').each(function () {
				$(this).prop('checked', checked);
			});
		});

		$('input.check-product').change(function () {
			var checked = true;
			$('input.check-product').each(function () {
				var thisChecked = $(this).prop('checked');
				if (!thisChecked) {
					checked = thisChecked;
				}
			});
			$('input.check-products').prop('checked', checked);
		});
	});
</script>
@endsection