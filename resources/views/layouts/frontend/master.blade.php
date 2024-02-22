<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:image" content="@yield('image')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:url" content="@yield('url')">
    <meta name="twitter:image" content="@yield('image')">
    <meta property="twitter:description" content="@yield('description')">
    <meta property="twitter:title" content="@yield('title')">
    <meta name="twitter:url" content="@yield('url')">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets/images/favicon.png')}}" type="image/png" rel="icon">
    <title>@yield('title')</title>

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css?ver=1.00')}}">
    
    <!-- Custom Stylesheet -->
    <!--<link rel="stylesheet" href="{{asset('assets/css/style.css?ver=6.17')}}">-->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom-style.css?ver=2.22')}}">
    

    <!-- Custom Fonts -->
    <link href="{{asset('assets/css/roboto-fonts.css?family=roboto:100,300,400,500,700,900&display=swap')}}" rel="stylesheet">
    <link href="{{asset('assets/css/poppins-fonts.css?family=poppins:100,200,300,400,500,600,700,800,900&display=swap')}}" rel="stylesheet">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

    <!-- jQuery Files -->
    <script src="{{asset('assets/js/jquery.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('assets/js/owl.carousel.js')}}"></script>

    <!-- Fonts Icons -->
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.3/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.3/css/solid.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/custom_new.css')}}">
    @yield('custom-style')
  
  
     <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-1S4FCN3YZX"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-1S4FCN3YZX');
  </script> 
  
  
  	
</head>
<body>

  @include('frontend.header')

  @yield('content')
  


  @yield('extra-css')
  <script>
    $(document).ready(function(){
      $(".remove_cart_item").on('click',function(){
       
		var cart_id = $(this).data('cart_id');

    
    row_id = $(this).data('row_id');
      
    //console.log('asdasdasdasdassdasdasdasdasdasad');
			  $.ajax({
				  url: "{{ route('remove.cart') }}",
				  method: 'post',
				  data: {
					  "_token": "{{ csrf_token() }}",
					   cart_id: cart_id,
					   row_id: row_id,
				},
				  success: function(result){
           // console.log(cart_id);
           $(`.card_delete_remove_${cart_id}`).remove();
					//result = JSON.parse(result);
          //location.reload();
			}});  


	});
    });
    
  </script>

@include('frontend.footer')