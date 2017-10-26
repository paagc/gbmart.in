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
						@forelse($slides as $index => $slide)
						<tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $slide->title }}</td>
							<td><a href="{{ $slide->image_url }}" class="btn btn-primary btn-sm" target="_blank">View Image</a></td>
							<td><a href="{{ $slide->link_url }}" target="_blank">{{ $slide->link_url }}</a></td>
							<td>{{ $slide->status }}</td>
						</tr>
						@empty
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				
			</div>
		</div>
	</div>
</div>
@endsection