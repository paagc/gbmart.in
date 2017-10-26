@extends('admin.app')

@section('content_header')
<h1>
	Offers
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li class="active">Offers</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<a href="/admin/offers/create" class="btn btn-success pull-right">Create Offres</a>
			</div>

			<div class="box-body">
				<form action="/admin/offers" method="GET">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Image</th>
								<tH>Link URL</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td><input type="text" name="title" placeholder="Search for title" class="form-control" @if(app('request')->has('title')) value="{{ app('request')->get('title') }}" @endif></td>
								<td></td>
								<td><input type="text" name="link_url" placeholder="Link URL" class="form-control" @if(app('request')->has('link_url')) value="{{ app('request')->get('link_url') }}" @endif></td>
								<td></td>
								<td></td>
								<td></td>
								<td><button type="submit" class="btn btn-primary">GO</button></td>
							</tr>
							@forelse ($offers as $index => $offer)
							<tr>
								<td>{{ $index+1 }}</td>
								<td>{{ $offer->title }}</td>
								<td>
									@if ($offer->image_url)
									<a href="{{$offer->image_url}}" class="btn btn-info btn-sm" target="_blank">View Image</a>
									@else
									No Image Found
									@endif
								</td>
								<td><a href="{{ $offer->link_url }}">{{ $offer->link_url }}</a></td>
								<td>{{ $offer->start_date }}</td>
								<td>{{ $offer->end_date }}</td>
								<td>{{ $offer->status }}</td>
								<td>
									@if ($offer->status == 'ACTIVE')
									<a href="/admin/offers/{{$offer->id}}/destroy" title="Deactivate" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
									@else
									<a href="/admin/offers/{{$offer->id}}/active" title="Activate" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
									@endif

									<a href="/admin/offers/{{$offer->id}}/edit" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="8" class="text-center">No Offers Available</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</form>
			</div>
			<div class="box-footer clearfix">
				{{ $offers->appends(app('request')->all())->render() }}
			</div>
		</div>
	</div>
</div>
@endsection