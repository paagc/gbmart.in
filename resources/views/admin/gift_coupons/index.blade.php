@extends('admin.app')

@section('content_header')
<h1>
	Gift Coupons
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li class="active">Gift Coupons</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<a href="/admin/gift-coupon/create" class="btn btn-success pull-right">Create Coupon</a>
			</div>

			<div class="box-body">
				<form method="GET" action="/admin/gift-coupon">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Code</th>
								<th>Value</th>
								<tH>Max Amount</th>
								<tH>End Date</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td><input type="text" name="code" placeholder="Search for code" class="form-control" @if(app('request')->has('code')) value="{{ app('request')->get('code') }}" @endif></td>
								<td><input type="text" name="value" placeholder="Value" class="form-control" @if(app('request')->has('value')) value="{{ app('request')->get('value') }}" @endif></td>
								<td><input type="text" name="max_amount" placeholder="Max Amount" class="form-control" @if(app('request')->has('max_amount')) value="{{ app('request')->get('max_amount') }}" @endif></td>
								<td></td>
								<td></td>
								<td><button type="submit" class="btn btn-primary">GO</button></td>
							</tr>
							@forelse($coupons as $index => $coupon)
							<tr>
								<td>{{ $index+1 }}</td>
								<td>{{ $coupon->code }}</td>
								<td>{{ $coupon->value }}</td>
								<td>{{ $coupon->max_amount }}</td>
								<td>{{ $coupon->end_date }}</td>
								<td>{{ $coupon->status }}</td>
								<td>
									@if ($coupon->status == 'ACTIVE')
									<a href="/admin/gift-coupon/{{$coupon->id}}/destroy" title="Deactivate" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
									@else
									<a href="/admin/gift-coupon/{{$coupon->id}}/active" title="Activate" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
									@endif

									<a href="/admin/gift-coupon/{{$coupon->id}}/edit" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="7" class="text-center">No coupons to display</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</form>
			</div>
			<div class="box-footer clearfix">
				{{ $coupons->appends(app('request')->all())->render() }}
			</div>
		</div>
	</div>
</div>
@endsection