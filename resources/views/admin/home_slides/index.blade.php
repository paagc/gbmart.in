@extends('admin.app')

@section('content_header')
<h1>
	Home Slides
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li class="active">Home Slides</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<a href="/admin/home-slide/create" class="btn btn-success pull-right">Create Slide</a>
			</div>

			<div class="box-body">
				<form method="GET" action="/admin/home-slide">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Image</th>
								<tH>Link URL</th>
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
								<td><button type="submit" class="btn btn-primary">GO</button></td>
							</tr>
							@forelse($slides as $index => $slide)
							<tr>
								<td>{{ $index+1 }}</td>
								<td>{{ $slide->title }}</td>
								<td><a href="{{ $slide->image_url }}" class="btn btn-primary btn-sm" target="_blank">View Image</a></td>
								<td><a href="{{ $slide->link_url }}" target="_blank">{{ $slide->link_url }}</a></td>
								<td>{{ $slide->status }}</td>
								<td>
									@if ($slide->status == 'ACTIVE')
									<a href="/admin/home-slide/{{$slide->id}}/destroy" title="Deactivate" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
									@else
									<a href="/admin/home-slide/{{$slide->id}}/active" title="Activate" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
									@endif

									<a href="/admin/home-slide/{{$slide->id}}/edit" title="Edit" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="6" class="text-center">No slide to display</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</form>
			</div>
			<div class="box-footer clearfix">
				{{ $slides->appends(app('request')->all())->render() }}
			</div>
		</div>
	</div>
</div>
@endsection