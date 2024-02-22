<?php


use Illuminate\Support\Carbon;

?>
@extends('layouts.frontend.master') @section('title', 'The Marketplace') @section('content')
<div class="lazy" data-loader="asyncLoader"></div>
<main class="home-main">
	<div class="container">
		@if ( session()->has('message') )
		<div class="alert alert-icon alert-success alert-dismissible fade show">
			<div class="alert--icon"> <i class="fa fa-check"></i> </div>
			<div class="alert-text"> <strong>Well done!</strong> {{ session('message') }} </div>
			<button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
		</div>
		@elseif(session()->has('error'))
		<div class="alert alert-icon alert-danger alert-dismissible fade show">
			<div class="alert--icon"> <i class="fa fa-thermometer"></i> </div>
			<div class="alert-text"> <strong>Oh snap!</strong> {{ session('error') }} </div>
			<button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
		</div>
		@endif
		{{-- @if(isset($brands))
            <h1 class="main-heading">Popular Brands</h1>
            <!-- Brands Slider -->
            <div class="owl-carousel owl-theme brands-slider">
                @forelse($brands as $brand)
                    <div class="item">
                        <div class="card">
                            <a href="{{route('product.brand',[$brand['brand_slug']])}}" class="content">
		<div class="img-box"> <img data-src="<?php echo (!empty($brand->image) ? $brand->image_url : 'assets/images/product-placeholder.png'); ?> " class="img-fluid lazy "> </div>
		<h5 class="brand-title">{{$brand->brand_name}}</h5> </a>
	</div>
	</div>
	@empty
	<div class="item">
		<div class="card">
			<h5 class="brand-title">No brands</h5>
		</div>
	</div>
	@endforelse
	</div>
	@endif --}}

	@if(isset($brands))
	<a href="#" class="sub-heading">Popular Brands</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-men-new">
		@forelse($brands as $brand)
		<div class="item">
			<div class="card">
				<a href="{{route('product.brand',[$brand['brand_slug']])}}" class="content">
					<div class="img-box"> <img data-src="<?php echo (!empty($brand->image) ? $brand->image_url : 'assets/images/product-placeholder.png'); ?> " class="img-fluid lazy "> </div>
					<h5 class="brand-title" style="text-align:center;color:#3a3a3a;">{{$brand->brand_name}}</h5>
				</a>
			</div>
		</div>
		@empty
		<div class="item">
			<div class="card">
				<h5 class="brand-title">No brands</h5>
			</div>
		</div>
		@endforelse
	</div>
	@endif





	<!-- Brands Slider End -->
	<!-- Product Category Start -->
	<!-- Men's Category -->
	<!-- Men's New -->
	@if(isset($man_products) )
	@if(count($man_products) >0 )
	<a href="#" class="sub-heading">Men's new in</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-men-new">
		@foreach($man_products as $product)

		<?php


		// Creates DateTime objects
		$datetime1 = date_create($product->created_at);
		$datetime2 = date_create(Carbon::now());

		// Calculates the difference between DateTime objects
		$interval = date_diff($datetime1, $datetime2);

		// Printing result in years & months format
		$diff = (int)$interval->format('%a');


		// dd($product->created_at);

		?>
			@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
		<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug??'None','product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif

						@if($diff<=14) <span class="new-tag">New</span>
							@endif


					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
			<div class="brand-name">
				@if(isset($product->brand))
					{{ $product->brand->brand_name }}
				@endif
			</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug??'None','product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price ,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price ,2) }}</span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price ,2) }}</span>

				@endif


			</div>
		</div>


		@endforeach
	</div>

	@endif
	@endif
	<!-- Men's New End-->
	<!-- Men's Sales -->
	@if(isset($man_in_sales) && count($man_in_sales) > 0)
	<a href="#" class="sub-heading">Men's Sale</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-men-sales">
		@foreach($man_in_sales as $product)

		<?php


		// Creates DateTime objects
		$datetime1 = date_create($product->created_at);
		$datetime2 = date_create(Carbon::now());

		// Calculates the difference between DateTime objects
		$interval = date_diff($datetime1, $datetime2);

		// Printing result in years & months format
		$diff = (int)$interval->format('%a');


		// dd($product->created_at);

		?>


		@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
		<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif

						@if($diff<=14) <span class="new-tag">New</span>
							@endif




					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
				<div class="brand-name">@if(isset($product->brand)) {{ $product->brand->brand_name }} @endif</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price ,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price ,2) }} </span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price ,2) }}</span>

				@endif


			</div>
		</div>


		@endforeach
	</div>
	@endif
	<!-- Men's Sales End-->
	<!-- Men's Most Popular -->
	@if(isset($man_in_populars))
	@if(count($man_in_populars) > 0)
	<a href="#" class="sub-heading">Men's Most Popular</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-men-popular">
		@foreach($man_in_populars as $product)
		<?php
				// Creates DateTime objects
			$datetime1 = date_create($product->created_at);
			$datetime2 = date_create(Carbon::now());
			// Calculates the difference between DateTime objects
			$interval = date_diff($datetime1, $datetime2);
			// Printing result in years & months format
			$diff = (int)$interval->format('%a');
			// dd($product->created_at);
		?>

@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif
						@if($diff<=14) <span class="new-tag">New</span>
							@endif
					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
			    <div class="brand-name">@if(isset($product->brand)) {{ $product->brand->brand_name }} @endif</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price ,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price ,2) }}</span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price ,2) }}</span>

				@endif


			</div>
		</div>


		@endforeach
	</div>
	@endif
	@endif
	<!-- Men's Most Popular End -->
	<!-- Men's Category End -->
	<!-- Women's Category -->
	<!-- Women's New -->
	@if(isset($woman_products))
	@if(count($woman_products) > 0)
	<a href="#" class="sub-heading">Women's new in</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-women-new">
		@foreach($woman_products as $product)


		<?php


		// Creates DateTime objects
		$datetime1 = date_create($product->created_at);
		$datetime2 = date_create(Carbon::now());

		// Calculates the difference between DateTime objects
		$interval = date_diff($datetime1, $datetime2);

		// Printing result in years & months format
		$diff = (int)$interval->format('%a');


		// dd($product->created_at);

		?>


@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif
						@if($diff<=14) <span class="new-tag">New</span>
							@endif
					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
				<div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }} @endif</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price ,2) }}</span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

				@endif


			</div>
		</div>


		@endforeach
	</div>
	@endif
	@endif
	<!-- Women's New End-->
	<!-- Women's Sales -->
	@if(isset($woman_in_sales))
	@if(count($woman_in_sales) > 0)
	<a href="#" class="sub-heading">Women's Sales</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-women-sales">
		@foreach($woman_in_sales as $product)

		<?php


		// Creates DateTime objects
		$datetime1 = date_create($product->created_at);
		$datetime2 = date_create(Carbon::now());

		// Calculates the difference between DateTime objects
		$interval = date_diff($datetime1, $datetime2);

		// Printing result in years & months format
		$diff = (int)$interval->format('%a');


		// dd($product->created_at);

		?>
		@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
		<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif
						@if($diff<=14) <span class="new-tag">New</span>
							@endif
					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
				<div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }} @endif</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

				@endif


			</div>
		</div>


		@endforeach
	</div>
	@endif
	@endif
	<!-- Women's Sales End-->
	<!-- Women's Most Popular -->
	@if(isset($woman_in_populars)) 
	@if(count($woman_in_populars) > 0) 
	
	<a href="#" class="sub-heading">Women's Most Popular</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-women-popular">
        @foreach($woman_in_populars as $product)
        	<?php


		// Creates DateTime objects
		$datetime1 = date_create($product->created_at);
		$datetime2 = date_create(Carbon::now());

		// Calculates the difference between DateTime objects
		$interval = date_diff($datetime1, $datetime2);

		// Printing result in years & months format
		$diff = (int)$interval->format('%a');


		// dd($product->created_at);

		?>

@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif
						@if($diff<=14) <span class="new-tag">New</span>
							@endif
					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
				<div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }} @endif</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price ,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price ,2) }}</span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price ,2) }}</span>

				@endif


			</div>
		</div>

		@endforeach
	</div>
	@endif
	@endif
	<!-- Women's Most Popular End -->
	<!-- Women's Category End -->
	<!-- childern's Category -->
	@if(isset($children_products))
	@if(count($children_products) > 0)
	<!-- childern's New -->
	<a href="#" class="sub-heading">childern's new in</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-childern-new">
		@foreach($children_products as $product)

		<?php


		// Creates DateTime objects
		$datetime1 = date_create($product->created_at);
		$datetime2 = date_create(Carbon::now());

		// Calculates the difference between DateTime objects
		$interval = date_diff($datetime1, $datetime2);

		// Printing result in years & months format
		$diff = (int)$interval->format('%a');


		// dd($product->created_at);

		?>

@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif
						@if($diff<=14) <span class="new-tag">New</span>
							@endif
					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
			    <div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }}@endif</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

				@endif


			</div>
		</div>


		@endforeach
	</div>
	@endif
	@endif
	<!-- childern's New End-->
	<!-- childern's Sales -->
	@if(isset($children_in_sales)) 
	@if(count($children_in_sales) > 0) 
	<a href="#" class="sub-heading">childern's Sales</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-childern-sales">
		@foreach($children_in_sales as $product)

		<?php


		// Creates DateTime objects
		$datetime1 = date_create($product->created_at);
		$datetime2 = date_create(Carbon::now());

		// Calculates the difference between DateTime objects
		$interval = date_diff($datetime1, $datetime2);

		// Printing result in years & months format
		$diff = (int)$interval->format('%a');


		// dd($product->created_at);

		?>

@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif
						@if($diff<=14) <span class="new-tag">New</span>
							@endif
					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
			    <div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }}@endif</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

				@endif


			</div>
		</div>


		@endforeach
	</div>
	@endif
	@endif
	<!-- childern's Sales End-->
	<!-- childern's Most Popular -->
	@if(isset($children_in_populars))
	@if(count($children_in_populars) > 0)
	 <a href="#" class="sub-heading">childern's Most Popular</a>
	<div class="owl-carousel owl-theme product-slider" id="slider-childern-popular">
		@foreach($children_in_populars as $product)

		<?php


		// Creates DateTime objects
		$datetime1 = date_create($product->created_at);
		$datetime2 = date_create(Carbon::now());

		// Calculates the difference between DateTime objects
		$interval = date_diff($datetime1, $datetime2);

		// Printing result in years & months format
		$diff = (int)$interval->format('%a');


		// dd($product->created_at);

		?>

@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
			<div class="card-header">
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
					<div class="img-box">
						<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
					</div>
					<div class="tags">
						@if((int)$product->discount>0)
						<span class="discount-tag"> -{{ $product->discount }}% </span>
						@endif
						@if($diff<=14) <span class="new-tag">New</span>
							@endif
					</div>

				</a>
			</div>
			<div class="card-body" style="text-align:center;">
				<div class="product-category">

					{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
					{{ $product->shop_category->shop_cat_name }}</a> --}}
					<a href="">
					</a>
				</div>
				<div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }}@endif</div>
				<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
				@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
				<span class="real-price">£{{number_format($product->regular_price,2) }}</span>
				<span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
				@else

				<span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

				@endif


			</div>
		</div>


		@endforeach
	</div>
	@endif
	@endif
	<!-- Women's Most Popular End -->
	<!-- Women's Category End -->
	<!-- Product Category Ends --><a href="{{route('shop_products')}}" class="btn browse-products">Browse Thousands of Products on our
		Marketplace</a>
	<div class="top-trending">
		<h1>Top Trending Of <?php echo date('F'); ?></h1>
		<div class="trending-tabs">
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist"> <a class="nav-item nav-link active" id="nav-men-tab" data-toggle="tab" href="#nav-men" role="tab" aria-controls="nav-men" aria-selected="true">Menswear</a> <a class="nav-item nav-link" id="nav-women-tab" data-toggle="tab" href="#nav-women" role="tab" aria-controls="nav-women" aria-selected="false">Womenswear </a> <a class="nav-item nav-link" id="nav-childern-tab" data-toggle="tab" href="#nav-childern" role="tab" aria-controls="nav-childern" aria-selected="false">Children</a> </div>
			</nav>
			<div class="tab-content mt-5" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-men" role="tabpanel" aria-labelledby="nav-men-tab">
					<div class="products-wrapper"> @if(isset($top_mans_trend_products))
						@foreach($top_mans_trend_products as $product)

						<?php


						// Creates DateTime objects
						$datetime1 = date_create($product->created_at);
						$datetime2 = date_create(Carbon::now());

						// Calculates the difference between DateTime objects
						$interval = date_diff($datetime1, $datetime2);

						// Printing result in years & months format
						$diff = (int)$interval->format('%a');


						// dd($product->created_at);

						?>

@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
							<div class="card-header">
								<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
									<div class="img-box">
										<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
									</div>
									<div class="tags">
										@if((int)$product->discount>0)
										<span class="discount-tag"> -{{ $product->discount }}% </span>
										@endif
										@if($diff<=14) <span class="new-tag">New</span>
											@endif
									</div>

								</a>
							</div>
							<div class="card-body" style="text-align:center;">
								<div class="product-category">

									{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
									{{ $product->shop_category->shop_cat_name }}</a> --}}
									<a href="">
									</a>
								</div>
								<div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }}@endif</div>
								<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
								@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
								<span class="real-price">£{{number_format($product->regular_price,2) }}</span>
								<span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
								@else

								<span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

								@endif


							</div>
						</div>


						@endforeach



						@endif
					</div>
				</div>
				<div class="tab-pane fade" id="nav-women" role="tabpanel" aria-labelledby="nav-women-tab">
					<div class="products-wrapper"> @if(isset($top_womans_trend_products))
						@foreach($top_womans_trend_products as $product)


						<?php


						// Creates DateTime objects
						$datetime1 = date_create($product->created_at);
						$datetime2 = date_create(Carbon::now());

						// Calculates the difference between DateTime objects
						$interval = date_diff($datetime1, $datetime2);

						// Printing result in years & months format
						$diff = (int)$interval->format('%a');


						// dd($product->created_at);

						?>

@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
							<div class="card-header">
								<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
									<div class="img-box">
										<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
									</div>
									<div class="tags">
										@if((int)$product->discount>0)
										<span class="discount-tag"> -{{ $product->discount }}% </span>
										@endif
										@if($diff<=14) <span class="new-tag">New</span>
											@endif
									</div>

								</a>
							</div>
							<div class="card-body" style="text-align:center;">
								<div class="product-category">

									{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
									{{ $product->shop_category->shop_cat_name }}</a> --}}
									<a href="">
									</a>
								</div>
								<div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }}@endif</div>
								<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
								@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
								<span class="real-price">£{{number_format($product->regular_price,2) }}</span>
								<span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
								@else

								<span class="discounted-price">£{{number_format($product->regular_price,2) }}{{ $product->regular_price }}</span>

								@endif


							</div>
						</div>


						@endforeach

						@endif
					</div>
				</div>
				<div class="tab-pane fade" id="nav-childern" role="tabpanel" aria-labelledby="nav-childern-tab">
					<div class="products-wrapper"> @if(isset($top_children_trend_products))
						@foreach($top_children_trend_products as $product)

						@php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
						<div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
							<div class="card-header">
								<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
									<div class="img-box">
										<img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
									</div>
									<div class="tags">
										@if((int)$product->discount>0)
										<span class="discount-tag"> -{{ $product->discount }}% </span>
										@endif
										<span class="new-tag">New</span>
									</div>

								</a>
							</div>
							<div class="card-body" style="text-align:center;">
								<div class="product-category">

									{{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
									{{ $product->shop_category->shop_cat_name }}</a> --}}
									<a href="">
									</a>
								</div>
								{{-- <a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">@if(isset($product->brand)) {{ $product->brand->brand_name }} @endif</a> --}}
								<div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }}@endif</div>
								<a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
								@if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
								<span class="real-price">£{{number_format($product->regular_price,2) }}</span>
								<span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
								@else

								<span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

								@endif


							</div>
						</div>


						@endforeach


						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</main> @endsection