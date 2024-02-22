<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>The Marketplace | Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{asset('admin/images/favicon.png')}}">
    <!-- Switcher CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugin/switchery/switchery.min.css') }}" />
    
    <!-- Morris CSS -->
    @yield('styles')
   
    <link rel="stylesheet" href="{{asset('admin/assets/plugin/morris/morris.css')}}" />
    <!-- Custom Stylesheet -->
   
    <link rel="stylesheet" href="{{asset('admin/dist/css/style.css?ver=3.90')}}" />

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.3/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.3/css/solid.css">
   
   
</head>
<body>

    <div class="loader-wrapper">
        <div class="loader spinner-3">
            <div class="bg-primary"></div>
            <div class="bg-primary"></div>
            <div class="bg-primary"></div>
            <div class="bg-primary"></div>
            <div class="bg-primary"></div>
            <div class="bg-primary"></div>
            <div class="bg-primary"></div>
            <div class="bg-primary"></div>
            <div class="bg-primary"></div>
        </div>
    </div>
    
    <div class="wrapper">
        <!-- Main Container -->
        <div id="main-wrapper" class="menu-fixed page-hdr-fixed">
            <!-- Page header -->
            @include('admin.page-header')
            <!-- Menu Wrapper -->
            @include('admin.sidebar')
           <div class="main-content-wrapper">
                <!-- Main Page Wrapper -->

                
                @yield('body-content')
           </div>
            <!-- Page Footer -->
            <div class="page-ftr">
                <div>The Marketplace ©<?php echo date('Y')?> themarketplace.comm</div>
            </div>
        </div>
        <!-- Sidebar Section -->
        <!-- End Sidebar Section -->
    </div>
    
    <!-- Include js files -->
    <!-- Vendor Plugin -->
    <script type="text/javascript" src="{{asset('admin/assets/plugin/vendor.min.js')}}"></script>
    <!-- Raphael Plugin -->
    @if(Request::segment(1) != 'category'  || Request::segment(1) != 'add-shop-category' )
    <script type="text/javascript" src="{{asset('admin/assets/plugin/raphael/raphael-min.js')}}"></script>
    <!-- Morris Plugin -->
    <script type="text/javascript" src="{{asset('admin/assets/plugin/morris/morris.min.js')}}"></script>
    <!-- Sparkline Plugin -->
    <script type="text/javascript" src="{{asset('admin/assets/plugin/sparkline/jquery.sparkline.min.js')}}"></script>
    @endif
    @yield('scripts')
    <!-- Custom Script Plugin -->
    <script type="text/javascript" src="{{asset('admin/dist/js/custom.js')}}"></script>
    <!-- Custom demo Script for Dashbaord -->
    <script type="text/javascript" src="{{asset('admin/dist/js/demo/dashboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/dist/js/numScroller.js')}}"></script>
  
    
 
    
</body>
</html>