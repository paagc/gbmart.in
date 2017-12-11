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
                    <table class="table table-bordered DataTables">
                        <thead>
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
                        </thead>
                        <tbody>

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
                                        <a class="btn btn-xs btn-danger"
                                           href="/seller/seller-products/{{ $seller_product->id }}/status/INACTIVE"><i
                                                    class="fa fa-window-close"></i></a>
                                    @endif
                                    @if($seller_product->status == 'INACTIVE')
                                        <a class="btn btn-xs btn-success"
                                           href="/seller/seller-products/{{ $seller_product->id }}/status/ACTIVE"><i
                                                    class="fa fa-check-square"></i></a>
                                    @endif
                                    <a href="/seller/seller-products/{{ $seller_product->id }}/edit" title="Edit"
                                       class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
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