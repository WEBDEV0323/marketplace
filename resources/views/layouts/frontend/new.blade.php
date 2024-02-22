<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('assets/images/favicon.png')}}" type="image/png" rel="icon">
    <title>@yield('title')</title>

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css?ver=6.1')}}">

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
    <script src="{{asset('assets/js/owl.carousel.js')}}"></script>

    <!-- Fonts Icons -->
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.3/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.3/css/solid.css">


    





    @yield('custom-style')
</head>
<body>

  

  @include('frontend.header')

  @yield('content')
  


  @yield('extra-css')
  <script>
    $(document).ready(function(){
      $(".remove_cart_item").on('click',function(){
       
		cart_id = $(this).data('cart_id');

    
    row_id = $(this).data('row_id');
      
    //console.log('asdasdasdasdassdasdasdasdasdasadb');
			  $.ajax({
				  url: "{{ route('remove.cart') }}",
				  method: 'post',
				  data: {
					  "_token": "{{ csrf_token() }}",
					   cart_id: cart_id,
					   row_id: row_id,
				},
				  success: function(result){
            console.log(result);
					//result = JSON.parse(result);
          location.reload();
			}});  


	});
    });
    
  </script>

@include('frontend.footer')