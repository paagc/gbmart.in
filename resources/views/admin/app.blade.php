<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GBMart | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
   <!-- Morris chart -->
   <link rel="stylesheet" href="/bower_components/morris.js/morris.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="/bower_components/jvectormap/jquery-jvectormap.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="/bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="/admin" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>GB</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>GBMart </b>Admin</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">Hi, {{ Auth::user()->name }}</span>
              </a>
            </li>
            <li>
              <a href="/admin/logout" class="btn btn-info btn-flat">Sign out</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li class="{{{Request::is('admin') ? 'active' : ''}}}">
            <a href="/admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
          </li>

          <li class="{{{Request::is('admin/sub-categories') || Request::is('admin/sub-categories/create') ? 'active' : ''}}}">
            <a href="/admin/sub-categories"><i class="fa fa-outdent"></i> <span>Sub Categories</span></a>
          </li>

          <li class="treeview {{{Request::is('admin/orders/pending')||Request::is('admin/orders/approved')|| Request::is('admin/orders/packed') || Request::is('admin/orders/shipped') || Request::is('admin/orders/delivered') || Request::is('admin/orders/cancelled') || Request::is('admin/orders/rejected') ? 'active' : ''}}}">
            <a href="#">
              <i class="fa fa-files-o"></i>
              <span>Order Management</span>
              <span class="pull-right-container">
                <span class="caret"></span>
              </span>
            </a>
            <ul class="treeview-menu menu-open">
              <li>
                <a href="#">
                  <i class="icon-tasks"></i>
                  Today's Orders
                  <b class="badge badge-warning pull-right"></b>
                </a>
              </li>
              <li class="{{{Request::is('admin/orders/pending') ? 'active' : ''}}}">
                <a href="/admin/orders/pending">
                  <i class="icon-tasks"></i>
                  Pending Orders
                  <b class="badge badge-error pull-right"></b>
                </a>
              </li>
              <li class="{{{Request::is('admin/orders/approved') ? 'active' : ''}}}">
                <a href="/admin/orders/approved">
                  <i class="icon-tasks"></i>
                  Approved Orders
                  <b class="badge badge-error pull-right"></b>
                </a>
              </li>
              <li class="{{{Request::is('admin/orders/packed') ? 'active' : ''}}}">
                <a href="/admin/orders/packed">
                  <i class="icon-tasks"></i>
                  Packed Orders
                  <b class="badge badge-error pull-right"></b>
                </a>
              </li>
              <li class="{{{Request::is('admin/orders/shipped') ? 'active' : ''}}}">
                <a href="/admin/orders/shipped">
                  <i class="icon-tasks"></i>
                  Shipped Orders
                  <b class="badge badge-error pull-right"></b>
                </a>
              </li>
              <li class="{{{Request::is('admin/orders/delivered') ? 'active' : ''}}}">
                <a href="/admin/orders/delivered">
                  <i class="icon-inbox"></i>
                  Delivered Orders
                  <b class="badge badge-success pull-right"></b>
                </a>
              </li>
              <li class="{{{Request::is('admin/orders/cancelled') ? 'active' : ''}}}">
                <a href="/admin/orders/cancelled">
                  <i class="icon-tasks"></i>
                  Cancelled Orders
                  <b class="badge badge-error pull-right"></b>
                </a>
              </li>
              <li class="{{{Request::is('admin/orders/rejected') ? 'active' : ''}}}">
                <a href="/admin/orders/rejected">
                  <i class="icon-tasks"></i>
                  Rejected Orders
                  <b class="badge badge-error pull-right"></b>
                </a>
              </li>
            </ul>
          </li>

          <li class="{{{Request::is('admin/products') || Request::is('admin/products/create') ? 'active' : ''}}}">
            <a href="/admin/products"><i class="fa fa-tags"></i> <span>Products</span></a>
          </li>

          <li class="{{{Request::is('admin/sellers') ? 'active' : ''}}}">
            <a href="/admin/sellers"><i class="fa fa-users"></i> <span>Sellers</span></a>
          </li>

          <li class="{{{Request::is('admin/offers') || Request::is('admin/offers/create') ? 'active' : ''}}}">
            <a href="/admin/offers"><i class="fa fa-bell"></i> <span>Offers</span></a>
          </li>

          <li class="{{{Request::is('admin/home-slide') || Request::is('admin/home-slide/create') ? 'active' : ''}}}">
            <a href="/admin/home-slide"> <span>Home Slides</span></a>
          </li>

          <li class="{{{Request::is('admin/gift-coupon') || Request::is('admin/gift-coupon/create') ? 'active' : ''}}}">
            <a href="/admin/gift-coupon"> <span>Gift Coupons</span></a>
          </li>
          <li class="{{{Request::is('admin/google-merchant-products') ? 'active' : ''}}}">
            <a href="/admin/google-merchant-products"> <span>Google Shopping Content</span></a>
          </li>
        </ul>
      </section>
    </aside>

    <div class="content-wrapper">
      <section class="content-header">
        @yield('content_header')
      </section>

      <section class="content">
        @yield('content')
      </section>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; <a href="/">GBMart</a> : Powered by <a href="http://paagcdigital.com/" target="_blank">PAAGC DIGITAL PVT LTD</a>.</strong> All rights
      reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="/bower_components/raphael/raphael.min.js"></script>
  <script src="/bower_components/morris.js/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="/bower_components/moment/min/moment.min.js"></script>
  <script src="/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="/dist/js/adminlte.min.js"></script>
  @yield('footer')
</body>
</html>
