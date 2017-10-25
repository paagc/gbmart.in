@extends('admin.app')

@section('content_header')
<h1>
  Sellers
</h1>
<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li class="active">Sellers</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-body">
				<form action="/admin/sellers" method="GET">
					<table class="table table-bordered">
						<thead>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile Number</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							<tr>
								<th></th>
								<th>
									<div class="form-group">
										<input type="text" name="name" class="form-control" placeholder="" @if(app('request')->has('name')) value="{{ app('request')->get('name') }}" @endif>
									</div>
								</th>
								<th>
									<div class="form-group">
										<input type="text" name="email" class="form-control" placeholder="" @if(app('request')->has('email')) value="{{ app('request')->get('email') }}" @endif>
									</div>
								</th>
								<th>
									<div class="form-group">
										<input type="text" name="mobile_number" class="form-control" placeholder="" @if(app('request')->has('mobile_number')) value="{{ app('request')->get('mobile_number') }}" @endif>
									</div>
								</th>
								<th></th>
								<th>
									<button class="btn btn-primary btn-sm" type="submit">Filter</button>
								</th>
							</tr>
							@forelse($sellers as $index => $seller)
							@if ($seller->hasRole('seller'))
							<tr>
								<td>{{ $index+1 }}</td>
								<td>{{ $seller->name }}</td>
								<td>{{ $seller->email }}</td>
								<td>{{ $seller->mobile_number }}</td>
								<td>{{ $seller->status }}</td>
								<td>
									@if ($seller->status == 'PENDING')
									<a href="/admin/sellers/activate/{{$seller->id}}" class="btn btn-primary btn-sm">Activate</a>
									@elseif ($seller->status == 'INACTIVE')
									<a href="/admin/sellers/enable/{{$seller->id}}" class="btn btn-warning btn-sm">Enable</a>
									@elseif ($seller->status == 'ACTIVE')
									<a href="/admin/sellers/disable/{{$seller->id}}" class="btn btn-danger btn-sm">Disable</a>
									@endif
								</td>
							</tr>
							@endif
							@empty
                            <tr>
                                <td colspan="5"><center>No Seller Available</center></td>
                            </tr>
                            @endforelse
						</tbody>
					</table>
				</form>
			</div>
			<div class="box-footer clearfix">
				{{ $sellers->appends(app('request')->all())->render() }}
			</div>
		</div>
	</div>
</div>
@endsection