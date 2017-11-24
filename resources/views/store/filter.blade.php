@extends('store.app')

@section('content')
<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="/">Home</a></li>
        <li class='active'>Search Products</li>
      </ul>
    </div>
    <!-- /.breadcrumb-inner --> 
  </div>
  <!-- /.container --> 
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
    
      <!-- /.sidebar -->
      <div class='col-md-12'> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
      
     
        <div class="clearfix filters-container m-t-10">
          <div class="row">
          
            <!-- /.col -->
            <div class="col-sm-12 col-md-6">
              <div class=" col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">popular</a></li>
                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                      
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col -->
            
              <!-- /.col --> 
            </div>
            <!-- /.col -->
         
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>
        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product">
                <div class="row custom-product-boxes">
                  @if (count($seller_products) > 0)
                  @foreach ($seller_products as $seller_product)
                  <div class="col-sm-6 col-md-3 wow fadeInUp custom-product-box">
                    <div class="products">
                      <div class="product">   
                        <div class="product-image">
                          <div class="image custom-product-image">
                            <a href="/store/{{ $seller_product->product->category->name }}/{{ $seller_product->product->sub_category->name }}/{{ $seller_product->product->name }}-{{ $seller_product->id }}">
                              <img  src="{{ $seller_product->product->product_images[0]->url }}" alt="">
                            </a>
                          </div>
                        </div>
                        <div class="product-info text-left">
                          <h3 class="name"><a href="/store/{{ $seller_product->product->category->name }}/{{ $seller_product->product->sub_category->name }}/{{ $seller_product->product->name }}-{{ $seller_product->id }}">{{ (strlen($seller_product->product->display_name) > 20 ? substr($seller_product->product->display_name, 0, 15) . "..." : $seller_product->product->display_name) }}</a></h3>
                          <div class="rating rateit-small"></div>
                          <div class="description">{{ $seller_product->product->description_small }}</div>

                          <div class="product-price"> 
                            <span class="price fa fa-inr">
                              {{ number_format($seller_product->seller_price, 2, '.', ',') }}       </span>
                              <span class="price-before-discount fa fa-inr">{{ number_format($seller_product->product->original_price, 2, '.', ',') }}</span>

                            </div>

                          </div>
                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                  <button seller-product-id="{{ $seller_product->id }}" class="btn btn-primary icon seller-product" data-toggle="dropdown" type="button">
                                    <i class="fa fa-shopping-cart"></i>                         
                                  </button>
                                  <button seller-product-id="{{ $seller_product->id }}" class="btn btn-primary cart-btn seller-product" type="button">Add to cart</button>

                                </li>

                                <li class="lnk wishlist">
                                  <a class="add-to-cart" title="Wishlist">
                                    <i class="icon fa fa-heart"></i>
                                  </a>
                                </li>

                                <li class="lnk">
                                  <a seller-product-id="{{ $seller_product->id }}" class="add-to-cart buy-now" title="Buy now">
                                    <i class="fa fa-shopping-bag"></i>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                    @endforeach
                    @else
                    <h3 class="text-center">No products found.</h3>
                    @endif
                  </div><!-- /.row -->
                </div>
                <!-- /.row --> 
              </div>
              <!-- /.category-product --> 
              
            </div>
            <!-- /.tab-pane -->
            <!-- /.tab-pane #list-container --> 
          </div>

          <?php 
            $url = url()->full();
            $url = str_replace("?page=" . $page, "", $url);
            $url = str_replace("&page=" . $page, "", $url);
            $url_query_append = "?";
            if (stripos($url, "?")) {
              $url_query_append = "&";
            }
          ?>
          @if ($page_count > 1)
          <div class="clearfix filters-container">
            <div class="text-right">
              <div class="pagination-container">
                <ul class="list-inline list-unstyled">
                  @if ($page > 1)
                  <li class="prev"><a href="{{ $url . $url_query_append . "page=" . ($page - 1) }}"><i class="fa fa-angle-left"></i></a></li>
                  @endif

                  @for ($i = 1; $i <= $page_count; $i++)
                  <li @if ($page == $i) class="active" @endif><a href="{{ $url . $url_query_append . "page=" . $i }}">{{ $i }}</a></li>
                  @endfor

                  @if ($page == $page_count)
                  <li class="next"><a href="{{ $url . $url_query_append . "page=" . ($page + 1) }}"><i class="fa fa-angle-right"></i></a></li>
                  @endif
                </ul>
              </div>                
            </div>
          </div>
          @endif
          
        </div>
        <!-- /.search-result-container --> 
        
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
      <div class="logo-slider-inner">
      
        
      </div>
      <!-- /.logo-slider-inner --> 
      
    </div>
    <!-- /.logo-slider --> 
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== --> </div>
  <!-- /.container --> 
  
</div>
@endsection
@section('footer')
<script>
</script>
@endsection
