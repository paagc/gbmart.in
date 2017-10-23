@extends('admin.app')

@section('content_header')
<h1>
	Sub Categories
</h1>
<ol class="breadcrumb">
	<li><a href="/admin">Home</a></li>
	<li class="active">Sub Categories</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<a href="/admin/sub-categories/create" class="btn btn-success pull-right">Add New Sub-Category</a>
			</div>

			<div class="box-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th>#</th>
							<th>Display Name</th>
							<th>Slug Name</th>
							<th>Category</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
						<tr>
							<form action="/admin/sub-categories" method="GET">
								<th>{{ csrf_field() }}</th>
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
						@if(count($sub_categories) == 0)
						<tr>
							<td colspan="6">No records found.</td>
						</tr>
						@endif
						@foreach($sub_categories as $index => $sub_category)
						<tr>
							<td>{{ (($page - 1) * $page_size) + $index + 1 }}</td>
							<td>{{ $sub_category->display_name }}</td>
							<td>{{ $sub_category->name }}</td>
							<td>{{ $sub_category->category->display_name }}</td>
							<td>{{ $sub_category->status }}</td>
							<td>
								@if($sub_category->status == 'ACTIVE')
								<form action="/admin/sub-categories/{{ $sub_category->id }}/status/INACTIVE" action="POST">
									{{ csrf_field() }}
									{{ method_field('PATCH') }}
									<button type="submit" class="btn btn-danger"><i class="fa fa-window-close"></i></button>
								</form>
								<!-- <a class="btn btn-danger"><i class="fa fa-window-close"></i></a> -->
								@endif
								@if($sub_category->status == 'INACTIVE')
								<form action="/admin/sub-categories/{{ $sub_category->id }}/status/ACTIVE" action="POST">
									{{ csrf_field() }}
									{{ method_field('PATCH') }}
									<button type="submit" class="btn btn-success"><i class="fa fa-check-square"></i></button>
								</form>
								<!-- <a class="btn btn-success"><i class="fa fa-check-square"></i></a> -->
								@endif
								<!-- <a class="btn btn-primary"><i class="fa fa-pencil-square"></i></a> -->
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				{{ $sub_categories->appends(app('request')->all())->render() }}
				<!-- <ul class="pagination pagination-sm no-margin pull-right">
					<li><a href="#">«</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">»</a></li>
				</ul> -->
			</div>
		</div>
	</div>
</div>
@endsection